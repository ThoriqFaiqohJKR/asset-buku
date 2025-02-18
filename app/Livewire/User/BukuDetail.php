<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BukuDetail extends Component
{
    public $bookId;
    public $book;
    public $recommendations;
    public $kategori;

    // Untuk kontak admin
    public $contact1;
    public $contact2;

    public function mount($bookId)
    {
        // Ambil detail buku
        $this->bookId = $bookId;
        $this->book = DB::table('buku')->where('id', $bookId)->first();

        if (!$this->book) {
            abort(404);
        }

        // Simpan kategori buku saat ini
        $this->kategori = $this->book->kategori; 

        // Ambil buku lain dengan kategori yang sama sebagai rekomendasi
        $this->recommendations = DB::table('buku')
            ->where('id', '!=', $bookId) // Hindari buku yang sedang ditampilkan
            ->where('kategori', $this->kategori) // Gunakan kategori yang sama
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Ambil data kontak admin
        $this->contact1 = DB::table('contact_admin')->where('id', 1)->first();
        $this->contact2 = DB::table('contact_admin')->where('id', 2)->first();

        // Pastikan kontak ada
        if (!$this->contact1 || !$this->contact2) {
            abort(404, 'Kontak tidak ditemukan');
        }
    }

    public function render()
    {
        return view('livewire.user.buku-detail', [
            'book' => $this->book,
            'recommendations' => $this->recommendations,
            'kategori' => $this->kategori, // Kirim kategori ke tampilan
            'contact1' => $this->contact1,
            'contact2' => $this->contact2,
        ]);
    }
}
