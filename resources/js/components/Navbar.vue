<script setup>
import { RouterLink } from 'vue-router';
import { Button } from 'primevue';
</script>

<template>
    <nav class="bg-white border-b border-gray-200 fixed top-0 z-50 w-full">
        <div class="container mx-auto flex justify-between items-center h-16">
            <RouterLink to="/" class="font-bold text-2xl">
                ShelterPaws
            </RouterLink>

            <nav class="hidden md:flex items-center justify-center h-full">
                <RouterLink to="/" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center text-lg">Adopt</RouterLink>
                <RouterLink to="/" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center text-lg">Shelters</RouterLink>
                <RouterLink :to="{ name: 'about' }" class="hover:text-teal-500 hover:font-semibold text-gray-600 h-full px-2 flex items-center text-lg">About</RouterLink>
            </nav>

            <nav class="hidden md:flex items-center justify-center h-full space-x-3">
                <Button label="Login" as="router-link" :to="{ name: 'signin' }" variant="outlined" />
                <Button label="Sign Up" as="router-link" :to="{ name: 'signup' }"/>
            </nav>

            <Button unstyled pt:root="md:hidden" icon="pi pi-bars" severity="secondary" variant="text" />
        </div>
    </nav>
</template>