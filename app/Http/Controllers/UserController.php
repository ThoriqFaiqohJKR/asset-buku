<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Tampilkan semua data user.
     */
    public function index()
    {
        // Ambil data user dari database
        $users = DB::table('users')->get();

        // Kirim data ke tampilan
        return view('admin.user-index', compact('users'));
    }

    /**
     * Simpan user baru.
     */

     public function create()
     {
         // Render Livewire component untuk form tambah user
         return view('admin.user-tambah');
     }
     
     

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,user', // Validasi role
        ]);

        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'), // Sesuai preferensi user (tidak di-hash)
            'role' => $request->input('role'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('user.index')->with('message', 'User berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit user.
     */
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan.');
        }

        return view('admin.user-edit', ['id' => $id]); // Pastikan tampilan ada di folder yang tepat
    }

    /**
     * Update user berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'role' => 'required|string|in:admin,user', // Validasi role
        ]);

        DB::table('users')->where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'updated_at' => now(),
        ]);

        return redirect()->route('user.index')->with('message', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user berdasarkan ID.
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('user.index')->with('message', 'User berhasil dihapus.');
    }
}
