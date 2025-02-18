<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <div>
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">Form Peminjaman Buku</h1>
        
        @if (session()->has('message'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('message') }}
            </div>
        @endif
        
        <!-- Pesan Stok Habis -->
        @if ($stokHabis)
            <div class="mb-4 text-red-600 font-semibold">
                Stok buku ini sudah habis. Peminjaman tidak bisa dilakukan.
            </div>
        @endif
        
        <form wire:submit.prevent="store" class="space-y-6">
            <!-- Dropdown Nama User -->
            <div class="mb-4">
                <label for="namaPemilih" class="block text-gray-700 font-semibold">Nama</label>
                <input type="text" wire:model="nama" id="namaPemilih" 
                       class="w-full p-2 border rounded-md bg-gray-100" required />
                @error('nama') <span class="text-red-500">{{ $message }}</span> @enderror
            </div> 

            <!-- Nama Buku (readonly) -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Nama Buku</label>
                <input type="text" class="w-full p-2 border rounded-md bg-gray-100" 
                       value="{{ $bukus->firstWhere('id', $barang)->nama_buku ?? 'Buku tidak ditemukan' }}" 
                       readonly>
            </div>

            <!-- Tanggal Pinjam -->
            <div>
                <label for="tanggalPinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                <input type="date" wire:model="tanggal_pinjam" id="tanggalPinjam" 
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                @error('tanggal_pinjam') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Kembali -->
            <div>
                <label for="tanggalKembali" class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
                <input type="date" wire:model="tanggal_kembali" id="tanggalKembali" 
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                @error('tanggal_kembali') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-indigo-600 text-white p-2 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>


</div>