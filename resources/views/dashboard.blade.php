<x-app-layout>

<x-slot name="header">

    <h2 class="font-bold text-xl text-slate-800">
        Dashboard Smart Hub
    </h2>

</x-slot>



<div class="min-h-screen bg-slate-200 py-10">


<div class="max-w-7xl mx-auto px-6">



<!-- HEADER -->

<div class="bg-white rounded-3xl shadow-md border p-8 flex justify-between items-center">


<div>

<h1 class="text-4xl font-extrabold text-slate-900">

Halo, {{ auth()->user()->name }}

</h1>


<p class="text-slate-600 mt-3 text-lg">

Selamat datang di Smart Hub Management System

</p>


</div>



<div class="w-20 h-20 rounded-2xl 
bg-blue-700 flex items-center justify-center 
text-white text-4xl shadow-lg">

🏢

</div>


</div>






<!-- HERO -->


<div class="mt-8">


<div class="
rounded-3xl
bg-gradient-to-r
from-blue-900
via-blue-700
to-cyan-600
p-10
shadow-xl
text-white
">


<div class="inline-block bg-white/20 px-5 py-2 rounded-full">

Management System

</div>



<h2 class="text-5xl font-extrabold mt-6">

Smart Inventory Management

</h2>



<p class="mt-5 text-lg text-blue-100 max-w-3xl">


Kelola kategori, peralatan, transaksi peminjaman,
dan monitoring inventaris perusahaan
dalam satu sistem terintegrasi.


</p>



<div class="flex gap-4 mt-8">


<a href="{{ route('equipment.create') }}"

class="
bg-white
text-blue-700
font-bold
px-8
py-4
rounded-xl
hover:bg-blue-50">


+ Tambah Peralatan

</a>




<a href="{{ route('transactions.create') }}"

class="
border border-white/50
px-8
py-4
rounded-xl
font-bold
hover:bg-white/10">


Transaksi

</a>


</div>


</div>


</div>








<!-- STATISTIC -->


<div class="grid lg:grid-cols-4 gap-6 mt-8">



<!-- TOTAL -->


<div class="
bg-white
border-l-8
border-blue-600
rounded-2xl
shadow-md
p-7">


<div class="flex justify-between">


<div>

<p class="text-slate-500 font-semibold">

Total Peralatan

</p>


<h2 class="text-5xl font-extrabold text-slate-900 mt-3">

{{ $totalEquipment }}

</h2>


</div>


<div class="
w-14 h-14
rounded-xl
bg-blue-100
flex items-center
justify-center
text-3xl">

💻

</div>


</div>


</div>






<!-- CATEGORY -->


<div class="
bg-white
border-l-8
border-cyan-500
rounded-2xl
shadow-md
p-7">


<div class="flex justify-between">


<div>

<p class="text-slate-500 font-semibold">

Total Kategori

</p>


<h2 class="text-5xl font-extrabold text-slate-900 mt-3">

{{ $totalCategory }}

</h2>


</div>


<div class="
w-14 h-14
rounded-xl
bg-cyan-100
flex items-center
justify-center
text-3xl">

📂

</div>


</div>


</div>






<!-- BORROW -->


<div class="
bg-white
border-l-8
border-orange-500
rounded-2xl
shadow-md
p-7">


<div class="flex justify-between">


<div>

<p class="text-slate-500 font-semibold">

Sedang Dipinjam

</p>


<h2 class="text-5xl font-extrabold text-orange-600 mt-3">

{{ $borrowedEquipment }}

</h2>


</div>



<div class="
w-14 h-14
rounded-xl
bg-orange-100
flex items-center
justify-center
text-3xl">

📤

</div>


</div>


</div>






<!-- AVAILABLE -->


<div class="
bg-gradient-to-br
from-emerald-600
to-green-500
rounded-2xl
shadow-md
p-7
text-white">


<p class="font-semibold">

Peralatan Tersedia

</p>


<h2 class="text-5xl font-extrabold mt-3">

{{ $availableEquipment }}

</h2>


<div class="
mt-5
w-14
h-14
rounded-xl
bg-white/20
flex
items-center
justify-center
text-3xl">

✓

</div>


</div>




</div>

            <!-- CONTENT -->

            <div class="grid lg:grid-cols-3 gap-8 mt-8">

                <!-- TABLE -->

                <div class="lg:col-span-2">

                    <div class="bg-white rounded-[35px] shadow-lg p-8">

                        <div class="flex justify-between items-center mb-8">

                            <div>

                                <h2 class="text-3xl font-bold text-slate-800">
                                    Daftar Peralatan Terbaru
                                </h2>

                                <p class="text-gray-500 mt-2">
                                    Peralatan yang terakhir ditambahkan ke sistem.
                                </p>

                            </div>

                            <a href="{{ route('equipment.index') }}"
                               class="text-cyan-600 font-bold hover:underline">

                                Lihat Semua →

                            </a>

                        </div>

                        <div class="overflow-x-auto">

                            <table class="w-full">

                                <thead>

                                    <tr class="border-b">

                                        <th class="text-left py-4">
                                            Nama
                                        </th>

                                        <th class="text-left py-4">
                                            Status
                                        </th>

                                        <th class="text-left py-4">
                                            Dibuat
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($latestEquipment as $item)

                                                                            <tr class="border-b hover:bg-slate-50">

                                            <td class="py-5 font-semibold text-slate-700">
                                                {{ $item->name }}
                                            </td>

                                            <td>

                                                @if($item->status=='Available')

                                                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                                        Available
                                                    </span>

                                                @elseif($item->status=='Borrowed')

                                                    <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-semibold">
                                                        Borrowed
                                                    </span>

                                                @else

                                                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                                                        Maintenance
                                                    </span>

                                                @endif

                                            </td>

                                            <td class="text-gray-500">
                                                {{ $item->created_at->format('d M Y') }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="3" class="py-16 text-center text-gray-500">

                                                <div class="text-6xl mb-4">
                                                    📦
                                                </div>

                                                Belum ada data peralatan.

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- SIDEBAR -->

                <div class="space-y-8">

                    <!-- QUICK ACTION -->

                    <div class="bg-white rounded-[35px] shadow-lg p-8">

                        <h2 class="text-2xl font-bold text-slate-800 mb-6">

                            Quick Action

                        </h2>

                        <div class="space-y-4">

                            <a
                                href="{{ route('equipment.create') }}"
                                class="block bg-cyan-500 hover:bg-cyan-600 text-white rounded-2xl px-6 py-4 font-bold transition">

                                ➕ Tambah Peralatan

                            </a>

                            <a
                                href="{{ route('categories.create') }}"
                                class="block bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl px-6 py-4 font-bold transition">

                                📂 Tambah Kategori

                            </a>

                            <a
                                href="{{ route('transactions.create') }}"
                                class="block bg-orange-500 hover:bg-orange-600 text-white rounded-2xl px-6 py-4 font-bold transition">

                                🔄 Buat Transaksi

                            </a>

                        </div>

                    </div>

                    <!-- INFO -->

                    <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-[35px] p-8 text-white shadow-xl">

                        <h2 class="text-3xl font-bold">

                            Smart Hub

                        </h2>

                        <p class="mt-5 leading-8">

                            Smart Hub Management System membantu perusahaan
                            dalam mengelola inventaris,
                            proses peminjaman,
                            pengembalian,
                            dan monitoring peralatan secara terintegrasi.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>