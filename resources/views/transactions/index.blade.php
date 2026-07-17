<x-app-layout>

<div class="space-y-8">


    <div class="flex justify-between items-center">


        <div>

            <h2 class="text-3xl font-extrabold">
                Data Transaksi
            </h2>

            <p class="text-gray-500 mt-2">
                Kelola peminjaman dan pengembalian peralatan Smart Hub
            </p>

        </div>



        <a href="{{ route('transactions.create') }}"
           class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white px-6 py-3 rounded-xl shadow-lg">

            + Tambah Transaksi

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
                        Peralatan
                    </th>


                    <th class="px-6 py-4 text-left">
                        Peminjam
                    </th>


                    <th class="px-6 py-4 text-left">
                        Tanggal Pinjam
                    </th>


                    <th class="px-6 py-4 text-left">
                        Tanggal Kembali
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


            @forelse($transactions as $item)


                <tr class="border-b hover:bg-slate-50">


                    <td class="px-6 py-4">

                        {{ $loop->iteration }}

                    </td>




                    <td class="px-6 py-4 font-semibold">

                        {{ $item->equipment->name ?? '-' }}

                    </td>




                    <td class="px-6 py-4">

                        {{ $item->borrower }}

                    </td>




                    <td class="px-6 py-4">

                        {{ $item->borrow_date }}

                    </td>




                    <td class="px-6 py-4">

                        {{ $item->return_date ?? '-' }}

                    </td>





                    <td class="px-6 py-4">


                        @if($item->status == 'Borrowed')


                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm">

                                Dipinjam

                            </span>


                        @else


                            <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm">

                                Dikembalikan

                            </span>


                        @endif


                    </td>





                    <td class="px-6 py-4 text-center">


                        <a href="{{ route('transactions.edit',$item->id) }}"
                           class="px-4 py-2 bg-blue-500 text-white rounded-lg">

                            Edit

                        </a>




                        <form action="{{ route('transactions.destroy',$item->id) }}"
                              method="POST"
                              class="inline">


                            @csrf
                            @method('DELETE')



                            <button
                                onclick="return confirm('Hapus transaksi ini?')"
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


                        Belum ada transaksi


                    </td>


                </tr>


            @endforelse



            </tbody>



        </table>



    </div>



</div>


</x-app-layout>