<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerLogin extends Controller
{
    //
    public function showAdminLogin()
    {
        return view('admin.admin-login');
    }

    public function showUserLogin()
    {
        return view('liveiwre.user.login');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
            ]);

        if (Auth::attempt(['email'=> $request->email,'password'=> $request->password, 'role' => 'admin'])) {
            session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        
        return back()->withErrors([ 'email'=>'Email atau Password Salah.']);
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'user'])) {
            session()->regenerate();
            return redirect()->route('user.dashboard');
        }
        return back()->withErrors([ 'email'=> 'Email atau Password Salah.']);
    }

    public function showAdminDashboard()
    {
        // Pastikan user sudah login dan memiliki role admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('admin.admin-index'); // Mengarah ke view resources/views/admin/admin-index.blade.php
        }
    
        // Jika bukan admin, redirect atau tampilkan halaman lain
        return redirect()->route('home');
    }


    public function showUserDashboard()
    {
        if (Auth::check() && Auth::user()->role == 'user') {
            return view('user.dashboard'); // Halaman dashboard user
        }
        return view('livewire.user.dashboard');
    }
}
