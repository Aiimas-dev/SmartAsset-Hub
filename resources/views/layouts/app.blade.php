<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Hub Management System') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-100">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->

    <aside class="w-72 bg-white shadow-xl fixed left-0 top-0 h-screen border-r">

        <div class="p-8">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-3xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white text-2xl">

                    🏢

                </div>

                <div>

                    <h1 class="font-extrabold text-xl">
                        Smart Hub
                    </h1>

                    <p class="text-cyan-600 font-semibold text-sm">
                        Management System
                    </p>

                </div>

            </div>

        </div>

        <div class="px-6">

            <p class="uppercase text-xs tracking-[4px] text-gray-400 mb-5">

                MAIN MENU

            </p>

            <div class="space-y-3">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl
                   {{ request()->routeIs('dashboard')
                        ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white'
                        : 'hover:bg-slate-100' }}">

                    🏠

                    <span>Dashboard</span>

                </a>

                <a href="{{ route('categories.index') }}"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl
                   {{ request()->routeIs('categories.*')
                        ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white'
                        : 'hover:bg-slate-100' }}">

                    📂

                    <span>Data Kategori</span>

                </a>

                <a href="{{ route('equipment.index') }}"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl
                   {{ request()->routeIs('equipment.*')
                        ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white'
                        : 'hover:bg-slate-100' }}">

                    💻

                    <span>Data Peralatan</span>

                </a>

                <a href="{{ route('transactions.index') }}"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl
                   {{ request()->routeIs('transactions.*')
                        ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white'
                        : 'hover:bg-slate-100' }}">

                    📋

                    <span>Transaksi</span>

                </a>

                <a href="{{ route('profile') }}"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl
                   {{ request()->routeIs('profile*')
                        ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white'
                        : 'hover:bg-slate-100' }}">

                    👤

                    <span>Profile</span>

                </a>

            </div>

        </div>

        <!-- USER -->

        <div class="absolute bottom-0 left-0 right-0 border-t p-6">

            <div class="mb-4">

                <div class="font-bold">

                    {{ auth()->user()->name }}

                </div>

                <div class="text-sm text-gray-500">

                    {{ auth()->user()->email }}

                </div>

            </div>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl">

                    Logout

                </button>

            </form>

        </div>

    </aside>

    <!-- ================= CONTENT ================= -->

    <div class="flex-1 ml-72">

        @isset($header)

            <header class="bg-white shadow-sm border-b px-8 py-6">

                {{ $header }}

            </header>

        @endisset

        <main class="p-8">

            {{ $slot }}

        </main>

    </div>

</div>

</body>

</html>