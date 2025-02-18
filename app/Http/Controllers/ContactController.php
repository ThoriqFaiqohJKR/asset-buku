<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
 
    public function index()
    {
    return view('admin.contant-index'); // Kirim ke view
    }

    
    public function edit($id)
    {
        $contact = DB::table('contact_admin')->where('id', $id)->first();
        return view('admin.contact-edit', compact('contact'));
    }

    public function show($id)
    {
        $contact = DB::table('contact_admin')->where('id', $id)->first();
        return view('admin.contact-detail', compact('contact'));
    }
}
