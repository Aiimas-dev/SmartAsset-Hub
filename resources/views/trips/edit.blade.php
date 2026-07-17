<x-app-layout>

<div class="min-h-screen bg-slate-100 p-8">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-[35px] p-8 text-white shadow-xl mb-10">

        <h1 class="text-5xl font-bold mb-3">
            ✏️ Edit Perjalanan
        </h1>

        <p class="text-xl opacity-90">
            Perbarui informasi perjalananmu agar packing list tetap sesuai. 🧳
        </p>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-[35px] shadow-xl p-10 max-w-5xl mx-auto">

        <form action="{{ route('trips.update', $trip) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-8">

                <!-- Nama Destinasi -->
                <div>

                    <label class="font-bold text-slate-700 block mb-3">
                        Nama Destinasi
                    </label>

                    <input
                        type="text"
                        name="destination_name"
                        value="{{ old('destination_name', $trip->destination_name) }}"
                        class="w-full border border-gray-300 rounded-2xl p-4 focus:ring-2 focus:ring-cyan-400 focus:outline-none"
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

                        <option value="pantai" @selected($trip->destination_type=='pantai')>
                            Pantai
                        </option>

                        <option value="gunung" @selected($trip->destination_type=='gunung')>
                            Gunung
                        </option>

                        <option value="kota" @selected($trip->destination_type=='kota')>
                            Kota
                        </option>

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

                        <option value="pesawat" @selected($trip->transportation=='pesawat')>Pesawat</option>

                        <option value="kereta" @selected($trip->transportation=='kereta')>Kereta</option>

                        <option value="mobil" @selected($trip->transportation=='mobil')>Mobil</option>

                        <option value="motor" @selected($trip->transportation=='motor')>Motor</option>

                        <option value="bus" @selected($trip->transportation=='bus')>Bus</option>

                        <option value="kapal" @selected($trip->transportation=='kapal')>Kapal</option>

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

                        <option value="hotel" @selected($trip->accommodation=='hotel')>
                            Hotel
                        </option>

                        <option value="villa" @selected($trip->accommodation=='villa')>
                            Villa
                        </option>

                        <option value="camping" @selected($trip->accommodation=='camping')>
                            Camping
                        </option>

                        <option value="rumah_saudara" @selected($trip->accommodation=='rumah_saudara')>
                            Rumah Saudara
                        </option>

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

                        <option value="backpacker" @selected($trip->travel_style=='backpacker')>
                            Backpacker
                        </option>

                        <option value="regular" @selected($trip->travel_style=='regular')>
                            Regular
                        </option>

                        <option value="luxury" @selected($trip->travel_style=='luxury')>
                            Luxury
                        </option>

                    </select>

                </div>

                <!-- Obat -->
                <div class="flex items-end">

                    <label class="flex items-center gap-3 font-semibold text-slate-700">

                        <input
                            type="checkbox"
                            name="has_medication"
                            value="1"
                            {{ $trip->has_medication ? 'checked' : '' }}
                            class="w-5 h-5"
                        >

                         Membawa Obat Pribadi

                    </label>

                </div>

                <!-- Berangkat -->
                <div>

                    <label class="font-bold text-slate-700 block mb-3">
                        📅 Tanggal Berangkat
                    </label>

                    <input
                        type="date"
                        name="departure_date"
                        value="{{ $trip->departure_date }}"
                        class="w-full border border-gray-300 rounded-2xl p-4"
                    >

                </div>

                <!-- Pulang -->
                <div>

                    <label class="font-bold text-slate-700 block mb-3">
                        🗓️ Tanggal Pulang
                    </label>

                    <input
                        type="date"
                        name="return_date"
                        value="{{ $trip->return_date }}"
                        class="w-full border border-gray-300 rounded-2xl p-4"
                    >

                </div>

            </div>

            <!-- Catatan -->
            <div class="mt-8">

                <label class="font-bold text-slate-700 block mb-3">
                    📝 Catatan
                </label>

                <textarea
                    name="notes"
                    rows="4"
                    class="w-full border border-gray-300 rounded-2xl p-4"
                >{{ old('notes',$trip->notes) }}</textarea>

            </div>

                        <!-- BUTTON -->
            <div class="mt-10 flex flex-wrap gap-4">

                <button
                    type="submit"
                    class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-10 py-4 rounded-2xl text-lg font-bold hover:scale-105 transition duration-300"
                >
                    💾 Simpan Perubahan
                </button>

                <a
                    href="{{ route('trips.index') }}"
                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-10 py-4 rounded-2xl text-lg font-bold transition duration-300"
                >
                    ← Kembali
                </a>

            </div>

        </form>

    </div>

    <!-- INFO -->
    <div class="max-w-5xl mx-auto mt-8">

        <div class="bg-cyan-50 border border-cyan-200 rounded-3xl p-6">

            <h3 class="text-xl font-bold text-cyan-700 mb-3">
                💡 Tips
            </h3>

            <ul class="space-y-2 text-slate-700">

                <li>
                    • Jika destinasi berubah, sebaiknya Generate Packing List kembali.
                </li>

                <li>
                    • Perubahan transportasi atau akomodasi dapat memengaruhi barang bawaan.
                </li>

                <li>
                    • Pastikan tanggal perjalanan sudah benar sebelum disimpan.
                </li>

            </ul>

        </div>

    </div>

</div>

</x-app-layout>
