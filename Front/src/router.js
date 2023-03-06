import { createRouter, createWebHistory } from 'vue-router'
import Login from './components/pages/auth/Login.vue'
import Register from './components/pages/auth/Register.vue'

const routes = [
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/:pathMatch(.*)*',
        component: Register
    }


]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;