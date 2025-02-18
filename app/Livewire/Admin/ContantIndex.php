<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
class ContantIndex extends Component
{
    public $contacts;

    public function mount()
    {
        $this->contacts = DB::table('contact_admin')->select('id', 'nama', 'nomor')->get(); // Tambahkan 'id'
    }
    public function render()
    {
        return view('livewire.admin.contant-index');
    }
}
 