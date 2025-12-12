<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV SYNK – Recruitment Marketplace</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-b from-[#0052A2] to-[#0274D3] text-white">

    {{-- NAVBAR --}}
    <header class="w-full border-b border-white/10 bg-[#002C59]/20 backdrop-blur">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-4 sm:px-6">

            {{-- Logo --}}
            <img src="{{ asset('assets/logo-inverted.svg') }}" class="h-8 sm:h-10" alt="Logo">

            {{-- Buttons --}}
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('candidateRegister') }}"
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-white text-[#003A75] font-medium text-xs sm:text-sm">
                    Candidate Register
                </a>
                <a href="{{ route('companyRegister') }}"
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-white text-[#003A75] font-medium text-xs sm:text-sm">
                    Company Register
                </a>
                <a href="{{ route('login') }}"
                    class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-blue-600 font-medium text-xs sm:text-sm">
                    Login
                </a>
            </div>
        </div>
    </header>

    {{-- HERO SECTION --}}
    <section class="w-full py-20 sm:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid md:grid-cols-2 gap-10">

            {{-- Left Text --}}
            <div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight">
                    Access 75+ <br>
                    Recruitment <br>
                    Agencies in One <br>
                    Place
                </h1>

                <p class="mt-4 sm:mt-6 text-base sm:text-lg text-white/85 max-w-lg">
                    India's First Recruitment Marketplace connecting companies with verified recruitment agencies.
                    Reduce hiring costs by 40% and hire 3x faster.
                </p>

                <button
                    class="mt-6 sm:mt-8 px-5 sm:px-6 py-2.5 sm:py-3 bg-white text-[#003A75] rounded-full font-semibold shadow-lg">
                    Post A Free Job
                </button>
            </div>

            {{-- Right Stats Card --}}
            <div class="flex justify-center">
                <div
                    class="bg-white/15 backdrop-blur-lg border border-white/10 rounded-2xl 
                    p-6 sm:p-10 w-full max-w-sm sm:max-w-md">

                    <div class="grid grid-cols-2 gap-6 sm:gap-8 text-center">

                        <div>
                            <h3 class="text-2xl sm:text-3xl font-bold">75+</h3>
                            <p class="mt-1 text-white/80 text-xs sm:text-sm">Verified Agencies</p>
                        </div>

                        <div>
                            <h3 class="text-2xl sm:text-3xl font-bold">500+</h3>
                            <p class="mt-1 text-white/80 text-xs sm:text-sm">Positions Filled</p>
                        </div>

                        <div>
                            <h3 class="text-2xl sm:text-3xl font-bold">250+</h3>
                            <p class="mt-1 text-white/80 text-xs sm:text-sm">Companies Trust Us</p>
                        </div>

                        <div>
                            <h3 class="text-2xl sm:text-3xl font-bold">95%</h3>
                            <p class="mt-1 text-white/80 text-xs sm:text-sm">Success Rate</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

</body>

</html>
