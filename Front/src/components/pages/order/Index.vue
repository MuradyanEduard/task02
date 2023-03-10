<script setup>
import { ref } from 'vue'

const user = JSON.parse(localStorage.getItem('user'))
const orders = ref([])

getOrders()

async function getOrders() {
    const response = await fetch('http://127.0.0.1:8000/api/order', {
        method: 'GET',
        headers: {
            "Authorization": 'Bearer ' + user.api_token,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify()
    })

    const respData = await response.json()

    if (response.ok) {
        orders.value = respData.orders
    }
}



</script>


<template>
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <!--main-->
        <div class="p-10">

            <div v-for="order in orders.data" class="m-auto mb-10 w-[50%]">
                <h5 class="mb-2 text-xl font-bold dark:text-white">Author: <span class="ml-2">
                        {{ order.author.name }}</span></h5>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                        <th scope="col" class="px-6 py-3">
                            Count
                        </th>
                        <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="book in order.books" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ book.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ order.orders_books.count }}
                            </td>
                            <td class="px-6 py-4">
                                {{ book.price }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="mt-2 text-right text-xl font-bold dark:text-white">Total Price: <span class="ml-2">
                        {{ order.price }}</span></h5>

            </div>
        </div>

        <!-- <div class="w-full h-[80px] m-auto mt-3 mb-3 flex justify-center">
                <div class="pagination-block">
                    <Pagination :links="orders.links" />
                </div>
            </div> -->
    </div>
</template>

