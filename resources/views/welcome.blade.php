<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Packing Assistant</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans">

    <div
        class="min-h-screen bg-cover bg-center relative overflow-hidden"
        style="
            background-image:
            linear-gradient(rgba(240,248,255,.30),rgba(240,248,255,.30)),
            url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e');
        "
    >

        <!-- DEKORASI -->
        <div class="absolute top-20 left-1/2 text-8xl animate-spin-slow">☀️</div>

        <!-- NAVBAR -->
        <div class="relative z-20 flex justify-between items-center px-16 py-6">

            <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-4 inline-flex items-center gap-4 shadow-lg">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900">Smart Packing</h1>
                    <p class="text-lg font-bold text-emerald-500">Assistant</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a
                            href="{{ route('dashboard') }}"
                            class="bg-white/80 backdrop-blur-md text-sky-600 px-6 py-3 rounded-2xl font-bold hover:bg-white transition shadow-lg"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="bg-white/80 backdrop-blur-md text-sky-600 px-6 py-3 rounded-2xl font-bold hover:bg-white transition shadow-lg"
                        >
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-2xl font-bold hover:scale-105 transition shadow-lg"
                            >
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

        </div>

        <!-- HERO -->
        <div class="relative z-10 flex items-center justify-between px-16 pt-10 pb-20">

            <!-- KIRI -->
            <div class="w-[55%]">

                <div class="bg-white/30 backdrop-blur-md rounded-full px-5 py-2 inline-block mb-6">
                    <span class="text-white font-semibold">Smart Packing Assistant</span>
                </div>

                <h1 class="text-7xl font-extrabold text-slate-900 leading-tight drop-shadow-lg">
                    Liburan jadi lebih
                    <span class="text-emerald-500">mudah</span> &
                    <span class="text-sky-500">terorganisir.</span>
                </h1>

                <p class="text-2xl mt-8 text-slate-800 leading-relaxed max-w-2xl font-medium">
                    Kelola perjalanan, buat packing list otomatis,
                    dan pastikan tidak ada barang yang tertinggal.
                </p>

                <div class="mt-10 flex gap-5">
                    @auth
                        <a
                            href="{{ route('trips.create') }}"
                            class="bg-gradient-to-r from-sky-500 to-cyan-500 text-white px-10 py-5 rounded-2xl font-bold text-xl hover:scale-105 transition shadow-xl"
                        >
                            + Trip Baru
                        </a>
                        <a
                            href="{{ route('trips.index') }}"
                            class="bg-white/80 backdrop-blur-md text-sky-600 px-10 py-5 rounded-2xl font-bold text-xl border border-white/30 hover:bg-white transition shadow-lg"
                        >
                            Lihat Trip
                        </a>
                    @else
                        <a
                            href="{{ route('register') }}"
                            class="bg-gradient-to-r from-sky-500 to-cyan-500 text-white px-10 py-5 rounded-2xl font-bold text-xl hover:scale-105 transition shadow-xl"
                        >
                            Mulai Sekarang
                        </a>
                        <a
                            href="{{ route('login') }}"
                            class="bg-white/80 backdrop-blur-md text-sky-600 px-10 py-5 rounded-2xl font-bold text-xl border border-white/30 hover:bg-white transition shadow-lg"
                        >
                            Masuk
                        </a>
                    @endauth
                </div>

            </div>

            <!-- KANAN -->
            <div class="w-[40%] flex justify-center">

                <div class="bg-white/80 backdrop-blur-xl rounded-[40px] p-10 shadow-2xl">

                    <h2 class="text-4xl font-bold text-slate-900 mb-6">Fitur Utama</h2>

                    <div class="space-y-6">

                        <div class="flex items-center gap-4 bg-sky-50 rounded-2xl p-4">
                            <div>
                                <h3 class="font-bold text-slate-800">Buat Trip</h3>
                                <p class="text-gray-500 text-sm">Rencanakan perjalanan dengan detail</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-emerald-50 rounded-2xl p-4">
                            <div>
                                <h3 class="font-bold text-slate-800">Auto Packing List</h3>
                                <p class="text-gray-500 text-sm">Daftar barang otomatis sesuai destinasi</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-purple-50 rounded-2xl p-4">
                            <div>
                                <h3 class="font-bold text-slate-800">Checklist</h3>
                                <p class="text-gray-500 text-sm">Tandai barang yang sudah dikemas</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-yellow-50 rounded-2xl p-4">
                            <div>
                                <h3 class="font-bold text-slate-800">Tips Packing</h3>
                                <p class="text-gray-500 text-sm">Tips cerdas untuk perjalananmu</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- STATS -->
        <div class="relative z-10 px-16 pb-16">
            <div class="grid grid-cols-3 gap-8 max-w-4xl">

                <div class="bg-white/80 backdrop-blur-xl rounded-[30px] p-8 text-center shadow-lg">
                    <h3 class="text-3xl font-extrabold text-slate-800">3</h3>
                    <p class="text-gray-500 mt-2 font-semibold">Jenis Destinasi</p>
                    <p class="text-sm text-gray-400 mt-1">Pantai, Gunung, Kota</p>
                </div>

                <div class="bg-white/80 backdrop-blur-xl rounded-[30px] p-8 text-center shadow-lg">
                    <h3 class="text-3xl font-extrabold text-slate-800">6</h3>
                    <p class="text-gray-500 mt-2 font-semibold">Mode Transportasi</p>
                    <p class="text-sm text-gray-400 mt-1">Pesawat, Kereta, Mobil, dll</p>
                </div>

                <div class="bg-white/80 backdrop-blur-xl rounded-[30px] p-8 text-center shadow-lg">
                    <h3 class="text-3xl font-extrabold text-slate-800">50+</h3>
                    <p class="text-gray-500 mt-2 font-semibold">Barang Packing</p>
                    <p class="text-sm text-gray-400 mt-1">Disesuaikan kebutuhanmu</p>
                </div>

            </div>
        </div>

        <!-- FOOTER -->
        <div class="relative z-10 text-center pb-10">
            <p class="text-gray-600 font-medium">
                Smart Packing Assistant &copy; {{ date('Y') }}
            </p>
        </div>

    </div>

    <style>
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: spin-slow 20s linear infinite; }
    </style>

</body>

</html>
