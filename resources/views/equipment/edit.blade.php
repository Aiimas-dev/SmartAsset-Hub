<x-app-layout>

<div class="space-y-8">


    <div>

        <h2 class="text-3xl font-extrabold">
            Edit Peralatan
        </h2>

        <p class="text-gray-500 mt-2">
            Perbarui data peralatan pada Smart Hub Management System
        </p>

    </div>




    <div class="bg-white shadow-lg rounded-3xl p-8">


        <form action="{{ route('equipment.update', $equipment->id) }}"
              method="POST">

            @csrf
            @method('PUT')



            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">



                <!-- Kategori -->

                <div>

                    <label class="font-semibold">
                        Kategori
                    </label>


                    <select name="category_id"
                            class="w-full mt-2 rounded-xl border-gray-300">


                        <option value="">
                            Pilih Kategori
                        </option>


                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                            
                                {{ $equipment->category_id == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>


                        @endforeach


                    </select>


                    @error('category_id')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>





                <!-- Nama -->

                <div>

                    <label class="font-semibold">
                        Nama Peralatan
                    </label>


                    <input type="text"
                           name="name"
                           value="{{ old('name', $equipment->name) }}"
                           class="w-full mt-2 rounded-xl border-gray-300">



                    @error('name')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>





                <!-- Kode -->

                <div>

                    <label class="font-semibold">
                        Kode Peralatan
                    </label>


                    <input type="text"
                           name="code"
                           value="{{ old('code', $equipment->code) }}"
                           class="w-full mt-2 rounded-xl border-gray-300">



                    @error('code')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>





                <!-- Stock -->

                <div>

                    <label class="font-semibold">
                        Jumlah Stock
                    </label>


                    <input type="number"
                           name="stock"
                           value="{{ old('stock', $equipment->stock) }}"
                           class="w-full mt-2 rounded-xl border-gray-300">



                    @error('stock')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>





                <!-- Status -->

                <div>

                    <label class="font-semibold">
                        Status
                    </label>


                    <select name="status"
                            class="w-full mt-2 rounded-xl border-gray-300">


                        <option value="Available"
                            {{ $equipment->status == 'Available' ? 'selected' : '' }}>

                            Available

                        </option>



                        <option value="Borrowed"
                            {{ $equipment->status == 'Borrowed' ? 'selected' : '' }}>

                            Borrowed

                        </option>


                    </select>


                    @error('status')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                    @enderror


                </div>



            </div>





            <!-- Deskripsi -->

            <div class="mt-6">


                <label class="font-semibold">
                    Deskripsi
                </label>


                <textarea name="description"
                          rows="4"
                          class="w-full mt-2 rounded-xl border-gray-300">{{ old('description', $equipment->description) }}</textarea>


            </div>





            <div class="flex justify-end gap-4 mt-8">


                <a href="{{ route('equipment.index') }}"
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