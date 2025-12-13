<nav class="bg-gray-900 text-white px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">CV SYNK</h1>

    <div class="flex items-center gap-6">
        @auth
            <span class="text-gray-300">{{ auth()->user()->name }}</span>

            <form action="{{ route('logout.web') }}" method="POST">
                @csrf
                <button 
                    class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-white"
                    type="submit">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</nav>
