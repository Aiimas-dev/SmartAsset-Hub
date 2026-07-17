<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

new class extends \Livewire\Volt\Component
{
    public LoginForm $form;


    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();


        $this->redirectIntended(
            default: route('dashboard', absolute: false),
            navigate: true
        );
    }
};

?>


<div class="min-h-screen bg-gray-100 flex items-center justify-center">


    <div class="w-full max-w-md">


        <!-- LOGO / HEADER -->

        <div class="text-center mb-8">


            <div class="mx-auto w-16 h-16 rounded-xl 
            bg-blue-800 flex items-center justify-center
            text-white text-2xl font-bold shadow">


                SH


            </div>



            <h1 class="mt-5 text-2xl font-bold text-gray-800">

                Smart Hub

            </h1>


            <p class="text-gray-500">

                Management System

            </p>


        </div>





        <!-- LOGIN CARD -->

        <div class="bg-white rounded-xl shadow-md border p-8">


            <h2 class="text-xl font-semibold text-gray-800">

                Login

            </h2>


            <p class="text-sm text-gray-500 mt-1 mb-6">

                Silakan masuk menggunakan akun Anda

            </p>





            <form wire:submit="login">



                <!-- EMAIL -->


                <div class="mb-5">


                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Email

                    </label>


                    <input
                        type="email"
                        wire:model="form.email"
                        placeholder="Masukkan email"
                        class="w-full rounded-lg border-gray-300 
                        focus:border-blue-600 focus:ring-blue-600"
                    >



                    @error('form.email')

                    <span class="text-red-500 text-sm">

                        {{ $message }}

                    </span>

                    @enderror


                </div>






                <!-- PASSWORD -->


                <div class="mb-6">


                    <label class="block text-sm font-medium text-gray-700 mb-2">

                        Password

                    </label>


                    <input
                        type="password"
                        wire:model="form.password"
                        placeholder="Masukkan password"
                        class="w-full rounded-lg border-gray-300 
                        focus:border-blue-600 focus:ring-blue-600"
                    >



                    @error('form.password')

                    <span class="text-red-500 text-sm">

                        {{ $message }}

                    </span>

                    @enderror


                </div>






                <!-- BUTTON -->


                <button
                    type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800
                    text-white py-3 rounded-lg
                    font-semibold transition">


                    Login


                </button>






                <!-- REGISTER -->


                <div class="text-center mt-6 text-sm">


                    <span class="text-gray-500">

                        Belum memiliki akun?

                    </span>


                    <a href="{{ route('register') }}"
                       wire:navigate
                       class="text-blue-700 font-semibold">


                        Daftar


                    </a>


                </div>



            </form>


        </div>





        <!-- FOOTER -->


        <p class="text-center text-xs text-gray-400 mt-6">


            © {{ date('Y') }} Smart Hub Management System


        </p>


    </div>


</div>