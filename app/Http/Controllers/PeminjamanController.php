<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class PeminjamanController extends Controller
{
    
    //
    public function index()
    {
        $peminjaman = DB::table('peminjaman')->get(); // Ambil data dari tabel
    return view('admin.peminjaman-index', compact('peminjaman')); // Kirim ke view
    }

    
    public function edit($id)
    {
        $peminjaman = DB::table('peminjaman')->where('id', $id)->first();
        return view('admin.peminjaman-edit', compact('peminjaman'));
    }
    
}
