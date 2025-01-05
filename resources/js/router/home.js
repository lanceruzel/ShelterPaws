import DefaultLayout from '../layouts/DefaultLayout.vue';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';
import PrivacyPolicyView from '../views/PrivacyPolicyView.vue';
import TermsOfServiceView from '../views/TermsOfServiceView.vue';
import FAQView from '../views/FAQView.vue';

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
    {
        path: '/privacy',
        name: 'privacy',
        component: PrivacyPolicyView,
        meta: { 
            layout: DefaultLayout,
            auth: true
        },
    },
    {
        path: '/terms',
        name: 'terms',
        component: TermsOfServiceView,
        meta: { 
            layout: DefaultLayout,
            auth: true
        },
    },
    {
        path: '/faq',
        name: 'faq',
        component: FAQView,
        meta: { 
            layout: DefaultLayout,
            auth: true
        },
    }
]