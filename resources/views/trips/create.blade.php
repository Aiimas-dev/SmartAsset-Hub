<x-app-layout>

<div
    class="min-h-screen bg-slate-100 p-8"
>

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-[35px] p-8 text-white shadow-xl mb-10">

        <h1 class="text-5xl font-bold mb-3">
            Tambah Perjalanan Baru
        </h1>

        <p class="text-xl opacity-90">
            Isi detail perjalananmu dan biarkan Smart Packing Assistant menyiapkan barang bawaanmu. 
        </p>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-[35px] shadow-xl p-10 max-w-5xl mx-auto">

        <form action="{{ route('trips.store') }}" method="POST">
            @csrf

            <div class="grid md:grid-cols-2 gap-8">

                <!-- Nama Destinasi -->
                <div>
                    <label class="font-bold text-slate-700 block mb-3">
                        Nama Destinasi
                    </label>

                    <input
                        type="text"
                        name="destination_name"
                        class="w-full border border-gray-300 rounded-2xl p-4 focus:ring-2 focus:ring-cyan-400 focus:outline-none"
                        placeholder="Contoh: Bali"
                    >
                </div>

                <!-- Kategori -->
                <div>
                    <label class="font-bold text-slate-700 block mb-3">
                        Kategori Destinasi
                    </label>

                    <select
                        name="destination_type"
                        class="w-full border border-gray-300 rounded-2xl p-4"
                    >
                        <option value="pantai">Pantai</option>
                        <option value="gunung">Gunung</option>
                        <option value="kota">Kota</option>
                    </select>
                </div>

                <!-- Transportasi -->
                <div>
                    <label class="font-bold text-slate-700 block mb-3">
                        Transportasi
                    </label>

                    <select
                        name="transportation"
                        class="w-full border border-gray-300 rounded-2xl p-4"
                    >
                        <option value="pesawat">Pesawat</option>
                        <option value="kereta">Kereta</option>
                        <option value="mobil">Mobil</option>
                        <option value="motor">Motor</option>
                        <option value="bus">Bus</option>
                        <option value="kapal">Kapal</option>
                    </select>
                </div>

                <!-- Akomodasi -->
                <div>
                    <label class="font-bold text-slate-700 block mb-3">
                        Akomodasi
                    </label>

                    <select
                        name="accommodation"
                        class="w-full border border-gray-300 rounded-2xl p-4"
                    >
                        <option value="hotel">Hotel</option>
                        <option value="villa">Villa</option>
                        <option value="camping">Camping</option>
                        <option value="rumah_saudara">Rumah Saudara</option>
                    </select>
                </div>

                <!-- Gaya -->
                <div>
                    <label class="font-bold text-slate-700 block mb-3">
                         Gaya Perjalanan
                    </label>

                    <select
                        name="travel_style"
                        class="w-full border border-gray-300 rounded-2xl p-4"
                    >
                        <option value="backpacker">Backpacker</option>
                        <option value="regular">Regular</option>
                        <option value="luxury">Luxury</option>
                    </select>
                </div>

                <!-- Obat -->
                <div class="flex items-end">
                    <label class="flex items-center gap-3 font-semibold text-slate-700">
                        <input
                            type="checkbox"
                            name="has_medication"
                            value="1"
                            class="w-5 h-5"
                        >

                         Membawa Obat Pribadi
                    </label>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="font-bold text-slate-700 block mb-3">
                        📅 Tanggal Berangkat
                    </label>

                    <input
                        type="date"
                        name="departure_date"
                        class="w-full border border-gray-300 rounded-2xl p-4"
                    >
                </div>

                <div>
                    <label class="font-bold text-slate-700 block mb-3">
                        🗓️ Tanggal Pulang
                    </label>

                    <input
                        type="date"
                        name="return_date"
                        class="w-full border border-gray-300 rounded-2xl p-4"
                    >
                </div>

            </div>

            <!-- Catatan -->
            <div class="mt-8">

                <label class="font-bold text-slate-700 block mb-3">
                    📝 Catatan Tambahan
                </label>

                <textarea
                    name="notes"
                    rows="4"
                    class="w-full border border-gray-300 rounded-2xl p-4"
                    placeholder="Misalnya: bawa kamera, travelling bersama keluarga, dll."
                ></textarea>

            </div>

            <!-- BUTTON -->
            <div class="mt-10 flex gap-4">

                <button
                    type="submit"
                    class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-10 py-4 rounded-2xl text-lg font-bold hover:scale-105 transition"
                >
                    💾 Simpan Perjalanan
                </button>

                <a
                    href="{{ route('trips.index') }}"
                    class="bg-gray-200 text-gray-700 px-8 py-4 rounded-2xl font-bold hover:bg-gray-300 transition"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</x-app-layout>
