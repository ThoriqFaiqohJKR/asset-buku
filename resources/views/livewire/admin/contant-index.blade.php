<div>
    {{-- Do your work, then step back. --}}
    <div class="min-h-screen ">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 ">Contact Admin</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($contacts as $contact)
            <a href="{{ url('/admin/contact/' . $contact->id . '/detail') }}" class="block"> 
                <div class="shadow-md p-6 ">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold ">{{ $contact->nama }}</h3>
                        <p >{{ $contact->nomor }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>



</div>
