<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Pastikan ini ada

class UserIndex extends Component
{
    public $search = ''; // Untuk menampung input pencarian
    public $bukus = [];  // Untuk menampung data buku yang akan ditampilkan

    // Fungsi untuk melakukan pencarian buku
    public function searchBooks()
    {
        // Membersihkan spasi di awal dan akhir input pencarian
        $searchQuery = trim($this->search);

        // Jika ada input pencarian
        if ($searchQuery) {
            // Debugging query yang akan dijalankan
            Log::debug("Searching for: " . $searchQuery);

            $this->bukus = DB::table('buku')
                ->where('nama_buku', 'like', '%' . $searchQuery . '%')
                
                ->get();

            // Debugging hasil pencarian
            Log::debug($this->bukus);
        } else {
            // Jika tidak ada pencarian, ambil semua buku
            $this->bukus = DB::table('buku')->get();
        }
    }

    // Fungsi untuk update pencarian ketika ada perubahan pada input search
    public function updatedSearch()
    {
        $this->searchBooks();
    }

    // Render method untuk menampilkan tampilan
    public function render()
    {
        return view('livewire.user.user-index', [
            'bukus' => $this->bukus,
        ]);
    }
}
