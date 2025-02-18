<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AssetPinjam extends Component
{
    public $nama, $asset, $tanggal_pinjam, $tanggal_kembali;   
    public $assets = [];

    protected $rules = [
        'nama' => 'required|string|max:255',
        'asset' => 'required|integer',  
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ];

    public function mount($id)
    {
        // Ambil semua asset
        $this->assets = DB::table('asset')->get();
        
        // Cek apakah asset ditemukan berdasarkan ID
        $asset = DB::table('asset')->find($id);
        if ($asset) {
            $this->asset = $asset->id;
        }
    }

    public function store()
    {
        $this->validate();

        // Ambil detail asset berdasarkan ID
        $asset = DB::table('asset')->find($this->asset);

        if (!$asset) {
            session()->flash('message', 'Asset tidak ditemukan.');
            return;
        }

        if ($asset->stok <= 0) {
            session()->flash('message', 'Stok asset habis. Peminjaman tidak bisa dilakukan.');
            return;
        }

        // Ambil kode_uniq dari asset yang dipilih
        $kode_uniq = $asset->kode_uniq;

        // Simpan data peminjaman ke tabel 'peminjaman'
        DB::table('peminjaman')->insert([
            'kode_uniq' => $kode_uniq,  // Simpan kode_uniq yang diambil dari asset
            'nama' => $this->nama,
            'barang' => $asset->nama_barang,  // Simpan nama asset
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => 'Dipinjam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kurangi stok asset
        DB::table('asset')->where('id', $this->asset)->decrement('stok', 1);

        session()->flash('message', 'Peminjaman berhasil ditambahkan. Stok asset telah diperbarui.');
        $this->reset(['nama', 'tanggal_pinjam', 'tanggal_kembali']); // Reset input form, kecuali asset
    }

    public function render()
    {
        return view('livewire.admin.asset-pinjam', [
            'assets' => $this->assets,
        ]);
    }
}
