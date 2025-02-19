<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DaftarAsset extends Component
{
    use WithPagination;

    public $search = '';
    public $kategori = '';

    public $categories = [
        'building', 'kendaraan', 'peralatan mebel', 'peralatan non elektronik',
        'peralatan elektronik', 'peralatan drone', 'peralatan multimedia',
        'software', 'perlengkapan'
    ];

    public function render()
    {
        $query = DB::table('asset');

        // Pencarian berdasarkan nama atau kode unik
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('nama_barang', 'like', '%' . $this->search . '%')
                  ->orWhere('kode_uniq', 'like', '%' . $this->search . '%');
            });
        } 

        // Filter berdasarkan kategori
        if (!empty($this->kategori)) {
            $query->where('jenis_barang', $this->kategori);
        }

        $assets = $query->paginate(12);

        return view('livewire.user.daftar-asset', [
            'assets' => $assets,
            'categories' => $this->categories,
        ]);
    }
}
