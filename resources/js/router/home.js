import DefaultLayout from '../layouts/DefaultLayout.vue';
import HomeView from '../views/HomeView.vue';

export default [
    {
        path: '/',
        name: 'home',
        component: HomeView,
        meta: { 
            layout: DefaultLayout,
            auth: true
        },
    },
]