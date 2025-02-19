<div class="w-full flex-col items-center justify-center min-h-screen px-4 md:px-8 lg:px-16 lg:py-20 pt-20  bg-gray-600">
   <div class="flex flex-col lg:flex-row items-center justify-center relative">
      <div class="lg:w-2/3 bg-zinc-100 shadow-md rounded-lg p-6 w-full">
         <div class="flex justify-between items-center mb-6 mt-12 lg:mt-0">
            <h2 class="text-2xl font-bold text-left">Detail Buku</h2>
            <a class="text-blue-500 px-4 py-2 hover:text-black focus:outline-none" href="/user/list/book">
               <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
         </div>
         <div class="flex flex-col lg:flex-row gap-4 w-full">
            <div class="lg:w-1/3 text-center w-full">
               <img alt="Cover Buku" class="w-full max-w-xs mx-auto mb-4 rounded-lg"
                  src="{{ $book->gambar_buku }}" />
            </div>
            <div class="lg:w-2/3 lg:pl-6 text-left w-full">
               <h3 class="text-2xl font-bold text-blue-800 mb-4">
                  {{ $book->nama_buku ?? 'Judul Buku' }}
               </h3>
               <div class="mb-4" x-data="{ expanded: false }">
                  <span class="font-bold">Uraian:</span>
                  <div class="relative">
                     <p class="text-gray-700 overflow-hidden transition-all duration-300"
                        :class="expanded ? 'max-h-none' : 'line-clamp-3'">
                        {{ $book->ringkasan }}
                     </p>
                  </div>
                  @if(strlen($book->ringkasan) > 100)
                  <button class="text-blue-500 hover:underline mt-2"
                     x-on:click="expanded = !expanded"
                     x-text="expanded ? 'Read Less' : 'Read More'">
                  </button>
                  @endif
               </div>
               <div>
                  <span class="font-bold">kategori :</span>
                  <span>{{ $book->kategori }}</span>
               </div>
               <div>
                  <span class="font-bold">Lokasi :</span>
                  <span>{{ $book->location ?? 'Tidak tersedia' }}</span>
               </div>
               <div>
                  <span class="font-bold">Stok:</span>
                  <span>{{ $book->stok ?? 'Tidak tersedia' }}</span>
               </div>
               <div class="mt-4 flex gap-4">
        <button onclick="window.location.href='https://wa.me/+62{{ ltrim($contact1->nomor, '0') }}'" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none">
         Contact Admin 1
        </button>
        <button onclick="window.location.href='https://wa.me/+62{{ ltrim($contact2->nomor, '0') }}'" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none">
         Contact Admin 2
        </button>
       </div>
            </div>
            
         </div>
      </div>
   </div>
   <div class="flex justify-center mt-6">
   <h2 class="text-2xl text-white font-bold text-center mb-4">
            Rekomendasi Buku
         </h2>
   </div>
   <!-- Rekomendasi Buku -->
   <div class="flex justify-center mt-6">
      <div class="lg:w-2/3 bg-white shadow-md rounded-lg p-6 ">

         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($recommendations->where('kategori', $kategori) as $recommendedBook)
            <div class="bg-gray-100 p-4 rounded-lg ">
               <a href="{{ url('/user/book/' . $recommendedBook->id) }}" class="block">
                  <img
                     alt="Cover Buku"
                     class="w-full rounded-lg object-cover h-64"
                     src="{{ $recommendedBook->gambar_buku }}" />
                  <h3 class="text-lg font-bold mt-2 text-center">
                     {{ $recommendedBook->nama_buku }}
                  </h3>
                  
               </a>
               <p class="text-sm text-gray-600 mt-1">
                  <strong>Kategori:</strong> {{ $recommendedBook->kategori }}
               </p>
               <p class="text-sm text-gray-600">
                  <strong>Stok:</strong> {{ $recommendedBook->stok }}
               </p>
            </div>
            @endforeach
         </div>
      </div>
   </div>

</div>