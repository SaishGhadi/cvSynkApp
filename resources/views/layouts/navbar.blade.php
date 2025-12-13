<nav class="w-full border-b border-white/10 bg-[#002C59]/30 backdrop-blur">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        {{-- Logo --}}
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/logo-inverted.svg') }}" class="h-9" alt="CV SYNK">
        </div>

        {{-- Right Side --}}
        <div class="flex items-center gap-4">
            @auth
                <span class="text-white/80 text-sm">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout.web') }}" method="POST">
                    @csrf
                    <button
                        class="px-4 py-2 rounded-full bg-red-500 hover:bg-red-600 transition text-sm font-semibold">
                        Logout
                    </button>
                </form>
            @endauth
        </div>

    </div>
</nav>
