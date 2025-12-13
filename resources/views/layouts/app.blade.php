<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV SYNK</title>

    @vite('resources/css/app.css')

    {{-- Alpine (optional, future ready) --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gradient-to-b from-[#0052A2] to-[#0274D3] text-white min-h-screen">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Page Content --}}
    <main class="py-12">
        @yield('content')
    </main>

</body>
</html>
