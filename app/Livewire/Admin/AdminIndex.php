<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AdminIndex extends Component
{
    public $chartData;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
{
    $bukuData = [];
    $assetData = [];
    $labels = [];

    for ($month = 1; $month <= 12; $month++) {
        $labels[] = date("F", mktime(0, 0, 0, $month, 1)); // Nama bulan (Januari, Februari, ...)

        $bukuData[] = DB::table('peminjaman')
            ->where('kode_uniq', 'like', 'B%')
            ->whereMonth('tanggal_pinjam', $month)
            ->count();

        $assetData[] = DB::table('peminjaman')
            ->where('kode_uniq', 'like', 'A%')
            ->whereMonth('tanggal_pinjam', $month)
            ->count();
    }

    $this->chartData = [
        'labels' => $labels,
        'buku' => $bukuData,
        'asset' => $assetData,
    ];

    // Debugging
    logger()->info('Chart Data: ', $this->chartData);
}


    public function render()
    {
        return view('livewire.admin.admin-index', [
            'bukuCount' => DB::table('peminjaman')->where('kode_uniq', 'like', 'B%')->count(),
            'assetCount' => DB::table('peminjaman')->where('kode_uniq', 'like', 'A%')->count(),
            'peminjamanCount' => DB::table('peminjaman')->count(),
            'jatuhTempo' => DB::table('peminjaman')
                ->whereDate('tanggal_kembali', '<', now()) // Filter yang jatuh tempo
                ->get()
        ]);
    }
    
}

