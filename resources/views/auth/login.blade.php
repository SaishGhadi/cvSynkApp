<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – CV SYNK</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-b from-[#0052A2] to-[#0274D3] text-white min-h-screen py-12">

    <div class="max-w-md mx-auto bg-white/10 backdrop-blur-xl border border-white/20 
        rounded-2xl p-8 shadow-xl">

        {{-- Logo --}}
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/logo-inverted.svg') }}" class="h-12" alt="Logo">
        </div>

        <h2 class="text-center text-3xl font-bold mb-6">Login to Your Account</h2>

        {{-- Login Form --}}
        <form method="POST" action="{{ route('api.login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email"
                    class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                    text-white placeholder-white/60 focus:outline-none focus:ring-2
                    focus:ring-blue-300">
            </div>

            {{-- Password --}}
            <div class="mb-2">
                <label class="block mb-1 font-semibold">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                    text-white placeholder-white/60 focus:outline-none focus:ring-2
                    focus:ring-blue-300">
            </div>
            
            {{-- Submit --}}
            <button type="submit" class="w-full py-3 bg-white text-[#003A75] font-semibold rounded-full shadow-lg">
                Login
            </button>
        </form>

        {{-- Register redirect --}}
        <p class="text-center text-white/80 mt-4 text-sm">
            Don't have an account?
        </p>
        <p class="text-center text-sm mt-1">
            <a href="{{ route('candidateRegister') }}" class="text-white font-semibold underline mr-3">
                Register as Candidate
            </a>
            <a href="{{ route('companyRegister') }}" class="text-white font-semibold underline">
                Register as Company
            </a>
        </p>


    </div>

</body>

</html>
