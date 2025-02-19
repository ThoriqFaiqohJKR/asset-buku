<div class="w-full flex flex-col items-center justify-center min-h-screen bg-gray-600 pt-20">
        <h1 class="text-2xl font-bold mb-4 text-white">Selamat Datang !!</h1>
        <div class="flex flex-row space-x-4">
        <a href="{{ url('/user/list/book') }}"> 
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Pinjam Buku</button></a>
        <a href="{{ url('/user/list/asset') }}"> 
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Pinjam Asset</button></a>
        </div>
    </div>