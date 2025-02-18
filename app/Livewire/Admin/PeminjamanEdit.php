<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PeminjamanEdit extends Component
{
    public $id;
    public $nama, $barang, $tanggal_pinjam, $tanggal_kembali, $status, $kode_uniq;

    public function mount($id)
    {
        // Retrieve peminjaman data based on the ID passed from Blade
        $peminjaman = DB::table('peminjaman')->where('id', $id)->first();

        if ($peminjaman) {
            $this->id = $peminjaman->id;
            $this->nama = $peminjaman->nama;
            $this->barang = $peminjaman->barang;
            $this->tanggal_pinjam = $peminjaman->tanggal_pinjam;
            $this->tanggal_kembali = $peminjaman->tanggal_kembali;
            $this->status = $peminjaman->status;
            $this->kode_uniq = $peminjaman->kode_uniq;  // Tambahkan kode_uniq
        }
    }

    public function updateStatus()
    {
        // Validate status field
        $this->validate([
            'status' => 'required|in:Dipinjam,Kembali',
        ]);

        // Jika status menjadi "Kembali", kita akan menambahkan stok berdasarkan kode_uniq
        if ($this->status == 'Kembali') {
            // Cek apakah kode_uniq diawali dengan 'A' (asset) atau 'B' (buku)
            if (substr($this->kode_uniq, 0, 1) == 'A') {
                // Jika asset (kode_uniq diawali dengan 'A'), tambahkan stok di tabel asset
                DB::table('asset')
                    ->where('kode_uniq', $this->kode_uniq)
                    ->increment('stok'); // Menambah stok asset +1
            } elseif (substr($this->kode_uniq, 0, 1) == 'B') {
                // Jika buku (kode_uniq diawali dengan 'B'), tambahkan stok di tabel buku
                DB::table('buku')
                    ->where('kode_uniq', $this->kode_uniq)
                    ->increment('stok'); // Menambah stok buku +1
            }
        }

        // Update the status in the peminjaman table
        DB::table('peminjaman')->where('id', $this->id)->update([
            'status' => $this->status,
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Status peminjaman berhasil diperbarui dan stok ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.peminjaman-edit');
    }
}
