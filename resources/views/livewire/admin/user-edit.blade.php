<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Pengguna</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label class="block">Nama</label>
            <input type="text" wire:model="name" class="w-full border p-2">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" wire:model="email" class="w-full border p-2">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block">Role</label>
            <select wire:model="role" class="w-full border p-2">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block">Password Baru (Opsional)</label>
            <input type="password" wire:model="password" class="w-full border p-2">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan Perubahan
        </button>
    </form>
</div>

</div>
