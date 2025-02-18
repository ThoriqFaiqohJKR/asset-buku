<div>
    {{-- Do your work, then step back. --}}
    <div>
    {{-- Do your work, then step back. --}}
    <div class="container mx-auto p-4">
    <!-- Header -->
    <header class="py-4">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Pengguna</h1>
    </header>

    <!-- Menampilkan pesan sukses -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form -->
    <form wire:submit.prevent="store" class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input wire:model="name" type="text" id="name" class="w-full px-4 py-2 border rounded" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input wire:model="email" type="email" id="email" class="w-full px-4 py-2 border rounded" required>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input wire:model="password" type="password" id="password" class="w-full px-4 py-2 border rounded" required>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select wire:model="role" id="role" class="w-full px-4 py-2 border rounded" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Pengguna</button>
        </div>
    </form>
</div>

</div>

</div>
