<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PeminjamanEdit extends Component
{
    public $id;
    public $nama, $barang, $tanggal_pinjam, $tanggal_kembali, $status, $kode_uniq, $catatan;

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
            $this->kode_uniq = $peminjaman->kode_uniq;
            $this->catatan = $peminjaman->catatan; // Tambahkan catatan
        }
    }

    public function updateStatus()
    {
        // Validate status and catatan field
        $this->validate([
            'status' => 'required|in:Dipinjam,Kembali',
            'catatan' => 'nullable|string|max:255',
        ]);

        // Jika status menjadi "Kembali", kita akan menambahkan stok berdasarkan kode_uniq
        if ($this->status == 'Kembali') {
            if (substr($this->kode_uniq, 0, 1) == 'A') {
                DB::table('asset')
                    ->where('kode_uniq', $this->kode_uniq)
                    ->increment('stok');
            } elseif (substr($this->kode_uniq, 0, 1) == 'B') {
                DB::table('buku')
                    ->where('kode_uniq', $this->kode_uniq)
                    ->increment('stok');
            }
        }

        // Update the status and catatan in the peminjaman table
        DB::table('peminjaman')->where('id', $this->id)->update([
            'status' => $this->status,
            'catatan' => $this->catatan,
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Status peminjaman dan catatan berhasil diperbarui.');
        return redirect()->to('/admin/peminjaman');
    }

    public function render()
    {
        return view('livewire.admin.peminjaman-edit');
    }
}
