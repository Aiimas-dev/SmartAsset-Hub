<template>

<div class="min-h-screen bg-slate-100 p-6">

    <div class="max-w-7xl mx-auto">


        <!-- HEADER -->

        <div class="bg-white rounded-3xl shadow p-8 flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Halo, {{ user.name }} 👋
                </h1>

                <p class="text-gray-500 mt-2">
                    Selamat datang di Smart Hub Management System
                </p>

            </div>


            <div class="bg-blue-600 text-white rounded-2xl p-5 text-4xl">
                💻
            </div>


        </div>




        <!-- STAT CARD -->

        <div class="grid md:grid-cols-4 gap-6 mt-8">


            <div class="bg-blue-600 text-white rounded-3xl p-6 shadow">

                <p>
                    Total Peralatan
                </p>

                <h2 class="text-4xl font-bold mt-3">
                    {{ totalEquipment }}
                </h2>

            </div>



            <div class="bg-emerald-600 text-white rounded-3xl p-6 shadow">

                <p>
                    Total Kategori
                </p>

                <h2 class="text-4xl font-bold mt-3">
                    {{ totalCategory }}
                </h2>

            </div>




            <div class="bg-orange-500 text-white rounded-3xl p-6 shadow">

                <p>
                    Sedang Dipinjam
                </p>

                <h2 class="text-4xl font-bold mt-3">
                    {{ borrowedEquipment }}
                </h2>

            </div>




            <div class="bg-slate-800 text-white rounded-3xl p-6 shadow">

                <p>
                    Tersedia
                </p>

                <h2 class="text-4xl font-bold mt-3">
                    {{ availableEquipment }}
                </h2>

            </div>



        </div>





        <!-- CONTENT -->

        <div class="grid lg:grid-cols-3 gap-6 mt-8">



            <!-- TABLE -->

            <div class="lg:col-span-2 bg-white rounded-3xl shadow p-8">


                <div class="flex justify-between mb-6">


                    <h2 class="text-2xl font-bold text-slate-800">
                        Peralatan Terbaru
                    </h2>


                    <a href="/equipment"
                       class="text-blue-600 font-semibold">
                        Lihat Semua
                    </a>


                </div>



                <table class="w-full">


                    <thead>

                        <tr class="border-b">

                            <th class="text-left py-3">
                                Nama
                            </th>

                            <th class="text-left py-3">
                                Status
                            </th>

                            <th class="text-left py-3">
                                Tanggal
                            </th>


                        </tr>

                    </thead>



                    <tbody>


                    <tr
                    v-for="item in latestEquipment"
                    :key="item.id"
                    class="border-b"
                    >


                        <td class="py-4 font-semibold">
                            {{ item.name }}
                        </td>



                        <td>


                            <span
                            v-if="item.status=='Available'"
                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full"
                            >
                                Available
                            </span>


                            <span
                            v-else-if="item.status=='Borrowed'"
                            class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full"
                            >
                                Borrowed
                            </span>


                            <span
                            v-else
                            class="bg-red-100 text-red-700 px-3 py-1 rounded-full"
                            >
                                Maintenance
                            </span>


                        </td>



                        <td class="text-gray-500">

                            {{ item.created_at }}

                        </td>


                    </tr>


                    </tbody>



                </table>


            </div>





            <!-- ACTION -->

            <div class="bg-white rounded-3xl shadow p-8">


                <h2 class="text-2xl font-bold mb-6">
                    Quick Action
                </h2>



                <div class="space-y-4">


                    <a href="/equipment/create"
                       class="block bg-blue-600 text-white p-4 rounded-xl font-bold">

                        + Tambah Peralatan

                    </a>



                    <a href="/categories/create"
                       class="block bg-emerald-600 text-white p-4 rounded-xl font-bold">

                        + Tambah Kategori

                    </a>



                    <a href="/transactions/create"
                       class="block bg-orange-500 text-white p-4 rounded-xl font-bold">

                        + Buat Transaksi

                    </a>



                </div>


            </div>


        </div>



    </div>


</div>


</template>




<script setup>


defineProps({

    user:Object,

    totalEquipment:Number,

    totalCategory:Number,

    borrowedEquipment:Number,

    availableEquipment:Number,

    latestEquipment:Array

})


</script>