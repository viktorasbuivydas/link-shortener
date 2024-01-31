<template>
  <div class="container max-w-2xl">
    <div class="flex flex-col my-10 space-y-2">
      <h1 class="text-3xl font-bold">
        Shorten link
      </h1>
      <Success v-if="link" class="text-center">
        Shortened url: <a :href="link.short_url" target="_blank" class="font-bold">{{ link.short_url }}</a>
      </Success>
      <Error v-if="error" class="text-center">
        There was an error shortening the link.
      </Error>
      <form class="flex space-x-2 items-center" @submit.prevent="shortenLink">
        <div>
          Link:
        </div>
        <input v-model="form.url" type="text" class="border border-gray-300 rounded-md p-2 grow"/>
        <div v-if="form.errors.url">{{ form.errors.url }}</div>
      </form>
      <button @click="shortenLink"
              :disabled="form.processing"
              class="flex justify-center items-center bg-blue-500 text-white rounded-md p-2">
        <Loader v-if="loading"/>
        Shorten link
      </button>
    </div>
  </div>
</template>

<script setup>
import {computed, ref} from 'vue'
import {useForm} from "@inertiajs/vue3";
import Loader from "../../Components/Loader.vue";
import Success from "../../Components/Success.vue";
import Error from "../../Components/Error.vue";

const loading = ref(false);
const error = ref(false);
const link = ref(null);

const form = useForm({
  url: ''
});

const shortenLink = () => {
  if (form.url === '') {
    return
  }

  loading.value = true

  fetch('/api/links/create', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      url: form.url
    })
  })
      .then((res) => {
        return res.json()
      })
      .then((data) => {
        link.value = data.data
        form.reset()
      })
      .catch((err) => {
        error.value = true
      })
      .finally(() => {
        loading.value = false
      })
}

const showSuccess = computed(() => {
  return success.value
})
</script>
