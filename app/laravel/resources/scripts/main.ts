import { createApp } from 'vue';
import App from '@/views/App.vue';
import './plugins/Firebase';
import Router from './plugins/Router';
import Store from './plugins/Store';
import PrimeVue from './plugins/PrimeVue';
import ToastService from 'primevue/toastservice'

createApp(App)
    .use(Router)
    .use(Store)
    .use(PrimeVue)
    .use(ToastService)
    .mount('#app');