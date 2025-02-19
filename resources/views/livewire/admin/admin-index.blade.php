<div class="container mx-auto p-4 min-h-screen">
    <h1 class="text-2xl font-bold">
        Admin Dashboard
    </h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Data Buku -->
        <div class=" bg-gray-700 text-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <img alt="Icon representing books" class="w-12 h-12 mr-4" height="50" src="https://storage.googleapis.com/a1aa/image/1eZzeLVhWWx4aMZD8k9_kfG1PNHJIHVfhD-LreXPcn4.jpg" width="50" />
                <div>
                    <h2 class="text-xl font-semibold">
                        Data Buku
                    </h2>
                    <p class="text-white">
                        Total: {{ $bukuCount }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Data Asset -->
        <div class=" bg-gray-700 text-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <img alt="Icon representing assets" class="w-12 h-12 mr-4" height="50" src="https://storage.googleapis.com/a1aa/image/rwQGSkVubAnmlK3Ur9vQJX3AJMx_ZzczV-pWhVX1y20.jpg" width="50" />
                <div>
                    <h2 class="text-xl font-semibold">
                        Data Asset
                    </h2>
                    <p class="text-white">
                        Total: {{ $assetCount }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Data Peminjam -->
        <div class=" bg-gray-700 text-white p-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <img alt="Icon representing borrowers" class="w-12 h-12 mr-4" height="50" src="https://storage.googleapis.com/a1aa/image/eG-CkVXVIZYzyRDRz1VvrVkwvSOpYbrUdzxadKi5cU0.jpg" width="50" />
                <div>
                    <h2 class="text-xl font-semibold">
                        Data Peminjam
                    </h2>
                    <p class="text-white">
                        Total: {{ $peminjamanCount }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Jatuh Tempo -->
        <div class=" bg-gray-700 text-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">
                Jatuh Tempo
            </h2>
            <p class="text-white">
                Total: {{ $jatuhTempo->count() }}
            </p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-4">
        <!-- Daftar Jatuh Tempo -->
        <div class="w-full md:w-1/2 bg-gray-700 text-white p-4 rounded-lg shadow-md ">
            <h2 class="text-xl font-semibold mb-4">Daftar Jatuh Tempo</h2>
            <div class="hidden md:flex gap-4 border-b py-2 px-4 font-semibold">
                <div class="w-8">No</div>
                <div class="w-1/3">Nama Peminjam</div>
                <div class="w-1/3">Barang</div>
                <div class="w-1/3">Tanggal Jatuh Tempo</div>
            </div>
            <div>
                @foreach($jatuhTempo as $index => $item)
                    <div class="md:flex gap-4 border-b py-2 px-4">
                        <div class="hidden md:block w-8">{{ $index + 1 }}</div>
                        <div class="w-1/3">{{ $item->nama }}</div>
                        <div class="w-1/3">{{ $item->barang }}</div>
                        <div class="w-1/3">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('Y-m-d') }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Chart -->
        <div class="w-full md:w-1/2 bg-gray-700 p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-white">Grafik Peminjaman</h2>
            <div class="chart-container" style="position: relative; height: 400px;">
                <canvas id="peminjamanChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('peminjamanChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['labels']) !!}, // ['Februari']
                datasets: [
                    {
                        label: 'Jumlah Buku',
                        data: {!! json_encode($chartData['buku']) !!}, // Data Buku di Februari
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Jumlah Asset',
                        data: {!! json_encode($chartData['asset']) !!}, // Data Asset di Februari
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: { color: 'white' } // Warna label sumbu X jadi putih
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: 'white' } // Warna label sumbu Y jadi putih
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Warna label legend jadi putih
                        }
                    }
                }
            }
        });
    });
</script>
