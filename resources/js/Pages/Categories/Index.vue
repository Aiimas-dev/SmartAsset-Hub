<script setup>

import { ref } from 'vue'
import axios from 'axios'


const props = defineProps({

    categories:Array

})


const name = ref('')


const addCategory = async()=>{


    await axios.post('/api/categories',{

        name:name.value

    },{

        headers:{

            Authorization:
            'Bearer ' + localStorage.getItem('token')

        }

    })


    name.value=''


    location.reload()


}



const deleteCategory = async(id)=>{


    await axios.delete(

        `/api/categories/${id}`,

        {

            headers:{

                Authorization:
                'Bearer ' + localStorage.getItem('token')

            }

        }

    )


    location.reload()


}


</script>



<template>


<div class="p-8 bg-slate-100 min-h-screen">


<h1 class="text-3xl font-bold mb-6">

Manage Category

</h1>



<div class="bg-white rounded-2xl shadow p-6 mb-6">


<h2 class="font-bold mb-4">

Tambah Kategori

</h2>



<div class="flex gap-3">


<input

v-model="name"

placeholder="Nama kategori"

class="border rounded-xl px-4 py-2 flex-1"

/>



<button

@click="addCategory"

class="bg-blue-600 text-white px-6 rounded-xl">

Tambah

</button>



</div>


</div>





<div class="bg-white rounded-2xl shadow p-6">


<h2 class="font-bold mb-4">

Daftar Kategori

</h2>



<table class="w-full">


<thead>

<tr class="border-b">

<th class="text-left p-3">

No

</th>


<th class="text-left p-3">

Nama

</th>


<th>

Action

</th>


</tr>

</thead>



<tbody>


<tr

v-for="(item,index) in categories"

:key="item.id"

class="border-b">


<td class="p-3">

{{index+1}}

</td>



<td>

{{item.name}}

</td>



<td>


<button

@click="deleteCategory(item.id)"

class="bg-red-600 text-white px-4 py-2 rounded-xl">

Hapus

</button>


</td>



</tr>


</tbody>


</table>


</div>


</div>


</template>