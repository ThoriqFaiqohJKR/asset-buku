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

    public function mount($bookId)
{
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
}

public function render()
{
    return view('livewire.user.buku-detail', [
        'book' => $this->book,
        'recommendations' => $this->recommendations,
        'kategori' => $this->kategori // Kirim kategori ke tampilan
    ]);
}

}
