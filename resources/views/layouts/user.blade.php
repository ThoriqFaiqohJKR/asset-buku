<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-100">
<nav class="bg-zinc-800 p-4 fixed w-full top-0 z-50" x-data="{ open: false }">
        <div class="container mx-auto flex items-center justify-start">
            <div class="text-white text-lg font-bold">MyApp</div>
            <ul class="hidden md:flex space-x-4 ml-8">
                <li><a href="{{ url('user/dashboard') }}"   class="text-white hover:text-gray-400">Home</a></li>
                <li><a href="{{ url('user/list/book') }}" class="text-white hover:text-gray-400">Buku</a></li>
                <li><a href="{{ url('user/list/asset') }}" class="text-white hover:text-gray-400">Asset</a></li>
            </ul>
            <div class="md:hidden ml-auto">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div x-show="open" class="md:hidden">
            <ul class="flex flex-col space-y-2 mt-2">
                <li><a href="{{ url('user/dashboard') }}"   class="text-white hover:text-gray-400">Home</a></li>
                <li><a href="{{ url('user/list/book') }}" class="text-white hover:text-gray-400">Buku</a></li>
                <li><a href="{{ url('user/list/asset') }}"class="text-white hover:text-gray-400">Asset</a></li>
            </ul>
        </div>
    </nav>



    <div class="flex">
        <div class="flex-1">
            @yield('content')
        </div>
    </div>
</body>

</html>