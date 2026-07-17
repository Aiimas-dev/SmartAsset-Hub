<x-app-layout>

<div class="min-h-screen bg-slate-100 py-10">

    <div class="max-w-5xl mx-auto px-6">

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
                        {{ $trip->destination_name }}
                    </h1>

                    <div class="flex flex-wrap gap-3 mt-5">

                        <span class="bg-white/20 text-white px-4 py-2 rounded-full font-semibold">
                            {{ ucfirst($trip->destination_type) }}
                        </span>

                        <span class="bg-white/20 text-white px-4 py-2 rounded-full font-semibold">
                            {{ ucfirst($trip->travel_style) }}
                        </span>

                        <span class="bg-white/20 text-white px-4 py-2 rounded-full font-semibold">
                            {{ ucfirst($trip->transportation) }}
                        </span>

                        <span class="bg-white/20 text-white px-4 py-2 rounded-full font-semibold">
                            {{ ucfirst(str_replace('_',' ',$trip->accommodation)) }}
                        </span>

                    </div>

                </div>

                <a
                    href="{{ route('trips.index') }}"
                    class="mt-8 lg:mt-0 bg-white text-cyan-600 font-bold px-8 py-4 rounded-2xl hover:scale-105 duration-300 shadow-lg"
                >
                    ← Kembali
                </a>

            </div>

        </div>

        <!-- INFO TRIP -->

        <div class="bg-white rounded-[35px] shadow-xl border border-slate-200 p-8 mb-10">

            <h2 class="text-2xl font-bold text-slate-800 mb-6">
                📋 Detail Perjalanan
            </h2>

            <div class="grid md:grid-cols-2 gap-6">

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <p class="text-gray-500 text-sm mb-1">Lokasi</p>
                    <p class="font-bold text-lg text-slate-800">{{ $trip->destination_name }}</p>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <p class="text-gray-500 text-sm mb-1">Tipe Destinasi</p>
                    <p class="font-bold text-lg text-slate-800">{{ ucfirst($trip->destination_type) }}</p>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <p class="text-gray-500 text-sm mb-1">Transportasi</p>
                    <p class="font-bold text-lg text-slate-800">{{ ucfirst($trip->transportation) }}</p>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <p class="text-gray-500 text-sm mb-1">Akomodasi</p>
                    <p class="font-bold text-lg text-slate-800">{{ ucfirst(str_replace('_',' ',$trip->accommodation)) }}</p>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <p class="text-gray-500 text-sm mb-1">Gaya Perjalanan</p>
                    <p class="font-bold text-lg text-slate-800">{{ ucfirst($trip->travel_style) }}</p>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <p class="text-gray-500 text-sm mb-1">Obat Pribadi</p>
                    <p class="font-bold text-lg text-slate-800">{{ $trip->has_medication ? 'Ya' : 'Tidak' }}</p>
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 md:col-span-2">
                    <p class="text-gray-500 text-sm mb-1">📅 Jadwal Perjalanan</p>
                    <p class="font-bold text-lg text-slate-800">
                        {{ \Carbon\Carbon::parse($trip->departure_date)->format('d M Y') }}
                        →
                        {{ \Carbon\Carbon::parse($trip->return_date)->format('d M Y') }}
                    </p>
                </div>

                @if($trip->notes)
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 md:col-span-2">
                        <p class="text-gray-500 text-sm mb-1">📝 Catatan</p>
                        <p class="font-bold text-lg text-slate-800">{{ $trip->notes }}</p>
                    </div>
                @endif

            </div>

        </div>

        <!-- PROGRESS PACKING -->

        @php
            $total = $trip->packingLists->count();
            $checked = $trip->packingLists->where('is_checked', true)->count();
            $progress = $total > 0 ? round(($checked / $total) * 100) : 0;
        @endphp

        <div class="bg-white rounded-[35px] shadow-xl border border-slate-200 p-8 mb-10">

            <h2 class="text-2xl font-bold text-slate-800 mb-6">
                📦 Progress Packing
            </h2>

            <div class="flex items-center gap-6">

                <div class="flex-1">
                    <div class="w-full bg-slate-200 rounded-full h-5 overflow-hidden">
                        <div
                            class="bg-gradient-to-r from-cyan-500 to-emerald-500 h-5 rounded-full transition-all duration-500"
                            style="width: {{ $progress }}%"
                        ></div>
                    </div>
                </div>

                <div class="text-right min-w-[120px]">
                    <p class="font-bold text-2xl text-cyan-600">{{ $progress }}%</p>
                    <p class="text-gray-500">{{ $checked }} / {{ $total }} Barang</p>
                </div>

            </div>

        </div>

        <!-- PACKING LIST -->

        <div class="bg-white rounded-[35px] shadow-xl border border-slate-200 p-8 mb-10">

            <h2 class="text-2xl font-bold text-slate-800 mb-6">
                🎒 Packing List
            </h2>

            @if($trip->packingLists->count())

                <div class="grid md:grid-cols-2 gap-5">

                    @foreach($trip->packingLists as $item)

                        <div
                            class="flex justify-between items-center rounded-2xl bg-slate-50 p-5 border border-slate-200 hover:shadow-md transition"
                        >

                            <div class="flex items-center gap-4">

                                <form
                                    action="{{ route('packing-lists.check',$item) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="w-7 h-7 rounded-lg border-2 border-cyan-400 flex items-center justify-center transition
                                            {{ $item->is_checked ? 'bg-cyan-500 border-cyan-500' : 'bg-white hover:border-cyan-300' }}"
                                    >
                                        @if($item->is_checked)
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @endif
                                    </button>

                                </form>

                                <div>

                                    <h4 class="font-bold text-lg">

                                        @if($item->is_checked)
                                            <span class="line-through text-gray-400">
                                                {{ $item->item_name }}
                                            </span>
                                        @else
                                            {{ $item->item_name }}
                                        @endif

                                    </h4>

                                    <p class="text-gray-500">
                                        {{ ucfirst($item->category) }}
                                    </p>

                                </div>

                            </div>

                            <span class="bg-cyan-100 text-cyan-700 px-4 py-2 rounded-full font-bold">
                                x{{ $item->quantity }}
                            </span>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="bg-slate-50 rounded-3xl p-8 text-center border">

                    <div class="text-6xl mb-4">
                        🎒
                    </div>

                    <p class="text-gray-500 text-lg">
                        Packing list belum dibuat.
                    </p>

                    <p class="text-gray-400 mt-2">
                        Klik tombol Generate Packing untuk membuat daftar barang otomatis.
                    </p>

                </div>

            @endif

        </div>

        <!-- ACTION BUTTONS -->

        <div class="flex flex-wrap gap-4">

            <form
                action="{{ route('trips.generate',$trip) }}"
                method="POST"
            >
                @csrf

                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold transition"
                >
                    🎒 Generate Packing
                </button>

            </form>

            <a
                href="{{ route('trips.edit', $trip) }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-8 py-4 rounded-2xl font-bold transition"
            >
                ✏️ Edit
            </a>

            <form
                action="{{ route('trips.destroy',$trip) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus trip ini?')"
            >
                @csrf
                @method('DELETE')

                <button
                    class="bg-red-500 hover:bg-red-600 text-white px-8 py-4 rounded-2xl font-bold transition"
                >
                    🗑️ Hapus
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>
