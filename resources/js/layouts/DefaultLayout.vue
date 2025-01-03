<script setup>
import Navbar from '../components/Navbar.vue';
</script>

<template>
    <div class="min-h-screen min-w-screen h-screen w-screen text-gray-700">
        <Navbar />
        
        <main>
            <slot />
        </main>
    </div>
</template>