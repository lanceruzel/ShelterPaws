import DefaultLAyout from '../layouts/DefaultLayout.vue';
import HomeView from '../views/HomeView.vue';

export default [
    {
        path: '/',
        name: 'home',
        component: HomeView,
        meta: { 
            layout: DefaultLAyout,
            auth: true
        },
    },
]