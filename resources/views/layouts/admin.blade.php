
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div class="flex relative">
        <!-- Hamburger Button -->
        <button id="hamburger-btn" class="md:hidden fixed top-4 left-4 z-30 p-3 bg-gray-800 text-white rounded peer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 6h18M3 12h18M3 18h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-gray-800 text-white flex flex-col min-h-screen w-64 fixed top-0 left-0 z-20 transform -translate-x-full peer-checked:translate-x-0 md:translate-x-0 transition-transform duration-300 ease-in-out border-r border-gray-600">

            <div class="p-4 text-center text-2xl font-bold border-b border-gray-700">
                Admin Dashboard
            </div>
            <div class="flex flex-col items-center p-4 border-b border-gray-700">
                <img alt="Profile picture of the admin" class="w-20 h-20 rounded-full mb-2" src="https://placehold.co/80x80" />
                <span class="text-lg font-semibold">{{ Auth::user()->name }}</span>
            </div>
            <nav class="flex-1 p-4">
                <ul>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ url('admin/contact') }}">Contant</a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ url('admin/buku') }}">Buku</a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ url('admin/asset') }}">Asset</a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="{{ url('admin/peminjaman') }}">Peminjaman</a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ url('admin/logout') }}" class="flex items-center p-2 hover:bg-gray-700 rounded">
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="content-overlay" class="main-content flex-1 md:ml-64">
            @yield('content')
        </div>
    </div>

    @livewireScripts

    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const sidebar = document.getElementById('sidebar');
        const contentOverlay = document.getElementById('content-overlay');

        hamburgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            document.body.classList.toggle('overflow-hidden'); // Disable scrolling when sidebar is open
        });

        contentOverlay.addEventListener('click', (e) => {
            if (!sidebar.classList.contains('-translate-x-full') && !sidebar.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Hide the hamburger button when sidebar is open, and show it again when closed
        const toggleHamburgerVisibility = () => {
            if (sidebar.classList.contains('-translate-x-full')) {
                hamburgerBtn.classList.remove('hidden');
            } else {
                hamburgerBtn.classList.add('hidden');
            }
        };

        // Call the function to hide or show the hamburger button based on sidebar state
        sidebar.addEventListener('transitionend', toggleHamburgerVisibility);
        toggleHamburgerVisibility(); // Initial state check
    </script>
</body>

</html>

