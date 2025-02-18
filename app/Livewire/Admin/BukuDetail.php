<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BukuDetail extends Component
{
    public $buku;

    public function mount($id)
    {
        // Mengambil data buku berdasarkan ID
        $this->buku = DB::table('buku')->where('id', $id)->first();

        // Jika buku tidak ditemukan, redirect ke halaman daftar buku
        if (!$this->buku) {
            return redirect()->route('admin.buku.index')->with('error', 'Buku tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.admin.buku-detail', ['buku' => $this->buku]);
    }
}
