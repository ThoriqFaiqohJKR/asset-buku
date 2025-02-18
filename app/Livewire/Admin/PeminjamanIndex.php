<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PeminjamanIndex extends Component
{
    public $search = ''; // Properti untuk pencarian nama peminjam
    public $status = ''; // Properti untuk status peminjaman
    public $kategori = ''; // Properti untuk kategori (buku atau asset)
    public $date_from = ''; // Properti untuk filter tanggal mulai
    public $date_to = ''; // Properti untuk filter tanggal akhir

    public function render()
    {
        // Ambil data peminjaman dari database dan terapkan filter berdasarkan input
        $peminjaman = DB::table('peminjaman')
            ->when($this->search, function ($query) {
                return $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->kategori, function ($query) {
                return $query->where('kategori', $this->kategori);
            })
            ->when($this->date_from, function ($query) {
                return $query->where('tanggal_pinjam', '>=', $this->date_from);
            })
            ->when($this->date_to, function ($query) {
                return $query->where('tanggal_kembali', '<=', $this->date_to);
            })
            ->get();

        // Logika untuk memeriksa status jatuh tempo
        foreach ($peminjaman as $data) {
            if ($data->status == 'Dipinjam' && strtotime($data->tanggal_kembali) < time()) {
                DB::table('peminjaman')
                    ->where('id', $data->id)
                    ->update(['status' => 'Jatuh Tempo']);

                $data->status = 'Jatuh Tempo';
            }
        }

        return view('livewire.admin.peminjaman-index', compact('peminjaman'));
    }

    public function exportCsv()
    {
        // Ambil data yang telah difilter
        $peminjaman = DB::table('peminjaman')
            ->when($this->search, function ($query) {
                return $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->kategori, function ($query) {
                return $query->where('kategori', $this->kategori);
            })
            ->when($this->date_from, function ($query) {
                return $query->where('tanggal_pinjam', '>=', $this->date_from);
            })
            ->when($this->date_to, function ($query) {
                return $query->where('tanggal_kembali', '<=', $this->date_to);
            })
            ->get();

        // Header CSV 
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="peminjaman.csv"',
        ];

        // Membuat file CSV dan mengisi data
        $callback = function () use ($peminjaman) {
            $file = fopen('php://output', 'w');

            // Menulis header CSV
            fputcsv($file, ['No', 'Nama Peminjam', 'Barang/Buku', 'Tanggal Pinjam', 'Tanggal Kembali', 'Status']);

            // Menulis data peminjaman
            foreach ($peminjaman as $index => $data) {
                fputcsv($file, [
                    $index + 1, // No
                    $data->nama,
                    $data->barang,
                    $data->tanggal_pinjam,
                    $data->tanggal_kembali,
                    $data->status,
                ]);
            }

            fclose($file);
        };

        // Mengembalikan response CSV
        return response()->stream($callback, 200, $headers);
    }
}
