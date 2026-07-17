<x-app-layout>


<div class="min-h-screen bg-slate-100 py-10">


<div class="max-w-6xl mx-auto px-6">



@if(session('success'))

<div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-6 py-4 rounded-2xl">

✅ {{ session('success') }}

</div>

@endif




<!-- HEADER -->


<div class="bg-gradient-to-r from-cyan-500 via-sky-500 to-emerald-500 rounded-[35px] p-10 text-white shadow-xl mb-10">


<h1 class="text-4xl font-extrabold">

🎒 Packing List

</h1>


<p class="mt-3 text-lg">

{{ $trip->destination_name }}

</p>


<p class="mt-2">

📅 
{{ \Carbon\Carbon::parse($trip->departure_date)->format('d M Y') }}

-

{{ \Carbon\Carbon::parse($trip->return_date)->format('d M Y') }}

</p>



</div>





<div class="flex justify-between items-center mb-8">


<h2 class="text-3xl font-bold text-slate-800">

Daftar Barang

</h2>




<a
href="{{ route('packing.create',$trip) }}"
class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-3 rounded-xl font-bold"
>

➕ Tambah Barang

</a>



</div>






<div class="bg-white rounded-[35px] shadow-xl p-8">



@forelse($packingLists as $item)



<div class="flex justify-between items-center border-b py-5">


<div>


<h3 class="text-xl font-bold text-slate-800">

{{ $item->item_name }}

</h3>


<p class="text-gray-500">

Kategori :
{{ $item->category ?? '-' }}

</p>


<p class="text-gray-500">

Jumlah :
{{ $item->quantity }}

</p>


</div>




<form
action="{{ route('packing.destroy',$item) }}"
method="POST"
>


@csrf

@method('DELETE')


<button

onclick="return confirm('Hapus barang ini?')"

class="bg-red-500 text-white px-5 py-2 rounded-xl"

>

🗑 Hapus

</button>


</form>



</div>



@empty


<div class="text-center py-16">


<div class="text-7xl">

🎒

</div>


<h3 class="text-2xl font-bold mt-5">

Belum ada barang

</h3>


<p class="text-gray-500 mt-3">

Tambahkan barang bawaan untuk perjalanan ini.

</p>


</div>



@endforelse




</div>





<a
href="{{ route('trips.index') }}"
class="inline-block mt-8 bg-slate-700 text-white px-6 py-3 rounded-xl font-bold"
>

← Kembali Trip

</a>



</div>


</div>


</x-app-layout>