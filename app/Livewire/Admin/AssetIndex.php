<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AssetIndex extends Component
{
    public $search = '';
    public $jenis_barang = '';
    public $kategori_barang = '';
    public $stok = '';
    public $confirmDeleteId = null;

    // Fungsi pencarian dengan pagination

    public function exportCsv()
    {
        $assets = DB::table('asset');

        // Apply filters if present
        if ($this->search) {
            $assets->where('nama_barang', 'like', '%' . $this->search . '%');
        }
        if ($this->jenis_barang) {
            $assets->where('jenis_barang', $this->jenis_barang);
        }
        if ($this->kategori_barang) {
            $assets->where('kategori_barang', $this->kategori_barang);
        }
        if ($this->stok) {
            $assets->where('stok', $this->stok === 'In Stock' ? '>' : '=', 0);
        }

        $assets = $assets->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="assets.csv"',
        ];

        $callback = function () use ($assets) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Nama Barang', 'Jenis Barang', 'Kategori Barang', 'Harga', 'Stok']);

            foreach ($assets as $asset) {
                fputcsv($file, [
                    $asset->id,
                    $asset->nama_barang,
                    $asset->jenis_barang,
                    $asset->kategori_barang,
                    $asset->harga_barang,
                    $asset->stok,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function searchAssets()
    {
        $query = DB::table('asset');

        // Pencarian berdasarkan nama barang
        if ($this->search) {
            $query->where('nama_barang', 'like', '%' . $this->search . '%');
        }
 
        // Filter berdasarkan jenis barang
        if ($this->jenis_barang) {
            $query->where('jenis_barang', $this->jenis_barang);
        }

        // Filter berdasarkan kategori barang
        if ($this->kategori_barang) {
            $query->where('kategori_barang', $this->kategori_barang);
        }

        // Filter berdasarkan stok
        if ($this->stok) {
            if ($this->stok == 'In Stock') {
                $query->where('stok', '>', 0);
            } elseif ($this->stok == 'Out of Stock') {
                $query->where('stok', '=', 0);
            }
        }

        // Menggunakan paginate untuk membagi hasil ke dalam beberapa halaman
        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    // Fungsi untuk menghapus asset
    public function hapusAsset($id)
    {
        DB::table('asset')->where('id', $id)->delete();
        $this->searchAssets();
        $this->confirmDeleteId = null;
    }

    // Set ID asset untuk konfirmasi penghapusan
    public function setConfirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function render()
    {
        // Dapatkan data asset dengan pagination
        $assets = $this->searchAssets();

        return view('livewire.admin.asset-index', [
            'assets' => $assets
        ]);
    }
}
