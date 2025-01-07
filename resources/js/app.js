import './bootstrap';

import { createApp, markRaw } from 'vue';
import { createPinia } from 'pinia';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import Aura from '@primevue/themes/aura';
import App from './App.vue';
import router from './router';
import { useToast } from 'primevue/usetoast';
import DialogService from 'primevue/dialogservice';
import { definePreset } from '@primevue/themes';

const pinia = createPinia();
const app = createApp(App);

pinia.use(({store}) => {
    const toast = useToast();
    
    store.router = markRaw(router);
    store.toast = markRaw(toast)
});

app.use(pinia);
app.use(router);
app.use(ToastService);
app.use(DialogService);

const MyPreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: '{teal.50}',
            100: '{teal.100}',
            200: '{teal.200}',
            300: '{teal.300}',
            400: '{teal.400}',
            500: '{teal.500}',
            600: '{teal.600}',
            700: '{teal.700}',
            800: '{teal.800}',
            900: '{teal.900}',
            950: '{teal.950}'
        }
    }
});

app.use(PrimeVue, {
    theme: {
        preset: MyPreset
    },
    pt: {
        Column: {
            columnTitle: 'text-gray-800 font-medium text-[1rem]',
            bodyCell: 'text-gray-700 font-normal text-[1rem]'
        },
        Select: {
            label: 'text-[1rem]'
        },
        Paginator: {
            content: 'text-[1rem]'
        }
    }
});

app.mount('#app');