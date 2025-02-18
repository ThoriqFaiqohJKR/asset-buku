<div class="container mx-auto p-6">
    <div class="flex flex-wrap justify-center gap-6">
        <!-- Book Card -->
        <div class="w-full md:w-2/3 lg:w-1/2 bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <img alt="QR code for admin access" class="w-32 h-32 mx-auto" height="120" src="{{ $buku->qr_code }}" width="120" />
            </div>

            <div class="p-6 mx-6 border border-gray-300 rounded-lg"
                x-data="{ expanded: false, showReadMore: false }"
                x-init="showReadMore = $refs.description.scrollHeight > 80">

                <!-- Gambar Cover Buku -->
                <img alt="Cover image of the book with a scenic background" class="w-full h-auto object-contain mb-4" height="300" src="{{ $buku->gambar_buku }}" width="400" />

                <h2 class="text-xl font-bold text-gray-800 mt-4">
                    {{ $buku->nama_buku }}
                </h2>

                <!-- Ringkasan dengan break-word dan overflow -->
                <p x-ref="description"
                    :class="{ 'max-h-20': !expanded, 'max-h-full': expanded }"
                    class="text-gray-600 mt-2 overflow-hidden transition-all duration-300 w-full break-words max-w-full">
                    Description: {{ $buku->ringkasan }}
                </p>

                <!-- Tampilkan Read More hanya jika teks panjang -->
                <div class="mt-6 flex justify-between items-center" x-show="showReadMore">
                    <a @click="expanded = !expanded" class="text-blue-500 hover:underline cursor-pointer">
                        <span x-show="!expanded">Read More</span>
                        <span x-show="expanded">Read Less</span>
                    </a>
                </div>

                <p class="text-gray-600 mt-2">
                    Kategori: {{ $buku->kategori }}
                </p>
                <p class="text-gray-600 mt-2">
                    Location : {{ $buku->location }}
                </p>
            </div>

            <div class="p-6 flex justify-center gap-2">
                <button class="border-2 px-4 py-2 md:px-6 md:py-3 rounded hover:bg-black hover:text-white">
                    <a taget="_blank"onclick="window.open('{{ url('/storage/qr_codes/buku/qr_' . $buku->id. '.png') }}').print()">Print QR Code</a>
                </button>
                <button class="border-2 px-4 py-2 md:px-6 md:py-3 rounded hover:bg-black hover:text-white">
                    <a href="{{ url('/admin/buku/' . $buku->id . '/pinjam') }}">Pinjam Buku ini</a>
                </button>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-center">
        <button class="bg-black text-white border-2 px-4 py-2 md:px-6 md:py-3 rounded hover:bg-white hover:text-black">
            <a href="{{ url('/admin/buku/') }}">Kembali</a>
        </button>
    </div>
</div>