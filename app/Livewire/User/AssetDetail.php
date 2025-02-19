<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AssetDetail extends Component
{
    public $assetId;
    public $asset;
    public $contact1;
    public $contact2;

    public function mount($assetId)
    {
        $this->assetId = $assetId;
        $this->asset = DB::table('asset')->where('id', $this->assetId)->first();

        if (!$this->asset) {
            abort(404);
        }

        $this->contact1 = DB::table('contact_admin')->where('id', 1)->first();
        $this->contact2 = DB::table('contact_admin')->where('id', 2)->first();
    }

    public function render()
    {
        return view('livewire.user.asset-detail', [
            'asset' => $this->asset,
            'contact1' => $this->contact1,
            'contact2' => $this->contact2,
        ]);
    }
}
