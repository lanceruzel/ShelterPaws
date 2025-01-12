import DefaultLayout from '../layouts/DefaultLayout.vue';
import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';
import PrivacyPolicyView from '../views/PrivacyPolicyView.vue';
import TermsOfServiceView from '../views/TermsOfServiceView.vue';
import FAQView from '../views/FAQView.vue';
import PetView from '../views/PetView.vue';
import PetsView from '../views/PetsView.vue';
import ShelterView from '../views/ShelterView.vue';
import SheltersView from '../views/SheltersView.vue';
import AdoptionStatusView from '../views/AdoptionStatusView.vue';
import PetManagementView from '../views/PetManagementView.vue';

export default [
    {
        path: '/',
        name: 'home',
        component: HomeView,
        meta: { 
            layout: DefaultLayout,
        },
    },
    {
        path: '/about',
        name: 'about',
        component: AboutView,
        meta: { 
            layout: DefaultLayout,
        },
    },
    {
        path: '/privacy',
        name: 'privacy',
        component: PrivacyPolicyView,
        meta: { 
            layout: DefaultLayout,
        },
    },
    {
        path: '/terms',
        name: 'terms',
        component: TermsOfServiceView,
        meta: { 
            layout: DefaultLayout,
        },
    },
    {
        path: '/faq',
        name: 'faq',
        component: FAQView,
        meta: { 
            layout: DefaultLayout,
        },
    },
    {
        path: '/pets',
        name: 'pets',
        component: PetsView,
        meta: { 
            layout: DefaultLayout,
        },
    },
    {
        path: '/pet/:id',
        name: 'pet-view',
        component: PetView,
        meta: { 
            layout: DefaultLayout,
        },
    },
    {
        path: '/shelters',
        name: 'shelters',
        component: SheltersView,
        meta: { 
            layout: DefaultLayout,
        },
    },
    {
        path: '/shelter/:id',
        name: 'shelter-view',
        component: ShelterView,
        meta: { 
            layout: DefaultLayout,
            auth: true
        },
    },
    {
        path: '/adopt/status',
        name: 'adoption-status',
        component: AdoptionStatusView,
        meta: { 
            layout: DefaultLayout,
            auth: true
        },
    },
    {
        path: '/shelters/pet/manage',
        name: 'pet-management',
        component: PetManagementView,
        meta: { 
            layout: DefaultLayout,
            auth: true
        },
    },
]