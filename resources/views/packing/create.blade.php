<x-app-layout>


<div class="min-h-screen bg-slate-100 py-10">


<div class="max-w-xl mx-auto px-6">


<div class="bg-white rounded-[35px] shadow-xl p-8">


<h1 class="text-3xl font-bold mb-8">

➕ Tambah Barang Packing

</h1>



<form action="{{ route('packing.store',$trip) }}" method="POST">


@csrf



<div class="mb-5">

<label class="font-semibold">
Nama Barang
</label>

<input
type="text"
name="item_name"
class="w-full rounded-xl border mt-2"
placeholder="Contoh: Baju"
>

</div>





<div class="mb-5">

<label class="font-semibold">
Kategori
</label>

<input
type="text"
name="category"
class="w-full rounded-xl border mt-2"
placeholder="Pakaian"
>

</div>





<div class="mb-5">

<label class="font-semibold">
Jumlah
</label>

<input
type="number"
name="quantity"
class="w-full rounded-xl border mt-2"
value="1"
>

</div>





<button
class="bg-cyan-500 text-white px-8 py-3 rounded-xl font-bold"
>

Simpan

</button>



</form>


</div>


</div>


</div>


</x-app-layout>