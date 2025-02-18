<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BukuEdit extends Component
{
    use WithFileUploads;

    public $bukuId, $nama_buku, $ringkasan, $stok, $kategori, $gambar_buku, $location;
    public $buku, $gambarLama;

    public function mount($id)
    {
        $this->bukuId = $id;
        $this->buku = DB::table('buku')->where('id', $id)->first();

        if ($this->buku) {
            $this->nama_buku = $this->buku->nama_buku;
            $this->ringkasan = $this->buku->ringkasan;
            $this->stok = $this->buku->stok;
            $this->kategori = $this->buku->kategori;
            $this->location = $this->buku->location;
            $this->gambarLama = $this->buku->gambar_buku;
        }
    }

    public function update()
    {
        $this->validate([
            'nama_buku' => 'required|string|max:255',
            'ringkasan' => 'required|string',
            'stok' => 'required|integer',
            'kategori' => 'required|string',
            'location' => 'required|string',
            'gambar_buku' => $this->gambar_buku ? 'image|mimes:jpg,png,jpeg,gif|max:2048' : '',
        ]);

        $data = [
            'nama_buku' => $this->nama_buku,
            'ringkasan' => $this->ringkasan,
            'stok' => $this->stok,
            'kategori' => $this->kategori,
            'location' => $this->location,
            'updated_at' => now(),
        ];

        if ($this->gambar_buku instanceof \Illuminate\Http\UploadedFile) {
            if ($this->gambarLama && Storage::exists(str_replace('/storage/', 'public/', $this->gambarLama))) {
                Storage::delete(str_replace('/storage/', 'public/', $this->gambarLama));
            }

            $path = $this->gambar_buku->store('images', 'public'); // Simpan di storage/app/public/images
            $data['gambar_buku'] = '/storage/' . $path; // URL gambar 
        }

        DB::table('buku')->where('id', $this->bukuId)->update($data);

        session()->flash('message', 'Buku berhasil diperbarui!');

    // Redirect ke halaman daftar buku
    return redirect()->to('/admin/buku');
    // Redirect ke halaman daftar buku
    
    }

    public function render()
    {
        return view('livewire.admin.buku-edit');
    }
}
