<script setup>
import { ref, reactive } from 'vue'
import Multiselect from '@vueform/multiselect'
import router from '../../../router'

components: [Multiselect]

const selectedOption = ref([])

const author = reactive({
    name: "",
    books: {}
})

const errors = ref({
    name: "",
    books: ""
})

const user = JSON.parse(localStorage.getItem('user'))
const message = ref()

getBooks()

async function getBooks() {
    const response = await fetch('http://127.0.0.1:8000/api/book/get', {
        method: 'GET',
        headers: {
            "Authorization": 'Bearer ' + user.api_token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify()
    })

    const respData = await response.json()

    if (response.ok) {
        respData.books.map(b => { author.books[b.id] = b.title })
    } else {
        router.push({ path: '/author' })
    }
}

async function createAuthor() {
    message.value = []

    const response = await fetch('http://127.0.0.1:8000/api/author/store', {
        method: 'POST',
        headers: {
            "Authorization": 'Bearer ' + user.api_token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: author.name,
            books: Array(...selectedOption.value)
        })
    })

    const respData = await response.json()

    if (response.ok) {
        message.value = respData.messages;
        errors.value = []
    } else {
        message.value = null
        errors.value = respData.errors;
    }

}

</script>

<template>
    <div class="m-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div v-if="message"
            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="block sm:inline">
                <div class="col-12">
                    <div class="alert alert-danger" v-html="message"></div>
                </div>
            </span>
        </div>
        <a href="#">
            <img class="rounded-t-lg" src="/images/author.jpeg" alt="" />
        </a>
        <div class="p-5">
            <form @submit.prevent="createAuthor">
                <div class="mb-3">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author
                        Name</label>
                    <input type="text" id="name" name="name" v-model="author.name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John">
                </div>

                <div v-if="errors.name"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <span class="block sm:inline">
                        <div class="col-12">
                            <div class="alert alert-danger" v-html="errors.name"> </div>
                        </div>
                    </span>
                </div>

                <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Books:</h2>

                <Multiselect v-model="selectedOption" mode="tags" :close-on-select="false" :searchable="true"
                    :create-option="true" :options="author.books" />

                <div v-if="errors.books"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <span class="block sm:inline">
                        <div class="col-12">
                            <div class="alert alert-danger" v-html="errors.books"> </div>
                        </div>
                    </span>
                </div>
                <button type="submit"
                    class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Create
                    <i class="fa fa-plus w-4 h-4 ml-2 -mr-1"></i>
                    <input type="submit" value=" ">
                </button>
            </form>

        </div>
    </div>
</template>


