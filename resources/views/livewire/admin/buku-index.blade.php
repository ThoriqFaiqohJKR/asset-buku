<div class="bg-gray-100 overflow-x-hidden">

    <div class="container mx-auto p-4 max-w-full">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Daftar Buku</h1>
            <div class="flex flex-row space-x-2 sm:space-x-4">
                <a href="buku/create" class="border border-blue-500 text-blue-500 px-4 py-2 shadow-md hover:bg-blue-100 focus:outline-none flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Tambah Buku
                </a>
                <button>
                    <a wire:click="exportCsv" class="border border-blue-500 text-blue-500 px-4 py-2 shadow-md hover:bg-blue-100 focus:outline-none flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>

                        Print CSV
                    </a>
                </button>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-300 max-w-full overflow-hidden">
            <!-- Form Pencarian dan Filter -->
            <div class="flex flex-col md:flex-row md:justify-between mb-6">
                <input class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/4" placeholder="Cari Buku" type="text" wire:model.live.debounce.250ms="search">
                <select class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/4 md:ml-4" wire:model="kategori">
                    <option value="">Filter by Kategori</option>
                    <option value="Kategori 1">Kategori 1</option>
                    <option value="Kategori 2">Kategori 2</option>
                </select>
                <select class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/4 md:ml-4" wire:model.live="stok">
                    <option value="">Filter by Stock</option>
                    <option value="In Stock">In Stock</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
            </div>

            <!-- Daftar Buku -->
            <div class="space-y-6">
                @foreach($bukus as $buku)
                <div class="border border-gray-300 p-6 rounded-lg shadow-md bg-white hover:bg-gray-100 transition duration-300">
                    <a href="{{ url('/admin/buku/' . $buku->id . '/detail') }}" class="block"> 
                        <div class="flex flex-col sm:flex-row items-center">
                            <img src="{{ asset($buku->gambar_buku) }}" alt="Gambar Buku" class="w-32 h-32 object-cover rounded-md mb-4 sm:mr-4 max-w-full">
                            <div class="flex-1">
                                <h2 class="text-xl font-bold mb-2">Judul Buku: {{ $buku->nama_buku }}</h2>
                                <p class="text-gray-700 text-sm overflow-hidden text-ellipsis line-clamp-3">
                                    {{ Str::limit(strip_tags($buku->ringkasan), 150) }}
                                </p>


                                <p class="text-gray-700 font-semibold">Stock: {{ $buku->stok }}</p>
                                <p class="text-gray-700 font-semibold">Kategori: {{ $buku->kategori }}</p>
                                
                                <p class="text-gray-700 font-semibold">Lokasi : {{ $buku->location }}</p>
                            </div>
                            <img src="{{ asset($buku->qr_code) }}" alt="QR Code Buku" class="w-24 h-24 object-contain rounded-md max-w-full">
                        </div>
                    </a>

                    <!-- Tombol Edit & Hapus -->
                    <div class="mt-4 flex justify-end space-x-2">
                        <a href="{{ url('/admin/buku/' . $buku->id . '/edit') }}" class="px-4 py-2 border rounded-md shadow-md hover:bg-black hover:text-white">
                            Edit
                        </a>
                        <button wire:click="setConfirmDelete({{ $buku->id }})" class="px-4 py-2 border rounded-md shadow-md hover:bg-black hover:text-white">
                            Hapus
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-center">
                {{ $bukus->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    @if($confirmDeleteId)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
            <h3 class="text-xl font-semibold">Konfirmasi Penghapusan</h3>
            <p>Apakah kamu yakin ingin menghapus buku ini?</p>
            <div class="mt-4 flex space-x-4 justify-end">
                <button wire:click="hapusBuku({{ $confirmDeleteId }})" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                    Hapus
                </button>
                <button wire:click="$set('confirmDeleteId', null)" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                    Batal
                </button>
            </div>
        </div>
    </div>
    @endif

</div>