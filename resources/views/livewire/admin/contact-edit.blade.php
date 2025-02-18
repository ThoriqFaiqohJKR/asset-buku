<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="min-h-screen bg-gray-800">
        <div class="container mx-auto p-4">
            <div class="bg-gray-700 shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4 text-white">Edit Contact</h2>

                @if (session()->has('message'))
                    <div class="bg-green-500 text-white p-2 rounded mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="updateContact">
                    <div class="mb-4">
                        <label for="nama" class="font-semibold text-white">Name</label>
                        <input type="text" id="nama" wire:model="nama" class="w-full border border-gray-300 p-2 rounded" />
                        @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nomor" class="font-semibold text-white">Phone</label>
                        <input 
                            type="text" 
                            id="nomor" 
                            wire:model="nomor" 
                            class="w-full border border-gray-300 p-2 rounded" 
                            minlength="13" 
                            maxlength="13" 
                            required
                        />
                        @error('nomor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end mt-4 space-x-2">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded">
                            <a href="{{ url('/admin/contact') }}">Kembali</a>
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
