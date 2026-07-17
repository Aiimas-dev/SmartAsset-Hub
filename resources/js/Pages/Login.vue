<script setup>

import { ref } from 'vue'
import axios from 'axios'
import { router } from '@inertiajs/vue3'


const email = ref('')
const password = ref('')

const error = ref('')


const login = async()=>{


    try{


        const response = await axios.post(
            '/api/login',
            {
                email: email.value,
                password: password.value
            }
        )



        localStorage.setItem(
            'token',
            response.data.token
        )



        router.visit('/dashboard')



    }catch(e){


        error.value =
        'Email atau password salah'


    }


}


</script>



<template>


<div class="min-h-screen bg-slate-100 flex items-center justify-center">


    <div class="bg-white shadow-xl rounded-3xl p-10 w-full max-w-md">


        <h1 class="text-3xl font-bold text-slate-800 text-center">

            Smart Hub Management System

        </h1>



        <p class="text-gray-500 text-center mt-2">

            Login Administrator

        </p>




        <div 
        v-if="error"
        class="bg-red-100 text-red-600 p-3 rounded-lg mt-5">

            {{error}}

        </div>




        <form 
        @submit.prevent="login"
        class="mt-6 space-y-5">



            <div>

                <label>
                    Email
                </label>

                <input
                v-model="email"
                type="email"
                class="w-full border rounded-xl px-4 py-3"
                >

            </div>




            <div>

                <label>
                    Password
                </label>


                <input
                v-model="password"
                type="password"
                class="w-full border rounded-xl px-4 py-3"
                >

            </div>





            <button
            class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700">


                Login


            </button>



        </form>


    </div>


</div>


</template>