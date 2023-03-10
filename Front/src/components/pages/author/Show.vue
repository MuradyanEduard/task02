<script setup>
import { ref } from 'vue';
import AuthorComponent from '../../AuthorComponent.vue';

components: { AuthorComponent }

const user = JSON.parse(localStorage.getItem('user'))
const id = window.location.href.split("/").slice(-1)[0];

const author = ref([]);

getAuthor()

async function getAuthor() {
    const response = await fetch('http://127.0.0.1:8000/api/author/show/' + id, {
        method: 'GET',
        headers: {
            "Authorization": 'Bearer ' + user.api_token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify()
    })

    const respData = await response.json()

    if (response.ok) {
        author.value = respData.author
    }
}
</script>

<template>
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap justify-center">
            <AuthorComponent v-if="user.role == 2" :author="author" :ediatable="false" :showable="false" />
            <AuthorComponent v-else :author="author" :ediatable="true" :showable="false" />
        </div>

    </div>
</template>


