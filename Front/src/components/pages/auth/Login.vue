<script setup>
import { ref, reactive } from 'vue';

const data = reactive({
    email: "",
    password: "",
})

const errors = ref({
    email: "",
    password: "",
})

const user = ref()

async function loginUser() {
    const response = await fetch('http://127.0.0.1:8000/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            "email": data.email,
            "password": data.password,
        })
    })

    const respData = await response.json()

    if (response.ok) {
        console.log(respData)
        localStorage.setItem('user', JSON.stringify(respData.user))
        // router.push('/book');
        window.location.href = '/book';
        errors.value = []
    } else {
        errors.value = respData.errors;
        console.log(errors.value.email)
    }
}

</script>

<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                        Sign in
                    </h1>
                    <form @submit.prevent="loginUser">
                        <div class="mt-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                email</label>
                            <input type="email" name="email" id="email" v-model="data.email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com">

                            <div v-if="errors.email"
                                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                                role="alert">
                                <span class="block sm:inline">
                                    <div class="col-12">
                                        <div class="alert alert-danger" v-html="errors.email"></div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="????????????????????????"
                                v-model="data.password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div v-if="errors.password"
                                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                                role="alert">
                                <span class="block sm:inline">
                                    <div class="col-12">
                                        <div class="alert alert-danger" v-html="errors.password"> </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                                password?</a>
                        </div>
                        <button type="submit"
                            class="mt-3 w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign
                            in</button>
                        <p class="mt-3 text-sm text-center font-light text-gray-500 dark:text-gray-400">
                            Don???t have an account yet? <a href="/register"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

