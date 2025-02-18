<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    //
    public function index()
    {
        $assets = DB::table('asset')->get();
        return view("admin.asset-index", compact('assets'));
    }

    public function create()
    {
        return view("admin.asset-tambah");
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|integer',
            'kategori_barang' => 'required|string|max:255',
            'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Variabel untuk foto
        $fotoAsset = null;

        // Jika ada file foto yang di-upload
        if ($request->hasFile('foto_barang')) {
            $fotoAsset = $request->file('foto_barang')->store('assets', 'public');
            $fotoAsset = '/storage/' . $fotoAsset;
        }

        // Generate serial number yang unik
        do {
            $serialNumber = strtoupper(Str::random(10));
            $exists = DB::table('barang')->where('serial_number', $serialNumber)->exists();
        } while ($exists);

        // Simpan data barang ke database
        $assetId = DB::table('barang')->insertGetId([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'kategori_barang' => $request->kategori_barang,
            'foto_barang' => $fotoAsset,
            'serial_number' => $serialNumber,
            'qr_code' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Generate QR Code dengan 2 URL: Untuk Admin & User
        $adminUrl = url('/admin/asset/detail/' . $assetId);
        $userUrl = url('/public/asset/' . $assetId);

        $qrCodePath = 'public/qr_codes/qr_' . $assetId . '.png';

        // QR Code dengan format 2 URL dalam 1 QR
        $qrContent = "Admin: $adminUrl\nUser: $userUrl";
        QrCode::format('png')->size(200)->generate($qrContent, storage_path('app/' . $qrCodePath));

        // Simpan QR Code ke database
        $qrCodeDatabasePath = '/storage/qr_codes/qr_' . $assetId . '.png';
        DB::table('barang')->where('id', $assetId)->update(['qr_code' => $qrCodeDatabasePath]);

        return redirect()->route('asset.create')->with('success', 'Aset berhasil ditambahkan!');
    }
    public function edit($id)
    {
        return view("admin.asset-edit  ", ['id' => $id]);
    }
    public function pinjam($id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();
        return view('admin.asset-pinjam', compact('asset'));
    }
    public function show($id)
    {
        // Mengambil data asset berdasarkan ID
        $asset = DB::table('asset')->where('id', $id)->first();

        // Mengirimkan data ke tampilan dengan variabel $asset
        return view('admin.asset-detail', compact('asset'));
    }
    public function printQr($id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();

        if (!$asset) {
            return redirect()->route('admin.asset.index')->with('error', 'asset tidak ditemukan.');
        }
    }

    public function update(Request $request)
    {
        return view("");
    }

    public function destroy(Request $request)
    {
        return view("");
    }
}
