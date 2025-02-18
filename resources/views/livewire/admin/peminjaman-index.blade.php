<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Daftar Peminjaman</h2>

    <div class="mb-4">
        <div class="flex flex-col md:flex-row md:space-x-4">
            <!-- Search Box -->
            <div class="mb-2 md:mb-0">
                <input type="text" placeholder="Cari Nama Peminjam" class="w-full px-4 py-2 border rounded" wire:model.live="search" />
            </div>
            
            <!-- Filter Kategori Barang/Buku -->
            <div class="mb-2 md:mb-0">
                <select class="w-full px-4 py-2 border rounded" wire:model.live="kategori">
                    <option value="">Semua Barang/Buku</option>
                    <option value="Buku">Buku</option>
                    <option value="Asset">Asset</option>
                </select>
            </div>
            
            <!-- Filter Tanggal Range -->
            <div class="mb-2 md:mb-0 flex flex-col md:flex-row md:space-x-2">
                <input type="date" class="w-full px-4 py-2 border rounded mb-2 md:mb-0" wire:model.live="date_from" />
                <span class="self-center md:mb-0">sampai</span>
                <input type="date" class="w-full px-4 py-2 border rounded" wire:model.live="date_to" />
            </div>
            
            <!-- Filter Status -->
            <div class="mb-2 md:mb-0">
                <select class="w-full px-4 py-2 border rounded" wire:model.live="status">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Kembali">Kembali</option>
                    <option value="Jatuh Tempo">Jatuh Tempo</option>
                </select>
            </div>

            <!-- Print CSV Button -->
            <div class="mb-2 md:mb-0">
                <button class="w-full px-4 py-2 rounded border bg-white hover:bg-black hover:text-white">
                    <a wire:click="exportCsv">Print CSV</a>
                </button>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <div class="min-w-full bg-white border">
            <!-- Header untuk Desktop -->
            <div class="hidden md:flex bg-gray-200">
                <div class="px-4 py-2 border w-1/12">No</div>
                <div class="px-4 py-2 border w-2/12">Nama Peminjam</div>
                <div class="px-4 py-2 border w-3/12">Barang/Buku</div>
                <div class="px-4 py-2 border w-2/12">Tanggal Pinjam</div>
                <div class="px-4 py-2 border w-2/12">Tanggal Kembali</div>
                <div class="px-4 py-2 border w-1/12">Status</div>
                <div class="px-4 py-2 border w-1/12">Aksi</div>
            </div>

            <!-- Data Peminjaman -->
            @foreach ($peminjaman as $index => $data)
                <div class="flex flex-col md:flex-row border-b md:border-none {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                    <div class="px-4 py-2 md:w-1/12">{{ $index + 1 }}</div>
                    <div class="px-4 py-2 w-full md:w-2/12 truncate max-w-xs">{{ $data->nama }}</div>
                    <div class="px-4 py-2 w-full md:w-3/12 truncate">{{ $data->barang }}</div>
                    <div class="px-4 py-2 w-full md:w-2/12 truncate">{{ $data->tanggal_pinjam }}</div>
                    <div class="px-4 py-2 w-full md:w-2/12 truncate">{{ $data->tanggal_kembali }}</div>
                    <div class="px-4 py-2 w-full md:w-1/12 truncate">{{ $data->status }}</div>
                    <div class="px-4 py-2 w-full md:w-1/12">
                        <div class="flex space-x-2">
                            <button class="hover:bg-black border hover:text-white px-4 py-2 rounded">
                                <a href="{{ url('/admin/peminjaman/' . $data->id . '/edit') }}">Edit</a>
                            </button>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
