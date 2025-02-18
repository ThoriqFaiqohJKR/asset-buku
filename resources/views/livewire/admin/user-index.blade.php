<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="container mx-auto p-4">
    <!-- Header -->
    <header class="flex justify-between items-center py-4">
        <h1 class="text-3xl font-bold text-gray-800">Pengelolaan Pengguna</h1>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
        <a  href="{{ url('admin/users/create') }}" class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
  <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
</svg>

    <i class="fas fa-plus mr-2"></i> Tambah Pengguna
</a>
            </button>
    

    </header>

    <!-- Tampilkan pesan jika ada -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Role</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($users as $key => $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $key + 1 }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->role }}</td>
                        <td class="py-3 px-6 text-center">
                            <button class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 mr-2">
                            <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 mr-2">
    <i class="fas fa-edit"></i> Edit
</a>

                            </button>
                            <button wire:click="delete({{ $user->id }})" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
