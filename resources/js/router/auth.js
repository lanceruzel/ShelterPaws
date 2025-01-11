import BlankLayout from '../layouts/BlankLayout.vue';
import DefaultLayout from '../layouts/DefaultLayout.vue';
import SignInView from '../views/SignInView.vue';
import SignUpView from '../views/SignUpView.vue';

export default [
    {
        path: '/signin',
        name: 'signin',
        component: SignInView,
        meta: { 
            layout: DefaultLayout,
            auth: false
        },
    },
    {
        path: '/signup',
        name: 'signup',
        component: SignUpView,
        meta: { 
            layout: DefaultLayout,
            auth: false
        },
    },
]