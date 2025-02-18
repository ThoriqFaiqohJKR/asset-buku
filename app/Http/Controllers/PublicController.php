<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    //
    public function index()
    {
        return view('user.user-index');
    }

    
     public function show($id) 
    {
        $book = DB::table('buku')->where('id', $id)->first();
    
        return view('user.buku-detail', compact('book'));
    }

    public function list()
    {
        return view('user.daftar-buku');
    }

    public function showasset($id) 
    {
        $asset = DB::table('asset')->where('id', $id)->first();
    
        return view('user.asset-detail', compact('asset'));
    }

    public function listasset()
    {
        return view('user.daftar-asset');
    }
    
}
