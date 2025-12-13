<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV SYNK – Recruitment Marketplace</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-b from-[#0052A2] to-[#0274D3] text-white min-h-screen">

    {{-- NAVBAR --}}
    <header class="w-full border-b border-white/10 bg-[#002C59]/20 backdrop-blur">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-4 sm:px-6">

            {{-- Logo --}}
            <img src="{{ asset('assets/logo-inverted.svg') }}" class="h-8 sm:h-10" alt="CV SYNK Logo">

            {{-- Actions --}}
            <div class="flex items-center gap-2 sm:gap-3 text-xs sm:text-sm">
                <a href="{{ route('candidateRegister') }}"
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full
                          bg-white text-[#003A75] font-medium hover:scale-105 transition">
                    Candidate Register
                </a>

                <a href="{{ route('companyRegister') }}"
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full
                          bg-white text-[#003A75] font-medium hover:scale-105 transition">
                    Company Register
                </a>

                <a href="{{ route('login') }}"
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full
                          bg-blue-600 hover:bg-blue-700 font-medium transition">
                    Login
                </a>
            </div>
        </div>
    </header>

    {{-- HERO SECTION --}}
    <section class="w-full py-20 sm:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid md:grid-cols-2 gap-10 items-center">

            {{-- Left --}}
            <div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight">
                    Access 75+ <br>
                    Recruitment <br>
                    Agencies in One <br>
                    Place
                </h1>

                <p class="mt-4 sm:mt-6 text-base sm:text-lg text-white/85 max-w-lg">
                    India's first recruitment marketplace connecting companies with
                    verified recruitment agencies. Reduce hiring costs by 40% and
                    hire 3× faster.
                </p>

                <a href="{{ route('companyRegister') }}"
                    class="inline-block mt-6 sm:mt-8 px-5 sm:px-6 py-2.5 sm:py-3
                          bg-white text-[#003A75] rounded-full font-semibold
                          shadow-lg hover:scale-105 transition">
                    Post a Free Job
                </a>
            </div>

            {{-- Right Stats --}}
            <div class="flex justify-center">
                <div
                    class="bg-white/15 backdrop-blur-lg border border-white/10
                            rounded-2xl p-6 sm:p-10 w-full max-w-sm sm:max-w-md">

                    
                </div>
            </div>

        </div>
    </section>

</body>

</html>
