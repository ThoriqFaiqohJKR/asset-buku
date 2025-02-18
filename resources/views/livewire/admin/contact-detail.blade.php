<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="min-h-screen bg-gray-800">
    <div class="container mx-auto p-4">
        <div class="bg-gray-700 shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-white">Contact Detail</h2>
            <div class="grid grid-cols-1 gap-4">
                @if($contact)
                    <div class="flex flex-col">
                        <label class="font-semibold text-white mb-2">Name</label>
                        <div class="flex items-center border border-gray-300 p-2">
                            <span class="w-full font-medium text-white">{{ $contact->nama }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-semibold text-white mb-2">Phone</label>
                        <div class="flex items-center border border-gray-300 p-2">
                            <span class="w-full font-medium text-white">{{ $contact->nomor }}</span>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4 space-x-2">
                        <!-- Kembali Button -->
                        <a href="{{ url('/admin/contact') }}">
                            <button class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</button>
                        </a>

                        <!-- Edit Button -->
                        <a href="{{ url('/admin/contact/' . $contact->id . '/edit') }}">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                        </a>
                    </div>
                @else
                    <p class="text-red-500">Contact not found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

</div>
