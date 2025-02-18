<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BukuTambah extends Component
{
    use WithFileUploads;

    public $nama_buku;
    public $ringkasan;
    public $gambar_buku;
    public $stok;
    public $kategori;
    public $location;

    // Validasi input
    protected $rules = [
        'nama_buku' => 'required|string|max:255',
        'ringkasan' => 'required|string',   
        'gambar_buku' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        'stok' => 'required|integer',
        'kategori' => 'required|string',
        'location' => 'required|string',
    ];

    // Fungsi untuk menyimpan data buku
    public function store() 
    {
        $this->validate();
    
        $gambarBuku = null;
    
        if ($this->gambar_buku) {
            // Simpan gambar ke penyimpanan storage/public/images
            $gambarPath = $this->gambar_buku->store('images/buku', 'public');
            $gambarBuku = '/storage/' . $gambarPath;
        }
    
        // Generate kode_uniq: Ambil jumlah buku yang ada di tabel dan tambahkan 1
        $lastBook = DB::table('buku')->latest('id')->first();
        $nextNumber = $lastBook ? intval(substr($lastBook->kode_uniq, 2)) + 1 : 1;
        $kodeUniq = 'B-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT); // Format B-00001, B-00002, dst.
    
        // Simpan data buku menggunakan Query Builder
        $bukuId = DB::table('buku')->insertGetId([
            'kode_uniq' => $kodeUniq,
            'nama_buku' => $this->nama_buku,
            'ringkasan' => $this->ringkasan,
            'gambar_buku' => $gambarBuku,
            'stok' => $this->stok,
            'kategori' => $this->kategori,
            'location' => $this->location,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Generate QR Code dengan 2 URL: Untuk Admin & User
        $adminUrl = url('/admin/buku/detail/' . $bukuId);
        $userUrl = url('/public/buku/' . $bukuId);

        $qrCodePath = 'public/qr_codes/buku/qr_' . $bukuId . '.png';

        // QR Code dengan format 2 URL dalam 1 QR
        $qrContent = "Admin: $adminUrl\nUser: $userUrl";
        QrCode::format('png')->size(200)->generate($qrContent, storage_path('app/' . $qrCodePath));

        // Simpan QR Code ke database
        $qrCodeDatabasePath = '/storage/qr_codes/buku/qr_' . $bukuId . '.png';
        DB::table('buku')->where('id', $bukuId)->update(['qr_code' => $qrCodeDatabasePath]);
    
        session()->flash('message', 'Buku berhasil ditambahkan dengan kode unik: ' . $kodeUniq . '!');
        return redirect()->to('/admin/buku');
    }
    
    public function render()
    {
        return view('livewire.admin.buku-tambah');
    }
}
