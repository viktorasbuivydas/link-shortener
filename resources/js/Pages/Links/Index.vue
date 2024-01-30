<template>
    <div class="container max-w-2xl">
        <div class="flex flex-col my-10 space-y-2">
            <h1 class="text-3xl font-bold">
                Shorten link
            </h1>
            <form class="flex space-x-2 items-center" @submit.prevent="shortenLink">
                <div>
                    Link:
                </div>
                <input v-model="url" type="text" class="border border-gray-300 rounded-md p-2 grow" />
            </form>
            <button @click="shortenLink" class="bg-blue-500 text-white rounded-md p-2">
                Shorten link
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import {useForm} from "@inertiajs/vue3";

const success = ref(false)
const form = useForm({
    url: ''
})

const shortenLink = () => {
    form.post(route('links.store'))
        .then((res) => {
            success.value = true
        })
        .catch((err) => {
            console.log(err)
        })
}
</script>
