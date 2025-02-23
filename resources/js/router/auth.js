import BlankLayout from '../layouts/BlankLayout.vue';
import DefaultLayout from '../layouts/DefaultLayout.vue';
import SignInView from '../views/SignInView.vue';
import SignUpView from '../views/SignUpView.vue';
import ShelterRegisterView from '../views/ShelterRegisterView.vue';

export default [
    {
        path: '/signin',
        name: 'signin',
        component: SignInView,
        meta: { 
            layout: DefaultLayout,
            guest: true
        },
    },
    {
        path: '/shelter/register',
        name: 'shelter-register',
        component: ShelterRegisterView,
        meta: { 
            layout: DefaultLayout,
            guest: true
        },
    },
    {
        path: '/signup',
        name: 'signup',
        component: SignUpView,
        meta: { 
            layout: DefaultLayout,
            guest: true
        },
    },
]