<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AssetDetail extends Component
{
    public $asset;

    public function mount($id)
    {
        // Mendapatkan data asset berdasarkan ID
        $this->asset = DB::table('asset')->where('id', $id)->first();

      
    }

    public function render()
    {
        return view('livewire.admin.asset-detail', ['asset' => $this->asset]);
    }
}
