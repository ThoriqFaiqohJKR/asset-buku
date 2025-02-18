<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination; // Tambahkan ini
use Illuminate\Support\Facades\DB;

class BukuIndex extends Component
{
    use WithPagination; // Tambahkan ini

    public $search = '';
    public $kategori = '';
    public $stok = '';
    public $confirmDeleteId = null;

    public function exportCsv()
    {
        $bukus = DB::table('buku');

        if ($this->search) {
            $bukus->where('nama_buku', 'like', '%' . $this->search . '%');
        }
        if ($this->kategori) {
            $bukus->where('kategori', $this->kategori);
        }
        if ($this->stok) {
            $bukus->where('stok', $this->stok === 'In Stock' ? '>' : '=', 0);
        }

        $bukus = $bukus->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="buku-list.csv"',
        ];

        $callback = function () use ($bukus) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Nama Buku', 'Ringkasan', 'Gambar Buku', 'Stok', 'Kategori']);
            foreach ($bukus as $buku) {
                fputcsv($file, [
                    $buku->id,
                    $buku->nama_buku,
                    $buku->ringkasan,
                    $buku->gambar_buku,
                    $buku->stok,
                    $buku->kategori,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function searchBooks()
    {
        $query = DB::table('buku');

        if ($this->search) {
            $query->where('nama_buku', 'like', '%' . $this->search . '%');
        }
        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }
        if ($this->stok) {
            $query->where('stok', $this->stok === 'In Stock' ? '>' : '=', 0);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function setConfirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function hapusBuku($id)
    {
        DB::table('buku')->where('id', $id)->delete();
        session()->flash('message', 'Buku berhasil dihapus.');

        $this->confirmDeleteId = null;
        $this->resetPage(); // Ini sekarang aman digunakan karena WithPagination sudah ditambahkan
    }

    // Reset halaman saat ada perubahan pada pencarian/filtering
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingKategori()
    {
        $this->resetPage();
    }

    public function updatingStok()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.buku-index', [
            'bukus' => $this->searchBooks(),
        ]);
    }
}
