<script setup>
import { Button } from 'primevue';
</script>

<template>
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 md:pr-8 mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Find Your Perfect Furry Companion</h1>

                    <p class="text-xl mb-8 text-gray-600">Connect with local shelters and give a loving home to pets in need.</p>

                    <div class="space-x-4">
                        <Button as="router-link" label="Start Adopting" :to="{ name: 'signin' }" />
                        <Button as="router-link" label="Register Your Shelter" :to="{ name: 'shelter-register' }" severity="secondary" />
                    </div>
                </div>

                <div class="md:w-1/2">
                    <img :src="'/assets/imgs/hero_img.jpg'" class="rounded-lg shadow-lg min-w-[400px] min-h-[200px]" alt="Happy pets and owners" />
                </div>
            </div>
        </div>
    </section>
</template>