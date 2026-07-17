<x-app-layout>

    <div class="min-h-screen bg-slate-100 py-10">

        <div class="max-w-7xl mx-auto px-6">


            @if(session('success'))

                <div class="mb-8 rounded-2xl border border-green-300 bg-green-100 px-6 py-4 text-green-700 shadow">

                    ✅ {{ session('success') }}

                </div>

            @endif



            <!-- HEADER -->

            <div class="bg-gradient-to-r from-cyan-500 via-sky-500 to-emerald-500 rounded-[35px] p-10 shadow-xl text-white mb-10">


                <div class="flex flex-col lg:flex-row justify-between items-center">


                    <div>


                        <h1 class="text-5xl font-extrabold mb-4">

                            Trip Saya

                        </h1>


                        <p class="text-xl opacity-95">

                            Kelola perjalanan dan packing list kamu dalam satu tempat.

                        </p>


                    </div>



                    <a
                        href="{{ route('trips.create') }}"
                        class="mt-8 lg:mt-0 bg-white text-cyan-600 font-bold px-8 py-4 rounded-2xl hover:scale-105 duration-300 shadow-lg"
                    >

                        ➕ Tambah Trip

                    </a>


                </div>


            </div>





            @forelse($trips as $trip)



                @php

                    $total = $trip->packingLists->count();

                    $checked = $trip->packingLists
                        ->where('is_checked', true)
                        ->count();

                    $progress = $total > 0 
                        ? round(($checked / $total) * 100)
                        : 0;

                @endphp





                <div
                    class="bg-white rounded-[35px] shadow-xl border border-slate-200 p-8 mb-10 hover:-translate-y-1 hover:shadow-2xl transition"
                >




                    <!-- INFORMASI TRIP -->

                    <a href="{{ route('trips.show',$trip) }}">


                        <div class="flex flex-col lg:flex-row justify-between">


                            <div>


                                <h2 class="text-4xl font-bold text-slate-800">

                                    {{ $trip->destination_name }}

                                </h2>



                                <div class="flex flex-wrap gap-3 mt-5">


                                    <span class="bg-cyan-100 text-cyan-700 px-4 py-2 rounded-full font-semibold">

                                        {{ ucfirst($trip->destination_type) }}

                                    </span>



                                    <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full font-semibold">

                                        {{ ucfirst($trip->travel_style) }}

                                    </span>



                                    <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full font-semibold">

                                        {{ ucfirst($trip->transportation) }}

                                    </span>



                                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold">

                                        {{ ucfirst(str_replace('_',' ',$trip->accommodation)) }}

                                    </span>


                                </div>




                                <p class="text-gray-500 mt-5">


                                    📅

                                    {{ \Carbon\Carbon::parse($trip->departure_date)->format('d M Y') }}

                                    -

                                    {{ \Carbon\Carbon::parse($trip->return_date)->format('d M Y') }}


                                </p>



                            </div>





                            <div class="mt-8 lg:mt-0 text-right">


                                <p class="text-gray-500 mb-2">

                                    Progress Packing

                                </p>



                                <div class="w-60 bg-slate-200 rounded-full h-4 overflow-hidden">


                                    <div
                                        class="bg-gradient-to-r from-cyan-500 to-emerald-500 h-4"
                                        style="width: {{ $progress }}%"
                                    >

                                    </div>


                                </div>




                                <p class="mt-2 font-bold text-cyan-600">

                                    {{ $checked }} / {{ $total }} Barang

                                </p>



                            </div>



                        </div>


                    </a>







                    <!-- BUTTON ACTION -->


                    <div class="mt-8 flex flex-wrap gap-4 border-t pt-6">



                        <a
                            href="{{ route('packing.index',$trip) }}"
                            class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-3 rounded-xl font-bold shadow"
                        >

                            🎒 Kelola Packing

                        </a>




                        <a
                            href="{{ route('trips.edit',$trip) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-3 rounded-xl font-bold shadow"
                        >

                            ✏️ Edit Trip

                        </a>




                        <form
                            action="{{ route('trips.destroy',$trip) }}"
                            method="POST"
                        >

                            @csrf

                            @method('DELETE')


                            <button
                                onclick="return confirm('Hapus trip ini?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl font-bold shadow"
                            >

                                🗑 Hapus

                            </button>


                        </form>



                    </div>





                </div>





            @empty




                <div class="bg-white rounded-[35px] p-16 text-center shadow-xl">



                    <div class="text-[120px]">

                        🧳

                    </div>




                    <h2 class="text-4xl font-bold mt-5 text-slate-800">

                        Belum Ada Trip

                    </h2>



                    <p class="text-xl text-gray-500 mt-4">

                        Buat perjalanan pertama dan siapkan packing otomatis.

                    </p>



                    <a
                        href="{{ route('trips.create') }}"
                        class="inline-block mt-8 bg-gradient-to-r from-cyan-500 to-emerald-500 text-white px-8 py-4 rounded-2xl font-bold"
                    >

                        ➕ Buat Trip Pertama

                    </a>



                </div>




            @endforelse




        </div>


    </div>


</x-app-layout>