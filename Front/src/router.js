import { createRouter, createWebHistory } from 'vue-router'
import Login from './components/pages/auth/Login.vue'
import Register from './components/pages/auth/Register.vue'
import BookIndex from './components/pages/book/Index.vue'
import BookCreate from './components/pages/book/Create.vue'
import BookShow from './components/pages/book/Show.vue'
import BookEdit from './components/pages/book/Edit.vue'

import AuthorIndex from './components/pages/author/Index.vue'
import AuthorCreate from './components/pages/author/Create.vue'
import AuthorShow from './components/pages/author/Show.vue'
import AuthorEdit from './components/pages/author/Edit.vue'

import OrderIndex from './components/pages/order/Index.vue'
import OrderConfirm from './components/pages/order/Confirm.vue'

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
    {
        path: '/book/show/:pathMatch(.*)*',
        component: BookShow,
        meta: { requiresAuth: true },
    },
    {
        path: '/book/edit/:pathMatch(.*)*',
        component: BookEdit,
        meta: { requiresAuth: true },
    },
    {
        path: '/author',
        component: AuthorIndex,
        meta: { requiresAuth: true },
    },
    {
        path: '/author/create',
        component: AuthorCreate,
        meta: { requiresAuth: true },
    },
    {
        path: '/author/show/:pathMatch(.*)*',
        component: AuthorShow,
        meta: { requiresAuth: true },
    },
    {
        path: '/author/edit/:pathMatch(.*)*',
        component: AuthorEdit,
        meta: { requiresAuth: true },
    },
    {
        path: '/order',
        component: OrderIndex,
        meta: { requiresAuth: true },
    },
    {
        path: '/order/confirm',
        component: OrderConfirm,
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