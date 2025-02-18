<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AssetEdit extends Component
{
    use WithFileUploads;

    public $assetId;
    public $nama_barang;
    public $harga_barang;
  
    public $foto_barang;
    public $foto_lama;

    public $stok;

    protected $rules = [
        'nama_barang' => 'required|string|max:255',
        'harga_barang' => 'required|integer',
        'kategori_barang' => 'required|string|max:255',
        'stok' => 'required|integer',
        'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    ];

    public function mount($assetId)
    {
        $asset = DB::table('asset')->where('id', $assetId)->first();

        if ($asset) {
            $this->assetId = $asset->id;
            $this->nama_barang = $asset->nama_barang;
            $this->harga_barang = $asset->harga_barang;
        
            $this->stok = $asset->stok;
            $this->foto_lama = $asset->foto_barang;
        }
    }

    public function update()
    {
        $this->validate();

        $fotoAsset = $this->foto_lama;

        if ($this->foto_barang) {
            if ($this->foto_lama) {
                Storage::delete(str_replace('/storage/', 'public/images/asset', $this->foto_lama));
            }

            $fotoPath = $this->foto_barang->store('images/asset', 'public');
            $fotoAsset = '/storage/' . $fotoPath;
        }

        DB::table('asset')->where('id', $this->assetId)->update([
            'nama_barang' => $this->nama_barang,
            'harga_barang' => $this->harga_barang,
            'kategori_barang' => $this->kategori_barang,
            'stok' => $this->stok, 
            'foto_barang' => $fotoAsset,
            'updated_at' => now(),
        ]);

        session()->flash('message', 'Asset berhasil diperbarui!');
        return redirect()->to('/admin/asset');
    }

    public function render()
    {
        return view('livewire.admin.asset-edit');
    }
}
