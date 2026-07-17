<x-app-layout>

<div class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-4xl mx-auto px-6">

        <div class="bg-white rounded-3xl shadow-lg p-8">


            <div class="flex justify-between items-center mb-8">

                <h1 class="text-3xl font-bold text-slate-800">
                    Profile Saya
                </h1>


                <a href="{{ route('profile.edit') }}"
                   class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-3 rounded-xl font-bold">

                    Edit Profile

                </a>

            </div>



            {{-- Notifikasi --}}
            @if(session('success'))

                <div class="mb-6 bg-green-100 text-green-700 px-5 py-3 rounded-xl">

                    {{ session('success') }}

                </div>

            @endif




            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                <div class="bg-slate-50 rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Nama
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $user->name }}
                    </p>

                </div>



                <div class="bg-slate-50 rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Email
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $user->email }}
                    </p>

                </div>



                <div class="bg-slate-50 rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Nomor HP
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $user->phone ?? '-' }}
                    </p>

                </div>



                <div class="bg-slate-50 rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Gender
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $user->gender ?? '-' }}
                    </p>

                </div>



                <div class="bg-slate-50 rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Tanggal Lahir
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $user->birth_date ?? '-' }}
                    </p>

                </div>



                <div class="bg-slate-50 rounded-xl p-5">

                    <p class="text-sm text-gray-500">
                        Alamat
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $user->address ?? '-' }}
                    </p>

                </div>


            </div>



            <div class="mt-8 border-t pt-6 text-center">

                <p class="text-green-600 font-semibold">

                    ✓ Data profile tersimpan

                </p>


            </div>


        </div>


    </div>


</div>


</x-app-layout>