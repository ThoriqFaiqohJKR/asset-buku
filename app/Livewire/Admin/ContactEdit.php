<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ContactEdit extends Component
{
    public $contactId;
    public $contact;  // Ini untuk menampung data awal
    public $nama, $nomor;  // Ini untuk binding ke input form

    // Method untuk load data kontak berdasarkan ID
    public function mount($id)
    {
        $this->contactId = $id;
        $this->contact = DB::table('contact_admin')->where('id', $id)->first();

        // Menyediakan data awal untuk form input
        if ($this->contact) {
            $this->nama = $this->contact->nama;
            $this->nomor = $this->contact->nomor;
        }
    }

    // Method untuk menyimpan perubahan kontak
    public function updateContact()
    {
        // Validasi untuk nama dan nomor
        $this->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|max:20',
        ]);

        // Update data kontak
        DB::table('contact_admin')
            ->where('id', $this->contactId)
            ->update([
                'nama' => $this->nama,
                'nomor' => $this->nomor,
            ]);

        // Setelah update, beri notifikasi dan kembali ke halaman sebelumnya
        session()->flash('message', 'Contact updated successfully!');
        return redirect('/admin/contact'); // Kembali ke daftar buku
    }

    public function render()
    {
        return view('livewire.admin.contact-edit');
    }
}
