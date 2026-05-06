<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Bookminton' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-nav {
            background: linear-gradient(135deg, #1a7a4a 0%, #2ecc71 100%);
        }
        .gradient-btn {
            background: linear-gradient(135deg, #1a7a4a 0%, #2ecc71 100%);
        }
        .gradient-hero {
            background: linear-gradient(135deg, #0f4c2a 0%, #1a7a4a 50%, #2ecc71 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- NAVBAR --}}
    <nav class="gradient-nav text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <a href="/" class="text-xl font-bold tracking-wide flex items-center gap-2">
            🏸 <span>Bookminton</span>
        </a>
        <div class="flex gap-6 text-sm font-medium">
            <a href="/lapangan" class="hover:text-green-200 transition">Lapangan</a>
            <a href="/pemesanan" class="hover:text-green-200 transition">Pemesanan</a>
            <a href="/review" class="hover:text-green-200 transition">⭐ Review</a>
            <a href="/notifikasi" class="hover:text-green-200 transition">🔔 Notifikasi</a>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="max-w-6xl mx-auto px-6 py-8">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                <span>❌</span> {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

    {{-- FOOTER --}}
    <footer class="text-center text-gray-400 text-sm py-6 mt-8 border-t border-gray-200">
        © 2026 <span class="text-green-600 font-semibold">Bookminton</span> — Sistem Booking Lapangan Badminton
    </footer>

</body>
</html>