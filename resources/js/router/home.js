import DefaultLayout from '../layouts/DefaultLayout.vue';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';

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
    {
        path: '/about',
        name: 'about',
        component: AboutView,
        meta: { 
            layout: DefaultLayout,
            auth: true
        },
    },
]