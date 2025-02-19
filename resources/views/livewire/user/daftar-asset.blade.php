<div class="w-full flex flex-col items-center justify-center min-h-screen bg-gray-600 pt-20 px-4 md:px-8 lg:px-16">    
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Daftar Aset</h1>

    <!-- Search Box -->
    <div class="w-full max-w-5xl mb-4 relative">
        <input 
            wire:model.debounce.500ms="search" 
            class="w-full p-2 rounded border border-gray-300" 
            placeholder="Cari aset berdasarkan nama atau kode unik..." 
            type="text" 
        />
        <button class="absolute right-2 top-2 text-gray-500">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Categories Dropdown -->
    <div class="w-full max-w-5xl mb-4">
        <select wire:model.live="kategori" class="w-full p-2 rounded border border-gray-300">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category }}">{{ ucfirst($category) }}</option>
            @endforeach
        </select>
    </div>

    <!-- Asset List -->
    <div class="bg-white p-4 rounded shadow w-full max-w-5xl min-h-[500px] flex flex-col">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($assets as $asset)
                <div class="bg-white p-4 rounded shadow border">
                <a href="{{ url('/user/asset/' . $asset->id) }}" class="block"> 
                <img 
                  alt="Cover of the book titled '{{ $asset->foto_barang }}'" 
                  class="w-full h-48 object-cover rounded mb-4" 
                  src="{{ $asset->foto_barang ?? 'https://via.placeholder.com/300x200' }}" 
               />
                    <h2 class="text-lg font-bold mb-2">{{ $asset->nama_barang }}</h2>
                    <p class="text-gray-700"><strong>Kode:</strong> {{ $asset->kode_uniq }}</p>
                    <p class="text-gray-700"><strong>Jenis Asset:</strong> {{ $asset->jenis_barang }}</p>
                    <p class="mt-2 font-semibold {{ $asset->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $asset->stok > 0 ? 'Tersedia' : 'Stok Habis' }}
               </p>
                   </a>
                </div> 
            @empty
                <div class="flex-grow flex items-center justify-center col-span-3">
                    <p class="text-gray-500">Tidak ada aset yang ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $assets->links() }}
    </div>
</div>
