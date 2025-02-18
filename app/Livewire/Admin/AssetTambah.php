<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class AssetTambah extends Component
{
    use WithFileUploads;

    public $nama_barang, $tanggal_beli, $harga_barang, $jenis_barang;
    public $nomor_asset, $foto_barang, $serial_number, $stok, $kode_uniq;

    protected $rules = [
        'nama_barang' => 'required|string|max:255',
        'tanggal_beli' => 'required|date',
        'harga_barang' => 'required|integer',
        'jenis_barang' => 'required|string|max:255',
        'stok' => 'required|integer',
        'serial_number' => 'required|string|max:255',
        'nomor_asset' => 'required|string|max:255',
        'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    ];

    public function store()
    {
        $this->validate();

        // Simpan foto barang jika ada
        $fotoAsset = null;
        if ($this->foto_barang) {
            $fotoPath = $this->foto_barang->store('images/asset', 'public');
            $fotoAsset = '/storage/' . $fotoPath;
        }

        // Generate kode_uniq otomatis (A-00001, A-00002, ...)
        $lastAsset = DB::table('asset')->latest('id')->first();
        $nextNumber = $lastAsset ? intval(substr($lastAsset->kode_uniq, 2)) + 1 : 1;
        $this->kode_uniq = 'A-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Simpan data aset
        $assetId = DB::table('asset')->insertGetId([
            'nama_barang' => $this->nama_barang,
            'tanggal_beli' => $this->tanggal_beli,
            'harga_barang' => $this->harga_barang,
            'jenis_barang' => $this->jenis_barang,
            'stok' => $this->stok,
            'serial_number' => $this->serial_number,
            'nomor_asset' => $this->nomor_asset,
            'kode_uniq' => $this->kode_uniq,
            'foto_barang' => $fotoAsset,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Generate QR Code
        $adminUrl = url('/admin/asset/detail/' . $assetId);
        $userUrl = url('/public/asset/' . $assetId);
        $qrCodePath = 'public/qr_codes/asset/qr_' . $assetId . '.png';
        $qrContent = "Admin: $adminUrl\nUser: $userUrl";
        
        QrCode::format('png')->size(200)->generate($qrContent, storage_path('app/' . $qrCodePath));

        // Simpan QR Code ke database
        $qrCodeDatabasePath = '/storage/qr_codes/asset/qr_' . $assetId . '.png';
        DB::table('asset')->where('id', $assetId)->update(['qr_code' => $qrCodeDatabasePath]);

        session()->flash('message', "Aset berhasil ditambahkan dengan kode unik: $this->kode_uniq");
        $this->reset(['nama_barang', 'tanggal_beli', 'harga_barang', 'jenis_barang', 'stok', 'serial_number', 'nomor_asset', 'foto_barang', 'kode_uniq']);

        return redirect()->to('/admin/asset');
    }

    public function render()
    {
        return view('livewire.admin.asset-tambah');
    }
}
