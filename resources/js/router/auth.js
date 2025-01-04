import BlankLayout from '../layouts/BlankLayout.vue';
import SignInView from '../views/SignInView.vue';
import SignUpView from '../views/SignUpView.vue';

export default [
    {
        path: '/signin',
        name: 'signin',
        component: SignInView,
        meta: { 
            layout: BlankLayout,
            auth: false
        },
    },
    {
        path: '/signup',
        name: 'signup',
        component: SignUpView,
        meta: { 
            layout: BlankLayout,
            auth: false
        },
    },
]