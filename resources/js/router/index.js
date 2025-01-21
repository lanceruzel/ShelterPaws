import { createRouter, createWebHistory } from 'vue-router';
import NotFoundView from '../views/NotFoundView.vue';
import DefaultLayout from '../layouts/DefaultLayout.vue';
import authRoutes from './auth';
import homeRoutes from './home';
import { useAuthStore } from './../stores/auth';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    linkExactActiveClass: 'active',
    routes: [
        ...homeRoutes,
        ...authRoutes,
        {
            path: '/:catchAll(.*)',
            name: 'not-found',
            component: NotFoundView,
            meta: { layout: DefaultLayout },
        },
    ]
});

router.beforeEach(async (to, from) => {
    const authStore = useAuthStore();
    await authStore.getUser();

    if(authStore.user && to.meta.guest){
        return { name: 'home' }
    }

    if(!authStore.user && to.meta.auth){
        return { name: 'signin' }
    }
});

export default router;