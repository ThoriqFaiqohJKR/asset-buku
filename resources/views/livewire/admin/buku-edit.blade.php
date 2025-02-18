<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-300">
        <h1 class="text-2xl font-bold mb-6">Edit Buku</h1>

        <form wire:submit.prevent="update" enctype="multipart/form-data">
            @csrf

            <!-- Nama Buku -->
            <div class="mb-4"> 
                <label class="block text-gray-700 font-semibold">Nama Buku</label>
                <input type="text" wire:model="nama_buku" class="w-full p-2 border rounded-md">
                @error('nama_buku') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Ringkasan -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Ringkasan</label>
                <textarea wire:model="ringkasan" class="w-full p-2 border rounded-md" rows="4"></textarea>
                @error('ringkasan') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Gambar Buku -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Gambar Buku</label>
                @if ($gambar_buku)
                    <img src="{{ $gambar_buku->temporaryUrl() }}" alt="Gambar Baru"  class="w-1/2 max-w-full h-auto object-contain rounded-md shadow-md mx-auto" />
                @elseif($gambarLama)
                    <img src="{{ asset($gambarLama) }}" alt="Gambar Lama"  class="w-1/2 max-w-full h-auto object-contain rounded-md shadow-md mx-auto" />
                @endif
                <input type="file" wire:model="gambar_buku" class="w-full p-2 border rounded-md">
                @error('gambar_buku') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Stok Buku -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Stok</label>
                <input type="number" wire:model="stok" class="w-full p-2 border rounded-md">
                @error('stok') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold" for="kategori">Kategori Buku</label>
                <select wire:model="kategori" id="kategori" class="w-full p-2 border rounded-md">
                    
                    <option value="Fiksi">Fiksi</option>
                    <option value="Non-Fiksi">Non-Fiksi</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Sejarah">Sejarah</option>
                    <option value="Teknologi">Teknologi</option>
                </select>
                @error('kategori') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>


            <div class="mb-4">
                <label class="block text-gray-700 font-semibold" for="kategori">Kategori Buku</label>
                <select wire:model="location" id="location" class="w-full p-2 border rounded-md">
                <option value="perpustakaan auriga">Perpustakaan Auriga</option>
                    <option value="perpustakaan bang TM">Perpustakaan Bang TM</option>
                    <option value="perpustakaan gakkum">Perpustakaan Gakkum</option>
                </select>
                @error('location') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>


            <!-- QR Code -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">QR Code</label>
                @if($buku && $buku->qr_code)
                    <img src="{{ asset($buku->qr_code) }}" alt="QR Code Buku" class="w-32 h-32 object-cover rounded-md">
                @endif
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<div class="mt-6 flex justify-center">
   <button class="bg-black text-white border-2 px-4 py-2 md:px-6 md:py-3 rounded hover:bg-white hover:text-black">
     <a href="{{ url('/admin/buku/') }}">Kembali</a>
    </button>
   </div>
</div>
