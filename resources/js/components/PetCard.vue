<script setup>
import { Card, Button } from 'primevue';
import Image from 'primevue/image';

defineProps({
    pets: Object
});
</script>

<template>
<Card class="overflow-hidden" v-for="pet in pets" :key="pet.id">
    <template #header>
        <div class="overflow-hidden relative h-72 md:h-80 flex items-center justify-center border-b">
            <Image class="object-cover w-full" preview :src="'/storage/' + pet.images[0]"  :alt="pet.name" />
        </div>
    </template>

    <template #title>
        <span class="font-bold" v-text="pet.name"></span>
    </template>

    <template #subtitle>
        <span v-text="pet.breed"></span>
    </template>

    <template #footer>
        <Button as="router-link" icon="pi pi-heart" label="Adopt Me" :to="{ name: 'pet-view', params: { id: pet.id } }" fluid />
    </template>
</Card>
</template>