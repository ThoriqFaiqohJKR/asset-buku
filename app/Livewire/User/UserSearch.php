<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UserSearch extends Component
{
    public $search = ''; // Properti untuk menangkap query pencarian

    public function render()
    {
        // Menggunakan query builder untuk melakukan pencarian
        $buku = DB::table('buku')
                    ->where('nama_buku', 'like', '%' . $this->search . '%')
                    ->orWhere('kategori', 'like', '%' . $this->search . '%')
                    ->orWhere('ringkasan', 'like', '%' . $this->search . '%')
                    ->get();

        return view('livewire.user.user-search', compact('buku'));
    }
}
