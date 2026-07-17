<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};

?>

<div
    class="h-screen bg-cover bg-center flex items-center justify-between px-16 py-6 relative overflow-hidden"
    style="
        background-image:
        linear-gradient(rgba(240,248,255,.35),rgba(240,248,255,.35)),
        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e');
    "
>
<!-- AWAN -->
<div class="absolute top-12 left-40 text-7xl animate-cloud">
    ☁️
</div>

<div class="absolute top-20 right-96 text-7xl animate-cloud2">
    ☁️
</div>

<!-- MATAHARI -->
<div class="absolute top-20 left-1/2 text-8xl animate-spin-slow">
    ☀️
</div>


a
<!-- KIRI -->
<div class="w-[52%] z-10">

    <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-5 inline-flex items-center gap-4 shadow-lg mb-10">

        

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Smart Packing
            </h1>

            <p class="text-2xl font-bold text-emerald-500">
                Assistant
            </p>
        </div>

    </div>

    <h1 class="text-6xl font-extrabold text-slate-900 leading-tight">
        Ayo Gabung! 
    </h1>

    <h2 class="text-4xl font-bold text-slate-900 mt-6 leading-snug">
        Yuk mulai
        <span class="text-emerald-500">
            petualanganmu
        </span>
        sekarang! 
    </h2>

    <p class="text-xl mt-6 text-slate-800 max-w-2xl leading-relaxed font-medium">
        Daftar sekarang dan bikin checklist barang bawaan anti ribet.
        Liburan jadi lebih santai, seru, dan nggak takut ada barang yang ketinggalan! 
    </p>

    

</div>

<!-- CARD REGISTER -->
<div class="w-[470px] z-10 mr-6">

    <div class="bg-white/90 backdrop-blur-xl rounded-[40px] p-8 shadow-2xl">

        <h2 class="text-4xl font-bold text-slate-900 mb-3">
            Buat Akun Baru 
        </h2>

        <p class="text-gray-500 mb-8">
            Isi data di bawah dan mulai petualanganmu!
        </p>

        <form wire:submit="register">

            <!-- NAMA -->
            <div class="mb-4">
                <label class="font-bold block mb-2">
                    Nama
                </label>

                <input
                    wire:model="name"
                    type="text"
                    placeholder="Masukkan nama kamu"
                    class="w-full p-4 rounded-2xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="font-bold block mb-2">
                    Email
                </label>

                <input
                    wire:model="email"
                    type="email"
                    placeholder="Masukkan email"
                    class="w-full p-4 rounded-2xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">

                <label class="font-bold block mb-2">
                    Password
                </label>

                <div class="relative">

                    <input
                        wire:model="password"
                        id="password"
                        type="password"
                        placeholder="Masukkan password"
                        class="w-full p-4 pr-14 rounded-2xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('password','icon1')"
                        class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-500"
                    >
                        <span id="icon1">
                            <img src="https://cdn-icons-png.flaticon.com/512/709/709612.png" class="w-6">
                        </span>
                    </button>

                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="mb-6">

                <label class="font-bold block mb-2">
                    Konfirmasi Password
                </label>

                <div class="relative">

                    <input
                        wire:model="password_confirmation"
                        id="confirm_password"
                        type="password"
                        placeholder="Ulangi password"
                        class="w-full p-4 pr-14 rounded-2xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('confirm_password','icon2')"
                        class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-500"
                    >
                        <span id="icon2">
                            <img src="https://cdn-icons-png.flaticon.com/512/709/709612.png" class="w-6">
                        </span>
                    </button>

                </div>

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white p-4 rounded-2xl text-lg font-bold hover:scale-105 transition duration-300"
            >
                Daftar Sekarang →
            </button>

            <div class="text-center mt-5">

                <span class="text-gray-600">
                    Sudah punya akun?
                </span>

                <a
                    href="{{ route('login') }}"
                    wire:navigate
                    class="text-blue-600 font-bold hover:underline"
                >
                    Masuk
                </a>

            </div>

        </form>

    </div>

</div>

<script>
    function togglePassword(inputId)
    {
        const input = document.getElementById(inputId);

        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>

<style>

    @keyframes float {
        0%,100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    .animate-float {
        animation: float 4s infinite;
    }

    @keyframes plane {
        from {
            transform: translateX(-100px);
        }
        to {
            transform: translateX(200px);
        }
    }

    .animate-plane {
        animation: plane 8s infinite alternate;
    }

    @keyframes cloud {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(100px);
        }
    }

    .animate-cloud {
        animation: cloud 8s infinite alternate;
    }

    .animate-cloud2 {
        animation: cloud 10s infinite alternate-reverse;
    }

    @keyframes spin-slow {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin-slow {
        animation: spin-slow 20s linear infinite;
    }

</style>
</div>
