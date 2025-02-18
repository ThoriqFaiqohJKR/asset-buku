<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserTambah extends Component
{
    public $name, $email, $password, $role;

    // Validasi form
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required|string|in:admin,user',
    ];

    public function store()
    {
        $this->validate();

        

        DB::table('users')->insert([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password), // Hash password before storing
            'role' => $this->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message', 'User berhasil ditambahkan.');
        $this->reset(); // Reset input form
        return redirect()->to('/admin/users');
    }

    public function render()
    {
        return view('livewire.admin.user-tambah');
    }
}
