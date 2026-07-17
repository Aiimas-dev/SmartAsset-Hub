<x-app-layout>

<div class="min-h-screen bg-slate-100 py-10">

<div class="max-w-4xl mx-auto px-6">


<div class="bg-white rounded-3xl shadow-lg p-8">


<div class="flex justify-between items-center mb-8">


<h1 class="text-3xl font-bold text-slate-800">
Tambah Kategori
</h1>


<a href="{{ route('categories.index') }}"
class="bg-slate-600 text-white px-6 py-3 rounded-xl">

Kembali

</a>


</div>




<form action="{{ route('categories.store') }}" method="POST">

@csrf



<div class="mb-6">


<label class="font-semibold text-slate-700">

Nama Kategori

</label>


<input
type="text"
name="name"
value="{{ old('name') }}"
placeholder="Contoh: Laptop, Kamera, Elektronik"

class="mt-2 w-full rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500"
>


@error('name')

<p class="text-red-500 text-sm mt-2">

{{ $message }}

</p>

@enderror


</div>





<div class="mb-6">


<label class="font-semibold text-slate-700">

Deskripsi

</label>


<textarea
name="description"
rows="4"
placeholder="Masukkan deskripsi kategori"

class="mt-2 w-full rounded-xl border-gray-300"
>{{ old('description') }}</textarea>


</div>





<button
type="submit"

class="
bg-blue-700
hover:bg-blue-800
text-white
px-8
py-3
rounded-xl
font-bold">

Simpan Kategori

</button>



</form>



</div>


</div>


</div>


</x-app-layout>