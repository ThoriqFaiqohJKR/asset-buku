<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="w-full flex-col items-center justify-center min-h-screen px-4 md:px-8 lg:px-16 lg:py-20 pt-20 bg-gray-600">
   <div class="flex flex-col lg:flex-row items-center justify-center relative">
      <div class="lg:w-2/3 bg-zinc-100 shadow-md rounded-lg p-6 w-full">
         <div class="flex justify-between items-center mb-6 mt-12 lg:mt-0">
            <h2 class="text-2xl font-bold text-left">Detail Aset</h2>
            <a class="text-blue-500 px-4 py-2 hover:text-black focus:outline-none" href="/user/list/asset">
               <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
         </div>
         <div class="flex flex-col lg:flex-row gap-4 w-full">
            <div class="lg:w-1/3 text-center w-full">
               <img alt="Gambar Aset" class="w-full max-w-xs mx-auto mb-4 rounded-lg"
                  src="{{ $asset->foto_barang }}" />
            </div>
            <div class="lg:w-2/3 lg:pl-6 text-left w-full">
               <h3 class="text-2xl font-bold text-blue-800 mb-4">
                  {{ $asset->nama_aset ?? 'Nama Aset' }}
               </h3>
          
               <div>
                  <span class="font-bold">Kategori :</span>
                  <span>{{ $asset->jenis_barang }}</span>
               </div>
               <div>
                  <span class="font-bold">Lokasi :</span>
                  <span>{{ $asset->lokasi ?? 'Tidak tersedia' }}</span>
               </div>
               <div>
                  <span class="font-bold">Kondisi:</span>
                  <span>{{ $asset->kondisi ?? 'Tidak tersedia' }}</span>
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

</div>

</div>
