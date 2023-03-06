import { createApp } from 'vue'
import App from './App.vue'
import '@themesberg/flowbite';

// import './assets/main.css'
import router from './router'



createApp(App).use(router).mount('#app')
