<script setup>
import { ref, reactive } from 'vue'
import Multiselect from '@vueform/multiselect'

components: [Multiselect]

const data = reactive({
    name: "",
    count: 0,
    price: 0,
    aurhors: {}
})

const selectedOption = ref([])

const errors = ref({
    title: "",
    count: "",
    price: "",
    authors: ""
})

const message = ref()

const user = JSON.parse(localStorage.getItem('user'))

getAuthors()

async function getAuthors() {
    const response = await fetch('http://127.0.0.1:8000/api/author/get', {
        method: 'GET',
        headers: {
            "Authorization": 'Bearer ' + user.api_token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify()
    })

    const respData = await response.json()

    if (response.ok) {
        respData.authors.map(x => data.aurhors[x.id] = x.name)

        console.log(data.aurhors)
    } else {
        console.log(...respData.authors)
    }
}

async function createBook() {
    message.value = []

    const response = await fetch('http://127.0.0.1:8000/api/book/store', {
        method: 'POST',
        headers: {
            "Authorization": 'Bearer ' + user.api_token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: data.title,
            count: data.count,
            price: data.price,
            authors: Array(...selectedOption.value)
        })
    })

    const respData = await response.json()

    if (response.ok) {
        console.log(respData)
        message.value = respData.messages;
        errors.value = []
    } else {
        errors.value = respData.errors;
        console.log(errors.value)
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

        <img class="rounded-t-lg" src="/images/book.jpg" alt="" />

        <div class="p-5">
            <form @submit.prevent="createBook">
                <div class="mb-3">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                        Title</label>
                    <input type="text" id="title" name="title" v-model="data.title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John's book">
                </div>

                <div v-if="errors.title"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <span class="block sm:inline">
                        <div class="col-12">
                            <div class="alert alert-danger" v-html="errors.title[0]"> </div>
                        </div>
                    </span>
                </div>

                <div class="mb-3">
                    <label for="count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                        Count</label>
                    <input type="number" id="count" name="count" v-model="data.count"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="10">
                </div>

                <div v-if="errors.count"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <span class="block sm:inline">
                        <div class="col-12">
                            <div class="alert alert-danger" v-html="errors.count[0]"> </div>
                        </div>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="decimal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                        Price</label>
                    <input type="number" id="price" name="price" v-model="data.price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="10.000">
                </div>

                <div v-if="errors.price"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                    <span class="block sm:inline">
                        <div class="col-12">
                            <div class="alert alert-danger" v-html="errors.price[0]"> </div>
                        </div>
                    </span>
                </div>
                <div v-if="user.role == 0">
                    <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Authors:</h2>
                    <div>
                        <Multiselect v-model="selectedOption" mode="tags" :close-on-select="false" :searchable="true"
                            :create-option="true" :options="data.aurhors" />
                    </div>

                    <div v-if="errors.authors"
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative" role="alert">
                        <span class="block sm:inline">
                            <div class="col-12">
                                <div class="alert alert-danger" v-html="errors.authors[0]"> </div>
                            </div>
                        </span>
                    </div>
                </div>
                <button type="submit"
                    class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Create
                    <i class="fa fa-plus w-4 h-4 ml-2 -mr-1"></i>
                </button>
            </form>

        </div>
    </div>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>

<style scope>
.multiselect input {
    display: none;
}

.multiselect .multiselect-tag {
    background-color: rgb(26 86 219);
}
</style>