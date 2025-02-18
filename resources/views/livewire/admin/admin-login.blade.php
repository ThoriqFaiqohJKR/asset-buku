{{-- If your happiness depends on money, you will never be happy with yourself. --}}
<div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-white">Login</h2>
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-300 text-sm font-bold mb-2" for="email">Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-user text-gray-400"></i>
                </span>
                <input type="email" id="email" name="email" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 pl-10 text-gray-300 leading-tight focus:outline-none focus:shadow-outline bg-gray-900" placeholder="Enter your email" required>
            </div>
        </div>
        <div class="mb-6">
            <label class="block text-gray-300 text-sm font-bold mb-2" for="password">Password</label>
            <div class="relative">
                <span class="absolute px-10 py-3 left-0 flex items-center pl-3">
                    <i class="fas fa-lock text-gray-400"></i>
                </span>
                <input type="password" id="password" name="password" class="shadow appearance-none border border-gray-700 rounded w-full py-2 px-3 pl-10 text-gray-300 mb-3 leading-tight focus:outline-none focus:shadow-outline bg-gray-900" placeholder="Enter your password" required>
            </div>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-white hover:bg-gray-300 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Log in
            </button>
        </div>
    </form>
</div>
