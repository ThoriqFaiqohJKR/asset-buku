<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-300">
        <h1 class="text-2xl font-bold mb-6">Edit Peminjaman</h1>
        
        <!-- Form to Edit Status -->
        <form wire:submit.prevent="updateStatus">
            <!-- Display Nama Peminjam -->
            <div class="mb-4">
                <label for="nama" class="block text-gray-700">Nama Peminjam</label>
                <input type="text" id="nama" value="{{ $nama }}" class="w-full p-2 border rounded bg-gray-100" readonly>
            </div>

            <!-- Display Barang/Buku -->
            <div class="mb-4">
                <label for="barang" class="block text-gray-700">Barang/Buku</label>
                <input type="text" id="barang" value="{{ $barang }}" class="w-full p-2 border rounded bg-gray-100" readonly>
            </div>

            <!-- Display Tanggal Pinjam -->
            <div class="mb-4">
                <label for="tanggal_pinjam" class="block text-gray-700">Tanggal Pinjam</label>
                <input type="text" id="tanggal_pinjam" value="{{ $tanggal_pinjam }}" class="w-full p-2 border rounded bg-gray-100" readonly>
            </div>

            <!-- Display Tanggal Kembali -->
            <div class="mb-4">
                <label for="tanggal_kembali" class="block text-gray-700">Tanggal Kembali</label>
                <input type="text" id="tanggal_kembali" value="{{ $tanggal_kembali }}" class="w-full p-2 border rounded bg-gray-100" readonly>
            </div>

            <!-- Select and Edit Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select wire:model="status" id="status" class="w-full p-2 border rounded">
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Kembali">Kembali</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan Status
            </button>
        </form>
    </div>
</div>
