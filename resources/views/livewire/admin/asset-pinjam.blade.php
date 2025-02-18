<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Peminjaman Asset</h2>

        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="nama" class="block text-gray-700">Nama Peminjam</label>
                <input type="text" wire:model="nama" id="nama" class="w-full mt-2 p-2 border rounded" required>
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
    <label for="asset" class="block text-gray-700 font-semibold">Nama Asset</label>
    <input type="text" class="w-full p-2 border rounded-md bg-gray-100"
           value="{{ $assets->firstWhere('id', $asset)->nama_barang ?? 'Asset tidak ditemukan' }}" 
           readonly>
</div>


            <div class="mb-4">
                <label for="tanggal_pinjam" class="block text-gray-700">Tanggal Pinjam</label>
                <input type="date" wire:model="tanggal_pinjam" id="tanggal_pinjam" class="w-full mt-2 p-2 border rounded" required>
                @error('tanggal_pinjam') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_kembali" class="block text-gray-700">Tanggal Kembali</label>
                <input type="date" wire:model="tanggal_kembali" id="tanggal_kembali" class="w-full mt-2 p-2 border rounded" required>
                @error('tanggal_kembali') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4 flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Simpan Peminjaman 
                </button>
            </div>
        </form>
    </div>
</div>

</div>
