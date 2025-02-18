<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UserIndex extends Component
{
    public $users;

    // Ambil data user langsung dari database saat komponen dimuat
    public function mount()
    {
        $this->users = DB::table('users')->get();
    }

    // Fungsi untuk menghapus user berdasarkan ID
    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();

        // Setelah dihapus, refresh data pengguna
        $this->users = DB::table('users')->get();

        session()->flash('message', 'User berhasil dihapus.');
    }

    // Render tampilan Livewire
    public function render()
    {
        return view('livewire.admin.user-index');
    }
}
