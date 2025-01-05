<script setup>
import { Button, Card } from 'primevue';
import Image from 'primevue/image';

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
                <Card class="overflow-hidden" v-for="pet in featuredPets" :key="pet.id">
                    <template #header>
                        <div class="overflow-hidden relative h-72 md:h-80 flex items-center justify-center border-b">
                            <Image class="object-cover w-full" preview :src="pet.image" :alt="pet.name" />
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
            </div>

            <div class="text-center mt-12">
                <Button as="router-link" label="View All Available Pets" :to="{ name: 'pets' }" variant="outlined" />
            </div>
        </div>
    </section>
</template>