import { createRouter, createWebHistory } from 'vue-router'
import Login from './components/pages/auth/Login.vue'
import Register from './components/pages/auth/Register.vue'
import BookIndex from './components/pages/book/Index.vue'
import BookCreate from './components/pages/book/Create.vue'

const routes = [
    {
        path: '/login',
        component: Login,
        beforeEnter: ((to, from, next) => beforeEnter(to, from, next))
    },
    {
        path: '/register',
        component: Register,
        beforeEnter: ((to, from, next) => beforeEnter(to, from, next))
    },
    {
        path: '/book',
        component: BookIndex,
        meta: { requiresAuth: true },
    },
    {
        path: '/book/create',
        component: BookCreate,
        meta: { requiresAuth: true },
    },

    // {
    //     path: '/:pathMatch(.*)*',
    //     component: Register
    // }


]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')

    // check if the route requires auth
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // if not logged in, redirect to login page
        if (!loggedIn) {
            next({ path: '/login' })
            return
        }
    }

    next()
})

function beforeEnter(to, from, next) {
    const loggedIn = localStorage.getItem('user')
    if (loggedIn) {
        next({ path: '/book' })
    } else {
        next()
    }
}

export default router;