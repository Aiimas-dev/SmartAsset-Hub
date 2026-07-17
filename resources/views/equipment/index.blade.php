<x-app-layout>

<div class="space-y-8">

    <div class="flex justify-between items-center">

        <div>
            <h2 class="text-3xl font-extrabold">
                Data Peralatan
            </h2>

            <p class="text-gray-500 mt-2">
                Kelola seluruh peralatan pada Smart Hub Management System
            </p>
        </div>


        <a href="{{ route('equipment.create') }}"
           class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-6 py-3 rounded-xl shadow-lg">

            + Tambah Peralatan

        </a>

    </div>


    @if(session('success'))

        <div class="bg-green-100 text-green-700 px-5 py-4 rounded-xl">

            {{ session('success') }}

        </div>

    @endif



    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">
                        No
                    </th>

                    <th class="px-6 py-4 text-left">
                        Kode
                    </th>

                    <th class="px-6 py-4 text-left">
                        Nama Peralatan
                    </th>

                    <th class="px-6 py-4 text-left">
                        Kategori
                    </th>

                    <th class="px-6 py-4 text-left">
                        Stock
                    </th>

                    <th class="px-6 py-4 text-left">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>


            @forelse($equipment as $item)

                <tr class="border-b hover:bg-slate-50">


                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>


                    <td class="px-6 py-4 font-semibold">
                        {{ $item->code }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $item->name }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $item->category->name ?? '-' }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $item->stock }}
                    </td>


                    <td class="px-6 py-4">

                        @if($item->status == 'Available')

                            <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm">

                                Available

                            </span>

                        @else

                            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-sm">

                                Borrowed

                            </span>

                        @endif

                    </td>


                    <td class="px-6 py-4 text-center">


                        <a href="{{ route('equipment.edit',$item->id) }}"
                           class="px-4 py-2 bg-blue-500 text-white rounded-lg">

                            Edit

                        </a>


                        <form action="{{ route('equipment.destroy',$item->id) }}"
                              method="POST"
                              class="inline">

                            @csrf
                            @method('DELETE')


                            <button
                                onclick="return confirm('Hapus data ini?')"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg">

                                Hapus

                            </button>

                        </form>


                    </td>


                </tr>


            @empty

                <tr>

                    <td colspan="7"
                        class="text-center py-10 text-gray-500">

                        Belum ada data peralatan

                    </td>

                </tr>


            @endforelse


            </tbody>


        </table>


    </div>


</div>


</x-app-layout>