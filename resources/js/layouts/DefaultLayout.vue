<script setup>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/HomeViewComponents/Footer.vue';
</script>

<template>
    <div class="min-h-screen min-w-screen h-screen text-gray-700">
        <Navbar />
        
        <main class="pt-16">
            <slot />
        </main>

        <Footer />
    </div>
</template>