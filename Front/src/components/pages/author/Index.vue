<script setup>

import AuthorComponent from '../../AuthorComponent.vue';
import { TailwindPagination } from 'laravel-vue-pagination';
import { ref } from 'vue';

components: { AuthorComponent, TailwindPagination }

const user = JSON.parse(localStorage.getItem('user'))
const authors = ref([])

getAuthors()

async function getAuthors(page = 1) {
    const response = await fetch(`http://127.0.0.1:8000/api/author?page=${page}`, {
        method: 'GET',
        headers: {
            "Authorization": 'Bearer ' + user.api_token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify()
    })

    const respData = await response.json()

    if (response.ok) {
        authors.value = respData.authors

    }
}


</script>

<template>
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap justify-start">
            <div v-for="author in authors.data">
                <AuthorComponent v-if="user.role == 2" :author="author" :ediatable="false" :showable="true"
                    :basketAdable="true" />
                <AuthorComponent v-else :author="author" :ediatable="true" :showable="true" />
            </div>
        </div>


        <div class="w-full h-[80px] m-auto mt-3 mb-3 flex justify-center">
            <div class="pagination-block">
                <TailwindPagination :data="authors" @pagination-change-page="getAuthors" />
            </div>
        </div>

    </div>
</template>

