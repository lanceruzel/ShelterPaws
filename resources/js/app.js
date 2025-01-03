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
            50: '{amber.50}',
            100: '{amber.100}',
            200: '{amber.200}',
            300: '{amber.300}',
            400: '{amber.400}',
            500: '{amber.500}',
            600: '{amber.600}',
            700: '{amber.700}',
            800: '{amber.800}',
            900: '{amber.900}',
            950: '{amber.950}'
        }
    }
});

app.use(PrimeVue, {
    theme: {
        preset: MyPreset
    },
});

app.mount('#app');