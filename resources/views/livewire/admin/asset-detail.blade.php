<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2">
                <!-- Asset Image -->
                <img alt="Detailed image of the asset showing its features and design" class="rounded-lg" height="400" src="{{ $asset->foto_barang }}" width="600"/>
            </div>
            <div class="md:w-1/2 md:pl-6 mt-4 md:mt-0">
                <h1 class="text-2xl font-bold mb-2">
                    {{ $asset->nama_barang }}
                </h1>
                <p class="text-gray-700 mb-4">
                    Jenis Asset:
                    <span class="font-semibold">
                        {{ $asset->jenis_barang }}
                    </span>
                </p>
                <p class="text-gray-700 mb-4">
                    Jenis Asset:
                    <span class="font-semibold">
                        {{ $asset->jenis_barang }}
                    </span>
                </p>
                <p class="text-gray-700 mb-4">
                    Serial Number:
                    <span class="font-semibold">
                        {{ $asset->serial_number }}
                    </span>
                </p>
                <p class="text-gray-700 mb-4">
                    Nomor Asset:
                    <span class="font-semibold">
                        {{ $asset->nomor_asset }}
                    </span>
                </p>
                <p class="text-gray-700 mb-4">
                    Stok:
                    <span class="font-semibold">
                        {{ $asset->stok }}
                    </span>
                </p>
                <p class="text-gray-700 mb-4">
                    Harga Asset:
                    <span class="font-semibold">
                        Rp. {{ number_format($asset->harga_barang, 0, ',', '.') }}
                    </span>
                </p>
                <div class="mt-4">
                    <!-- QR Code -->
                    <img alt="QR code for the asset" class="rounded-lg" height="150" src="{{ $asset->qr_code }}" width="150"/>
                </div>
                <div class="mt-6 flex space-x-4">
                    <!-- Print Button -->
                    <button class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-700">
                        <a taget="_blank"onclick="window.open('{{ url('/storage/qr_codes/asset/qr_' . $asset->id. '.png') }}').print()">
                            Print QR Code
                        </a>
                        </button>
                    <!-- Borrow Button -->
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    <a href="{{ url('/admin/asset/' . $asset->id . '/pinjam   ') }}">
                        Pinjam Asset
                        </a>
                    </button> 
                </div>
            </div>
        </div>
    </div>
</div>

</div>
