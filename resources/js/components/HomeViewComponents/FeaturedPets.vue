<script setup>
import { Button, Card } from 'primevue';
import PetCard from '../PetCard.vue';

const featuredPets = [
    { 
        id: 1, 
        name: 'Max', 
        type: 'Dog', 
        breed: 'Golden Retriever', 
        age: '2 years', 
        image: 'https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' 
    },
    { 
        id: 2, 
        name: 'Luna', 
        species: 'Cat', 
        breed: 'Siamese', 
        age: '1 year', 
        image: 'https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' 
    },
    { id: 3, 
        name: 'Buddy', 
        species: 'Dog', 
        breed: 'Labrador', 
        age: '3 years', 
        image: 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' 
    },
]
</script>

<template>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Featured Pets</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <PetCard :pets="featuredPets" />
            </div>

            <div class="text-center mt-12">
                <Button as="router-link" label="View All Available Pets" :to="{ name: 'pets' }" severity="secondary" />
            </div>
        </div>
    </section>
</template>