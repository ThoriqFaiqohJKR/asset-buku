<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-300">
            <h1 class="text-2xl font-bold mb-6">Edit Asset</h1>
            @if (session()->has('message'))
                <div class="text-green-500">{{ session('message') }}</div>
            @endif
            <form wire:submit.prevent="update" enctype="multipart/form-data">
                @csrf
                <!-- Nama Barang -->
                <div class="mb-4"> 
                    <label class="block text-gray-700 font-semibold">Nomor Asset</label>
                    <input type="text" id="nama_barang" wire:model="nama_barang" class="w-full p-2 border rounded-md">
                    @error('nomor_asset') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4"> 
                    <label class="block text-gray-700 font-semibold">Nama Barang</label>
                    <input type="text" id="nama_barang" wire:model="nama_barang" class="w-full p-2 border rounded-md">
                    @error('nama_barang') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <!-- Jenis Barang -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Jenis Barang</label>
                    <select wire:model="jenis_barang" id="jenis_barang" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="" disabled selected>Pilih Jenis</option>
                    <option value="building">Building</option>
                    <option value="kendaraan">Kendaraan</option>
                    <optgroup label="Peralatan">
                        <option value="peralatan mebel">Peralatan Mebel</option>
                        <option value="peralatan non elektronik">Peralatan Non Elektronik</option>
                        <option value="peralatan elektronik">Peralatan Elektronik</option>
                        <option value="peralatan drone">Peralatan Drone</option>
                        <option value="peralatan multimedia">Peralatan Multimedia</option>
                    </optgroup>
                    <optgroup label="Lain-lain">
                        <option value="software">Software</option>
                        <option value="perlengkapan">Perlengkapan</option>
                    </optgroup>
                </select>
                    @error('jenis_barang') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <!-- Harga Barang -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Harga Barang</label>
                    <input type="number" id="harga_barang" wire:model="harga_barang" class="w-full p-2 border rounded-md">
                    @error('harga_barang') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <!-- Kategori Barang --> 
           
                <!-- Stok -->
                <div class="mb-4"> 
                    <label class="block text-gray-700 font-semibold">Stok</label>
                    <input type="number" id="stok" wire:model="stok" class="w-full p-2 border rounded-md">
                    @error('stok') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <!-- Foto Barang -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Foto Barang</label>
                    @if ($foto_barang)
                        <img src="{{ $foto_barang->temporaryUrl() }}" alt="Gambar Baru" class="w-full h-auto rounded-md my-2">
                    @elseif($foto_lama)
                        <img src="{{ asset($foto_lama) }}" alt="Foto Lama" class="w-full h-auto rounded-md my-2">
                    @endif
                    <input type="file" id="foto_barang" wire:model="foto_barang" class="w-full p-2 border rounded-md">
                    @error('foto_barang') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <!-- Tombol Simpan -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                    Update
                </button>
            </form> 
        </div>
    </div>
</div>