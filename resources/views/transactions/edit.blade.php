<x-app-layout>

<div class="space-y-8">


    <div>

        <h2 class="text-3xl font-extrabold">
            Edit Transaksi
        </h2>

        <p class="text-gray-500 mt-2">
            Perbarui data peminjaman peralatan Smart Hub
        </p>

    </div>




    <div class="bg-white shadow-lg rounded-3xl p-8">


        <form action="{{ route('transactions.update', $transaction->id) }}"
              method="POST">

            @csrf
            @method('PUT')



            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">



                <!-- Peralatan -->

                <div>

                    <label class="font-semibold">
                        Pilih Peralatan
                    </label>


                    <select name="equipment_id"
                            class="w-full mt-2 rounded-xl border-gray-300">


                        @foreach($equipment as $item)


                            <option value="{{ $item->id }}"
                            
                            {{ $transaction->equipment_id == $item->id ? 'selected' : '' }}>


                                {{ $item->name }}
                                (Stock: {{ $item->stock }})


                            </option>


                        @endforeach


                    </select>


                    @error('equipment_id')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>





                <!-- Peminjam -->

                <div>


                    <label class="font-semibold">
                        Nama Peminjam
                    </label>


                    <input type="text"
                           name="borrower"
                           value="{{ old('borrower', $transaction->borrower) }}"
                           class="w-full mt-2 rounded-xl border-gray-300">



                    @error('borrower')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>







                <!-- Tanggal Pinjam -->

                <div>


                    <label class="font-semibold">
                        Tanggal Pinjam
                    </label>


                    <input type="date"
                           name="borrow_date"
                           value="{{ old('borrow_date', $transaction->borrow_date) }}"
                           class="w-full mt-2 rounded-xl border-gray-300">



                    @error('borrow_date')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>







                <!-- Tanggal Kembali -->

                <div>


                    <label class="font-semibold">
                        Tanggal Kembali
                    </label>


                    <input type="date"
                           name="return_date"
                           value="{{ old('return_date', $transaction->return_date) }}"
                           class="w-full mt-2 rounded-xl border-gray-300">


                </div>







                <!-- Status -->

                <div>


                    <label class="font-semibold">
                        Status
                    </label>


                    <select name="status"
                            class="w-full mt-2 rounded-xl border-gray-300">


                        <option value="Borrowed"
                        
                        {{ $transaction->status == 'Borrowed' ? 'selected' : '' }}>

                            Dipinjam

                        </option>



                        <option value="Returned"

                        {{ $transaction->status == 'Returned' ? 'selected' : '' }}>

                            Dikembalikan

                        </option>


                    </select>



                    @error('status')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>



            </div>







            <div class="flex justify-end gap-4 mt-8">


                <a href="{{ route('transactions.index') }}"
                   class="px-6 py-3 bg-gray-200 rounded-xl">

                    Kembali

                </a>





                <button
                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-xl">


                    Update


                </button>



            </div>




        </form>


    </div>



</div>


</x-app-layout>