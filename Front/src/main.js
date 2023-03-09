import { createApp } from 'vue'
import App from './App.vue'
import '@themesberg/flowbite';

import '../src/assets/css/input.css'
import router from './router'

createApp(App).use(router).mount('#app')
