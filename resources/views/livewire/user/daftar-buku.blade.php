<div class="w-full flex flex-col items-center justify-center min-h-screen bg-gray-600 pt-20 px-4 md:px-8 lg:px-16">
   <h1 class="text-2xl font-bold mb-4 text-white">
      List Book
   </h1>

   <!-- Search Box -->
   <div class="w-full max-w-5xl mb-4 relative">
      <input 
         wire:model.live.debounce.500ms="search" 
         class="w-full p-2 rounded border border-gray-300" 
         placeholder="Search for books..." 
         type="text"
      />
      <button class="absolute right-2 top-2 text-gray-500">
         <i class="fas fa-search"></i>
      </button>
   </div>

   <!-- Categories Dropdown -->
   <div class="w-full max-w-5xl mb-4">
      <select 
         wire:model="kategori" 
         class="w-full p-2 rounded border border-gray-300"
      >
         <option value="">All Categories</option>
         @foreach($categories as $category)
            <option value="{{ $category }}">{{ $category }}</option>
         @endforeach
      </select>
   </div>

   <!-- Book Grid -->
   <div class="bg-white p-4 rounded shadow w-full max-w-5xl min-h-[500px] flex flex-col">
 
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
         @forelse($bukus as $book)
            <div class="bg-white p-4 rounded shadow">
            <a href="{{ url('/user/book/' . $book->id) }}" class="block"> 
               <img 
                  alt="Cover of the book titled '{{ $book->nama_buku }}'" 
                  class="w-full h-48 object-cover rounded mb-4" 
                  src="{{ $book->gambar_buku ?? 'https://via.placeholder.com/300x200' }}" 
               />
               <h2 class="text-lg font-bold mb-2">
                  {{ $book->nama_buku }}
               </h2>
               <p class="text-gray-700">
                  Kategori: {{ $book->kategori }}
               </p>
               <p class="text-gray-700">
                  Lokasi: {{ $book->location }}
               </p>
               <p class="mt-2 font-semibold {{ $book->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $book->stok > 0 ? 'Tersedia' : 'Stok Habis' }}
               </p>
               </a>
            </div>
         @empty
            <div class="flex-grow flex items-center justify-center">
               <p class="text-gray-500">Tidak ada buku yang ditemukan.</p>
            </div>
         @endforelse
      </div>
   </div>
</div>
