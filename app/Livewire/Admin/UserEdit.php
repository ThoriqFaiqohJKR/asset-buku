<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UserEdit extends Component
{
    public $userId, $name, $email, $role, $password;

    public function mount($userId)
    {
        $user = DB::table('users')->where('id', $userId)->first();

        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|string|in:admin,user',
            'password' => 'nullable|string|min:6', // Password bisa kosong
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'updated_at' => now(),
        ];

        // Jika password diisi, tambahkan ke update
        if (!empty($this->password)) {
            $data['password'] = $this->password; // Sesuai preferensi user (tidak di-hash)
        }

        DB::table('users')->where('id', $this->userId)->update($data);

        session()->flash('message', 'User berhasil diperbarui.');

        return redirect('/admin/users'); // Kembali ke daftar user
    }

    public function render()
    {
        return view('livewire.admin.user-edit');
    }
}
