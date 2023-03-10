<script setup>
import BookComponent from '../../BookComponent.vue';
import { TailwindPagination } from 'laravel-vue-pagination';
import { ref } from 'vue';
import { basket } from '../../../composable/useBasket';

const user = JSON.parse(localStorage.getItem('user'))
const books = ref([])

getBooks()

async function getBooks(page = 1) {
    const response = await fetch(`http://127.0.0.1:8000/api/book?page=${page}`, {
        method: 'GET',
        headers: {
            "Authorization": 'Bearer ' + user.api_token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify()
    })

    const respData = await response.json()

    if (response.ok) {
        books.value = respData.books
    }
}

function removeBasket() {
}

</script>

<template>
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap justify-start">
            <div v-for="book in books.data">
                <BookComponent v-if="user.role == 2" :book="book" :ediatable="false" :showable="true" :showBasket="true" />
                <BookComponent v-else :book="book" :ediatable="true" :showable="true" :showBasket="false" />

            </div>
        </div>

        <div class="w-full h-[80px] m-auto mt-3 mb-3 flex justify-center">
            <div class="pagination-block">
                <TailwindPagination :data="books" @pagination-change-page="getBooks" />
            </div>
        </div>

    </div>



    <div v-if="user.role == 2" id="basket-container">
        <button id="basket-button" type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fa fa-shopping-cart m-auto" aria-hidden="true"></i>
        </button>
        <div id="basket-window">
            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Your Basket:</h2>
            <div v-if="basket">
                <ul v-for="book in basket">
                    <li>
                        <span class="font-semibold text-gray-900 dark:text-white">Book: {{ book['title'] }}</span>
                    </li>
                    <li>
                        <span class="font-semibold text-gray-900 dark:text-white">Count:{{ book['count'] }}</span>
                    </li>
                    <li>
                        <span class="font-semibold text-gray-900 dark:text-white">Price:{{ book['price'] }}</span>
                    </li>

                    <router-link to="/order/remove" :data="{ id: book.id }" preserve-state method="POST"
                        class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Remove <i class="fa fa-trash w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
                    </router-link>
                </ul>
            </div>

            <div class="flex flex-wrap justify-end">
                <router-link to="/order/confirm" method="GET"
                    class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Buy <i class="fa fa-shopping-cart w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
                </router-link>
            </div>
        </div>
    </div>
</template>

<style scope>
#basket-container {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    right: 0px;
    z-index: 999;
}

#basket-button {
    position: absolute;
    transform: translateY(-50%);
    right: 0;
    z-index: 1000;
    transition: right 0.3s ease;
}

#basket-window {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    right: -300px;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 20px;
    width: 300px;
    z-index: 998;
    transition: right 0.3s ease;
    height: 100vh;
    overflow-y: auto;
}

#basket-window h2 {
    margin-top: 0;
}

#basket-window ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

#basket-container:hover #basket-button {
    right: 300px;
}

#basket-container:hover #basket-window {
    right: 0;
}

.buy-button {
    position: fixed;
    bottom: 10px;
    right: 10px;
}
</style>
