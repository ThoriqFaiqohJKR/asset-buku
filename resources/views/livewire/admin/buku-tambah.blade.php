<div>
    {{-- Stop trying to control. --}}
    <div x-data="{ gambar_buku: null, imagePreview: '' }" class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">Form Pengisian Buku</h1>

        <form wire:submit.prevent="store" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700" for="bookName">
                    Nama Buku
                </label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    wire:model="nama_buku" id="bookName" name="bookName" required="" type="text" />
                @error('nama_buku') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="bookDescription">
                    Deskripsi Buku
                </label>
                <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    wire:model="ringkasan" id="bookDescription" name="bookDescription" required="" rows="4"></textarea>
                @error('ringkasan') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="bookImage">
                    Gambar Buku
                </label>
                <input x-ref="fileInput" accept="image/*"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    id="bookImage" name="bookImage" type="file"
                    wire:model="gambar_buku"
                    @change="imagePreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : ''">
                @error('gambar_buku') <span>{{ $message }}</span> @enderror
                <div class="mt-4" x-show="imagePreview">
                    <img :src="imagePreview" alt="Preview Gambar Buku"
                    class="w-1/2 max-w-full h-auto object-contain rounded-md shadow-md mx-auto" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="bookStock">
                    Stock Buku
                </label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    wire:model="stok" id="bookStock" name="bookStock" required="" type="number" />
                @error('stok') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="bookCategory">
                    Kategori Buku
                </label>
                <select wire:model="kategori" id="bookCategory" name="bookCategory" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required="">
                <option value="fiksi">Fiksi</option>
<option value="makanan">Makanan</option>
<option value="novel">Novel</option>
<option value="cergam">Cerita Gambar</option>
<option value="komik">Komik</option>
<option value="ensiklopedi">Ensiklopedi</option>
<option value="biografi">Biografi</option>
<option value="dongeng">Dongeng</option>
<option value="biografi">Biografi</option>
<option value="fotografi">Fotografi</option>
<option value="majalah">Majalah</option>
<option value="kamus">Kamus</option>
<option value="biografi">Biografi</option>
                    
                </select>
                @error('kategori') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="bookLocation">
                    Location Buku
                </label>
                <select wire:model="location" id="bookLocation" name="bookLocation" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required="">
                    <option value="">Pilih Location</option>
                    <option value="perpustakaan aurigap'">Perpustakaan Auriga</option>
                    <option value="perpustakaan bang TM">Perpustakaan Bang TM</option>
                    <option value="erpustakaan gakkum">Perpustakaan Gakkum</option>
                </select>
                @error('location') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <button class="w-full border-2 p-2 rounded-md shadow-md  focus:outline-none hover:bg-black  hover:text-white" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <div class="mt-6 flex justify-center">
   <button class="border-2 px-4 py-2 md:px-6 md:py-3 rounded hover:bg-black  hover:text-white">
     <a href="{{ url('/admin/buku/') }}">Kembali</a>
    </button> 
   </div>
</div>
