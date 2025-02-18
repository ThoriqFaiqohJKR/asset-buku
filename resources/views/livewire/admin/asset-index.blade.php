<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <section class="container mx-auto px-4 py-5">
        <div>
        <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Daftar Asset</h1>
                <div class="flex flex-row space-x-1 sm:space-x-4">
                    <button class="bg-blue-500 text-white px-2 py-1 sm:px-4 sm:py-2 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <a class="flex items-center space-x-1 sm:space-x-2" href="asset/create">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            <span class="text-xs sm:text-base">
                                Tambah Asset
                            </span>
                        </a>
                    </button>
                    <button class="bg-green-500 text-white px-2 py-1 sm:px-4 sm:py-2 rounded-md shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <a class="flex items-center space-x-1 sm:space-x-2" wire:click="exportCsv">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            <span class="text-xs sm:text-base">
                                Print CSV
                            </span>
                        </a>
                    </button>
                </div>
            </div>


            <!-- Header -->
            <div class="flex justify-between items-center mb-6">

                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif

            </div>

            <!-- Search and Filter Section -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <!-- Search Input -->
                <input
                    type="text"
                    placeholder="Cari Asset..."
                    class="border border-gray-300  px-4 py-2 mb-4 md:mb-0 md:mr-4 w-full md:w-1/4"
                    wire:model.live.debounce.1000ms="search" />

                <!-- Filter by Jenis Barang -->
                <select
                    class="border border-gray-300 px-4 py-2 mb-4 md:mb-0 md:mr-4 w-full md:w-1/4"
                    wire:model="jenis_barang">
                    <option value="">Filter by Jenis Barang</option>
                    <option value="elekt">Jenis 1</option>
                    <option value="Jenis 2">Jenis 2</option>
                    <option value="Jenis 3">Jenis 3</option>
                </select>

                <!-- Filter by Kategori Barang -->
                <select
                    class="border border-gray-300  px-4 py-2 mb-4 md:mb-0 md:mr-4 w-full md:w-1/4"
                    wire:model="kategori_barang">
                    <option value="">Filter by Kategori Barang</option>
                    <option value="Kategori 1">Kategori 1</option>
                    <option value="Kategori 2">Kategori 2</option>
                    <option value="Kategori 3">Kategori 3</option>
                </select>

                <!-- Filter by Stock -->
                <select
                    class="border rounded p-2 px-4 py-2 mb-4 md:mb-0 md:mr-4 w-full md:w-1/4"
                    wire:model.live="stok">
                    <option value="">Filter by Stock</option>
                    <option value="In Stock">Tersedia</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
            </div>

            <!-- Asset List -->
            @if($assets->isEmpty())
            <div class="p-4 text-center text-gray-500">No assets found.</div>
            @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Table Header -->
                <div class="grid grid-cols-1 md:grid-cols-[50px_repeat(9,_1fr)] gap-4 p-4 bg-gray-100 hidden md:grid">
                    <div class="font-bold uppercase text-sm text-gray-600">No Asset</div>
                    <div class="font-bold uppercase text-sm text-gray-600">Image</div>
                    <div class="font-bold uppercase text-sm text-gray-600">Asset Name</div>                    
                    <div class="font-bold uppercase text-sm text-gray-600">Jenis Asset</div>
                    <div class="font-bold uppercase text-sm text-gray-600">Tanggal Beli</div>
                    <div class="font-bold uppercase text-sm text-gray-600">Harga Asset</div>
                    <div class="font-bold uppercase text-sm text-gray-600">Serial Number</div>
                    <div class="font-bold uppercase text-sm text-gray-600">QR Code</div>
                    <div class="font-bold uppercase text-sm text-gray-600">Stock</div>
                    <div class="font-bold uppercase text-sm text-gray-600">Actions</div>
                </div>

                <!-- Loop Through Assets -->
                @foreach ($assets as $index => $asset)
                <div class="grid grid-cols-1 md:grid-cols-[50px_repeat(9,_1fr)] gap-4 p-4 border-b border-gray-200">
                    <div class="flex justify-center items-center text-sm">{{ $asset->nomor_asset  }}</div>
                    <div class="flex justify-center">
                        <img class="w-16 h-16 object-cover rounded" src="{{ $asset->foto_barang }}" alt="Image of asset" />
                    </div>
                    <div class="break-words max-w-[150px] whitespace-normal">{{ $asset->nama_barang }}</div>
                    <div class="break-words max-w-[120px] whitespace-normal">{{ $asset->jenis_barang }}</div>
                    <div class="break-words max-w-[120px] whitespace-normal">{{ $asset->tanggal_beli }}</div>
                    <div class="break-words max-w-[120px] whitespace-normal">RP. {{ $asset->harga_barang }}</div> 
                    <div class="break-words max-w-[120px] whitespace-normal">{{ $asset->serial_number }}</div>
                    <div>
                        <img class="w-16 h-16 object-cover rounded" src="{{ $asset->qr_code }}" alt="QR Code for asset" />
                    </div>                   
                    <div class="break-words max-w-[100px] whitespace-normal">{{ $asset->stok }}</div>
                    <div class="relative" x-data="{ open: false }">
     <button @click="open = !open" class="border px-4 py-2 rounded-lg hover:bg-black hover:text-white flex items-center justify-center w-full">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
       <path d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" stroke-linecap="round" stroke-linejoin="round">
       </path>
      </svg>
     </button>
     <div @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg" x-show="open">
      <a class="block px-4 py-2 hover:bg-gray-200" href="{{ url('/admin/asset/' . $asset->id . '/edit') }}">
       <svg class="w-6 h-6 inline-block mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zM16.863 4.487L19.5 7.125" stroke-linecap="round" stroke-linejoin="round">
        </path>
       </svg>
       Edit
      </a>
      <button class="block w-full text-left px-4 py-2 hover:bg-gray-200">
       <svg class="w-6 h-6 inline-block mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" stroke-linecap="round" stroke-linejoin="round">
        </path>
       </svg>
       Hapus
      </button>
      <a class="block px-4 py-2 hover:bg-gray-200" href="{{ url('/admin/asset/' . $asset->id . '/detail') }}">
       <svg class="w-6 h-6 inline-block mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" stroke-linecap="round" stroke-linejoin="round">
        </path>
       </svg>
       Info
      </a>
     </div>
    </div>
                </div>
                @endforeach
            </div>
            @endif
            <!-- Pagination Links -->
            <div class="mt-4">
                <ul class="flex flex-wrap justify-center space-x-2 sm:space-x-4">
                    @php
                    $currentPage = $assets->currentPage();
                    $lastPage = $assets->lastPage();
                    @endphp

                    <!-- Always show page 1 -->
                    @if($currentPage > 1)
                    <a href="{{ $assets->url(1) }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200 text-sm sm:text-base">1</a>
                    @endif

                    <!-- Show ... for pages in the middle -->
                    @if($currentPage > 3)
                    <span class="px-4 py-2 border border-gray-300 rounded-md bg-gray-200 text-sm sm:text-base">...</span>
                    @endif

                    <!-- Show previous page link if it's not the first page -->
                    @if($currentPage > 2)
                    <a href="{{ $assets->previousPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200 text-sm sm:text-base">{{ $currentPage - 1 }}</a>
                    @endif

                    <!-- Current page -->
                    <span class="px-4 py-2 border border-gray-300 rounded-md bg-blue-500 text-white text-sm sm:text-base">
                        {{ $currentPage }}
                    </span>

                    <!-- Show next page link if it's not the last page -->
                    @if($currentPage < $lastPage - 1)
                        <a href="{{ $assets->nextPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200 text-sm sm:text-base">{{ $currentPage + 1 }}</a>
                        @endif

                        <!-- Show ... for pages in the middle -->
                        @if($currentPage < $lastPage - 2)
                            <span class="px-4 py-2 border border-gray-300 rounded-md bg-gray-200 text-sm sm:text-base">...</span>
                            @endif

                            <!-- Always show last page -->
                            @if($currentPage < $lastPage)
                                <a href="{{ $assets->url($lastPage) }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200 text-sm sm:text-base">{{ $lastPage }}</a>
                                @endif
                </ul>
            </div>




            <!-- Modal for Delete Confirmation -->
            @if($confirmDeleteId)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                    <h3 class="text-xl font-semibold">Konfirmasi Penghapusan</h3>
                    <p>Apakah kamu yakin ingin menghapus asset ini?</p>
                    <div class="mt-4 flex space-x-4 justify-end">
                        <button wire:click="hapusAsset({{ $confirmDeleteId }})" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            Hapus
                        </button>
                        <button wire:click="$set('confirmDeleteId', null)" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>