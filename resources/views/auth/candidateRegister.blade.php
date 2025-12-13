<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – CV SYNK</title>

    @vite('resources/css/app.css')



    {{-- cdn used for the skills section --}}
    <<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

</head>

<body class="bg-gradient-to-b from-[#0052A2] to-[#0274D3] text-white min-h-screen py-12">

    <div class="max-w-md mx-auto bg-white/10 backdrop-blur-xl border border-white/20 
        rounded-2xl p-8 shadow-xl"
        x-data="{ role: 'candidate' }">

        {{-- Logo --}}
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/logo-inverted.svg') }}" class="h-12" alt="Logo">
        </div>
        <h2 class="text-center text-3xl font-bold mb-6">Candidate Register</h2>
        <h3 class="text-center text-3xl font-bold mb-6">Create Your Account</h3>

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('web.register.candidate') }}">
            @csrf



            {{-- Name --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Full Name</label>
                <input type="text" name="name"
                    class="w-full px-4 py-2 rounded-lg 
                    bg-white/20 border border-white/30 text-white placeholder-white/60
                    focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email"
                    class="w-full px-4 py-2 rounded-lg 
                    bg-white/20 border border-white/30 text-white placeholder-white/60
                    focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>




            {{-- Skills (Candidate Only) --}}
            <label class="block mb-2 font-semibold">Skills</label>

            <select id="skills-select" name="skills[]" multiple class="w-full rounded-lg bg-white text-black p-2">
                @foreach (['Email Marketing', 'Prospecting', 'Cold Calling', 'Email Outreach', 'Social Selling', 'Qualification', 'BANT', 'MEDDIC', 'Laravel', 'PHP', 'JavaScript', 'React', 'Python', 'Java'] as $skill)
                    <option value="{{ $skill }}">{{ $skill }}</option>
                @endforeach
            </select>



            {{-- Password --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 rounded-lg 
                    bg-white/20 border border-white/30 text-white placeholder-white/60
                    focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label class="block mb-1 font-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-2 rounded-lg 
                    bg-white/20 border border-white/30 text-white placeholder-white/60
                    focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full py-3 bg-white text-[#003A75] font-semibold rounded-full shadow-lg">
                Register
            </button>

        </form>

        {{-- Login redirect --}}
        <p class="text-center text-white/80 mt-4 text-sm">
            Already have an account?
            <a href="/login" class="text-white font-semibold underline">Login</a>
        </p>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect("#skills-select", {
                plugins: ['remove_button'],
                persist: false,
                create: false,
                maxItems: null,
                placeholder: "Select your skills",
            });
        });
    </script>


</body>

</html>
