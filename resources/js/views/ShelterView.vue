<script setup>
import { Button } from 'primevue';
import PetCard from '../components/PetCard.vue';

const shelter = {
    id: 1,
    name: "Happy Tails Rescue",
    description: "Happy Tails Rescue is dedicated to finding loving homes for dogs and cats in need. We believe every pet deserves a chance at a happy life.",
    location: "123 Pet Street, New York, NY 10001",
    phone: "(123) 456-7890",
    email: "info@happytailsrescue.com",
    image: "https://images.unsplash.com/photo-1548767797-d8c844163c4c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80",
    pets: [
        { id: 1, name: "Max", species: "Dog", breed: "Golden Retriever", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" },
        { id: 2, name: "Luna", species: "Cat", breed: "Siamese", image: "https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" },
        { id: 3, name: "Buddy", species: "Dog", breed: "Labrador", image: "https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" },
    ]
}
</script>

<template>
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 py-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-lg mb-8">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <img :src="shelter.image" :alt="shelter.name" class="w-full h-80 md:h-full xl:h-[400px] object-cover" />
                    </div>

                    <div class="md:w-1/2 p-6 md:p-10">
                        <h1 className="text-3xl mb-6 font-bold">{{ shelter.name }}</h1>

                        <p class="mb-6 line-clamp-3">{{ shelter.description }}</p>

                        <div class="grid gri-cols-2 gap-4 mb-4">
                            <div>
                                <p class="font-semibold text-lg">Location</p>

                                <div class="flex items-center space-x-2">
                                    <i class="pi pi-map-marker"></i>
                                    <span v-text="shelter.location"></span>
                                </div>
                            </div>

                            <div>
                                <p class="font-semibold text-lg">Contact</p>

                                <div class="flex items-center space-x-2">
                                    <i class="pi pi-phone"></i>
                                    <span v-text="shelter.phone"></span>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <p class="font-semibold text-lg">Email</p>

                                <div class="flex items-center space-x-2">
                                    <i class="pi pi-envelope"></i>
                                    <span v-text="shelter.email"></span>
                                </div>
                            </div>
                        </div>
                        
                        <Button>
                            <i class="pi pi-heart"></i>
                            <span>Donate to {{ shelter.name }}</span>
                        </Button>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-bold mb-4">Pets available for Adoption</h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <PetCard :pets="shelter.pets" />
            </div>
        </div>
    </div>
</template>