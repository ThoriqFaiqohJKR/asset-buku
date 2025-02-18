<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DaftarBuku extends Component
{
    public $bukus = [];
    public $search = '';
    public $kategori = '';
    public $stok = '';
    public $categories = [];

    // Fungsi untuk mengambil buku
    public function getBooks()
    {
        $query = DB::table('buku')
            ->leftJoin('peminjaman', 'buku.nama_buku', '=', 'peminjaman.barang')
            ->select('buku.*', DB::raw('COUNT(peminjaman.id) as peminjaman_count'))
            ->groupBy('buku.id', 'buku.nama_buku', 'buku.ringkasan', 'buku.gambar_buku', 'buku.stok', 'buku.kategori', 'buku.qr_code', 'buku.location', 'buku.kode_uniq', 'buku.created_at', 'buku.updated_at')
            ->orderByDesc('peminjaman_count');

        // Filter berdasarkan pencarian
        if (!empty($this->search)) {
            $query->where('buku.nama_buku', 'like', '%' . $this->search . '%');
        }

        // Filter berdasarkan kategori 
        if (!empty($this->kategori)) {
            $query->where('buku.kategori', $this->kategori);
        }

        // Filter berdasarkan stok
        if (!empty($this->stok)) {
            if ($this->stok === 'In Stock') {
                $query->where('buku.stok', '>', 0);
            } elseif ($this->stok === 'Out of Stock') {
                $query->where('buku.stok', '=', 0);
            }
        }

        return $query->get();
    }

    // Setiap perubahan di search akan langsung memanggil getBooks()
    public function updatedSearch()
    {
        $this->bukus = $this->getBooks();
    }

    public function render()
    {
        // Ambil buku sesuai dengan filter yang diberikan
        $this->bukus = $this->getBooks();

        // Ambil kategori enum yang ada di kolom 'kategori' dari tabel 'buku'
        $this->categories = DB::table('buku')
            ->select(DB::raw('DISTINCT kategori'))
            ->get()
            ->pluck('kategori');

        return view('livewire.user.daftar-buku', [
            'bukus' => $this->bukus,
            'categories' => $this->categories,
        ]);
    }
}
