<script setup>
import { RouterLink } from 'vue-router';
import { Button } from 'primevue';
import { useAuthStore } from './../stores/auth';

const authStore = useAuthStore();
const { logout } = authStore;

</script>

<template>
    <nav class="bg-white border-b border-gray-200 fixed top-0 z-50 w-full">
        <div class="container mx-auto flex justify-between items-center h-16">
            <RouterLink to="/" class="font-bold text-2xl">
                ShelterPaws
            </RouterLink>

            <nav class="hidden md:flex items-center justify-center h-full">
                <RouterLink :to="{ name: 'pets' }" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center">Adopt</RouterLink>
                <RouterLink :to="{ name: 'shelters' }" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center">Shelters</RouterLink>
                <RouterLink :to="{ name: 'about' }" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center">About</RouterLink>
                
                <div v-if="authStore.user && authStore.user.role === 'user'">
                    <RouterLink :to="{ name: 'adoption-status' }" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center">Adoption Application Status</RouterLink>
                </div>

                <div v-if="authStore.user && authStore.user.role === 'shelter'" class="md:flex items-center justify-center">
                    <RouterLink :to="{ name: 'pet-management' }" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center">Listing Management</RouterLink>
                    <RouterLink :to="{ name: 'shelter-application' }" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center">Adoption Applications</RouterLink>
                </div>
            </nav>

            <nav v-if="!authStore.user" class="hidden md:flex items-center justify-center h-full space-x-3">
                <Button label="Login" as="router-link" :to="{ name: 'signin' }" severity="secondary" />
                <Button label="Sign Up" as="router-link" :to="{ name: 'signup' }"/>
            </nav>

            <form v-if="authStore.user" @submit.prevent="logout">
                <Button type="submit" icon="pi pi-sign-out" label="Logout" variant="text" :loading="authStore.isFormLoading" />
            </form>

            <Button unstyled pt:root="md:hidden" icon="pi pi-bars" severity="secondary" variant="text" />
        </div>
    </nav>
</template>