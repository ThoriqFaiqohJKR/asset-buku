<div>
    {{-- Stop trying to control. --}}
    <div x-data="{ foto_barang: null, imagePreview: '' }" class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-2xl font-bold mb-6">Form Pengisian Asset</h1>
        <form wire:submit.prevent="store" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nomor Asset -->
            <div>
                <label class="block text-sm font-medium text-gray-700" for="nomor_asset">Nomor Asset</label>
                <input type="text" wire:model="nomor_asset" id="nomor_asset" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                @error('nomor_asset') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Nama Barang -->
            <div>
                <label class="block text-sm font-medium text-gray-700" for="nama_barang">Nama Barang</label>
                <input type="text" wire:model="nama_barang" id="nama_barang" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                @error('nama_barang') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Serial Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700" for="serial_number">Serial Number</label>
                <input type="text" wire:model="serial_number" id="serial_number" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                @error('serial_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Foto Barang -->
            <div>
                <label class="block text-sm font-medium text-gray-700" for="foto_barang">Foto Barang</label>
                <input x-ref="fileInput" wire:model="foto_barang" accept="image/*" id="foto_barang" type="file" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    @change="imagePreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : ''">
                <div class="mt-4" x-show="imagePreview">
                    <img :src="imagePreview" alt="Preview Foto Barang" class="w-full max-w-full h-auto object-contain rounded-md shadow-md" />
                </div>
                @error('foto_barang') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Beli -->
            <div>
                <label for="tanggal_beli" class="block text-sm font-medium text-gray-700">Tanggal Beli</label>
                <input type="date" wire:model="tanggal_beli" id="tanggal_beli" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                @error('tanggal_beli') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Harga Barang -->
            <div>
                <label class="block text-sm font-medium text-gray-700" for="harga_barang">Harga Barang</label>
                <input type="number" wire:model="harga_barang" id="harga_barang" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                @error('harga_barang') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Jenis Barang -->
            <div>
                <label class="block text-sm font-medium text-gray-700" for="jenis_barang">Jenis Barang</label>
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
                @error('jenis_barang') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Stok Asset -->
            <div>
                <label class="block text-sm font-medium text-gray-700" for="stok">Stok Asset</label>
                <input type="number" wire:model="stok" id="stok" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Tombol Simpan -->
            <div>
                <button class="w-full bg-indigo-600 text-white p-2 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>
