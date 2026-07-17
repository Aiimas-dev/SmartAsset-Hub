<x-app-layout>

<div class="max-w-4xl mx-auto py-10">


<div class="bg-white rounded-3xl shadow-lg p-8">


<h2 class="text-3xl font-extrabold mb-8">
    Edit Profile
</h2>



<form action="{{ route('profile.update') }}"
      method="POST">


@csrf



<div class="grid grid-cols-1 md:grid-cols-2 gap-6">



<div>

<label class="font-semibold">
Nama
</label>


<input type="text"
name="name"
value="{{ old('name',$user->name) }}"
class="w-full mt-2 rounded-xl border-gray-300">


</div>





<div>

<label class="font-semibold">
Email
</label>


<input type="email"
name="email"
value="{{ old('email',$user->email) }}"
class="w-full mt-2 rounded-xl border-gray-300">


</div>





<div>

<label class="font-semibold">
Nomor HP
</label>


<input type="text"
name="phone"
value="{{ old('phone',$user->phone) }}"
class="w-full mt-2 rounded-xl border-gray-300">


</div>





<div>

<label class="font-semibold">
Gender
</label>


<select name="gender"
class="w-full mt-2 rounded-xl border-gray-300">


<option value="">
Pilih Gender
</option>


<option value="Laki-laki"
{{ $user->gender=="Laki-laki"?'selected':'' }}>
Laki-laki
</option>


<option value="Perempuan"
{{ $user->gender=="Perempuan"?'selected':'' }}>
Perempuan
</option>


</select>


</div>





<div>

<label class="font-semibold">
Tanggal Lahir
</label>


<input type="date"
name="birth_date"
value="{{ $user->birth_date }}"
class="w-full mt-2 rounded-xl border-gray-300">


</div>


</div>





<div class="mt-6">

<label class="font-semibold">
Alamat
</label>


<textarea name="address"
rows="4"
class="w-full mt-2 rounded-xl border-gray-300">{{ $user->address }}</textarea>


</div>





<div class="flex justify-end gap-4 mt-8">


<a href="{{ route('profile') }}"
class="px-6 py-3 bg-gray-200 rounded-xl">

Kembali

</a>



<button
class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-xl">

Simpan

</button>


</div>



</form>


</div>


</div>


</x-app-layout>