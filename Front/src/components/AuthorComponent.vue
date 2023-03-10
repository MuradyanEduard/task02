<script setup>

defineProps({
    author: {
        type: Object,
        default: {},
    },
    ediatable: {
        type: Boolean,
        default: false,
    },
    showable: {
        type: Boolean,
        default: false,
    },
    imgurl: {
        type: String,
        default: 'images/book.jpg',
    }
})


</script>

<template>
    <div class="m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="rounded-t-lg" src='/images/author.jpeg' alt="" />
        </a>
        <div class="p-5">
            <div class="flex">
                <div>
                    <h5 class="text-2xl mt-1 font-bold tracking-tight text-gray-900 dark:text-white">Author:
                        {{ author.name }}
                    </h5>
                </div>
                <div class="ml-5">
                    <router-link v-if="showable" :to="`/author/show/${author.id}`"
                        class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Show
                        <i class="fa fa-eye w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
                    </router-link>
                </div>
            </div>

            <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Books:</h2>

            <ol class="mb-3 max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                <li v-for="book in author.books">
                    <span class="font-semibold text-gray-900 dark:text-white">{{ book.title }} </span>
                </li>
            </ol>

            <router-link v-if="ediatable" :to="`/author/edit/${author.id}`"
                class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Edit
                <i class="fa fa-edit w-4 h-4 ml-2 -mr-1"></i>
            </router-link>

            <router-link v-if="ediatable" :to="`/author/show/${author.id}`" onclick="return confirm('Are you sure?')"
                method="DELETE"
                class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Remove
                <i class="fa fa-trash w-4 h-4 ml-2 -mr-1"></i>
            </router-link>
        </div>
    </div>
</template>

