<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800">
            Data Kategori
        </h2>
    </x-slot>

    <div class="min-h-screen bg-slate-100 py-10">

        <div class="max-w-7xl mx-auto px-6">

            @if(session('success'))

                <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-6 py-4 rounded-2xl">

                    {{ session('success') }}

                </div>

            @endif

            <!-- HEADER -->

            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-[35px] p-10 shadow-xl text-white">

                <div class="flex justify-between items-center">

                    <div>

                        <h1 class="text-5xl font-extrabold">

                            Data Kategori

                        </h1>

                        <p class="mt-3 text-lg">

                            Kelola kategori peralatan pada Smart Hub Management System.

                        </p>

                    </div>

                    <a href="{{ route('categories.create') }}"
                       class="bg-white text-cyan-600 px-8 py-4 rounded-2xl font-bold hover:scale-105 transition">

                        ➕ Tambah Kategori

                    </a>

                </div>

            </div>

            <!-- TABLE -->

            <div class="bg-white rounded-[35px] shadow-lg mt-8 overflow-hidden">

                <table class="w-full">

                    <thead class="bg-slate-100">

                        <tr>

                            <th class="text-left px-8 py-5">
                                No
                            </th>

                            <th class="text-left px-8 py-5">
                                Nama Kategori
                            </th>

                            <th class="text-left px-8 py-5">
                                Dibuat
                            </th>

                            <th class="text-center px-8 py-5">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)

                        <tr class="border-b hover:bg-slate-50">

                            <td class="px-8 py-6">

                                {{ $loop->iteration }}

                            </td>

                            <td class="px-8 py-6 font-semibold">

                                {{ $category->name }}

                            </td>

                            <td class="px-8 py-6 text-gray-500">

                                {{ $category->created_at->format('d M Y') }}

                            </td>

                            <td class="px-8 py-6">

                                <div class="flex justify-center gap-3">

                                    <a
                                        href="{{ route('categories.edit',$category) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-5 py-2 rounded-xl">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('categories.destroy',$category) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Hapus kategori ini?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty
                                                    <tr>

                                <td colspan="4" class="text-center py-20">

                                    <div class="text-7xl mb-5">
                                        📂
                                    </div>

                                    <h2 class="text-3xl font-bold text-slate-700">

                                        Belum Ada Kategori

                                    </h2>

                                    <p class="text-gray-500 mt-3">

                                        Silakan tambahkan kategori pertama untuk mulai mengelola inventaris.

                                    </p>

                                    <a
                                        href="{{ route('categories.create') }}"
                                        class="inline-block mt-8 bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-8 py-4 rounded-2xl font-bold hover:scale-105 transition">

                                        ➕ Tambah Kategori

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- INFO CARD -->

            <div class="mt-8 bg-white rounded-[35px] shadow-lg p-8">

                <h2 class="text-2xl font-bold text-slate-800">

                    Informasi

                </h2>

                <p class="text-gray-600 mt-4 leading-8">

                    Kategori digunakan untuk mengelompokkan setiap peralatan inventaris.
                    Contohnya seperti Laptop, Printer, Kamera, Proyektor,
                    Networking, Furniture, dan perangkat lainnya sehingga proses
                    pencarian dan pengelolaan inventaris menjadi lebih mudah.

                </p>

            </div>

        </div>

    </div>

</x-app-layout>