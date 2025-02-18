<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ContactDetail extends Component
{
    public $contactId;
    public $contact;

    public function mount($id)
    {
        $this->contactId = $id;
        $this->contact = DB::table('contact_admin')->where('id', $id)->first();

        if (!$this->contact) {
            abort(404, 'Contact not found'); // Jika kontak tidak ditemukan, tampilkan 404
        }
    }

    public function render()
    {
        return view('livewire.admin.contact-detail');
    }
}