<script setup>
import { Card, Button } from 'primevue';

const pet = {
    id: 1,
    name: "Max",
    species: "Dog",
    breed: "Golden Retriever",
    age: 3,
    gender: "Male",
    size: "Large",
    color: "Golden",
    description: "Max is a friendly and energetic Golden Retriever who loves to play fetch and go for long walks. He's great with children and other dogs, making him a perfect family pet. Max is house-trained and knows basic commands like sit, stay, and come. He's great with children and other dogs, making him a perfect family pet. Max is house-trained and knows basic commands like sit, stay, and come.",
    image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80",
    shelter: "Happy Tails Rescue",
    shelterLocation: "New York, NY"
}
</script>

<template>
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 py-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <img :src="pet.image" :alt="pet.name" class="w-full h-80 md:h-full xl:h-[550px] object-cover" />
                    </div>

                    <div class="md:w-1/2 p-6 md:p-10">
                        <h1 className="text-3xl">{{ pet.name }}</h1>

                        <p class="text-xl mb-4">{{ pet.breed }} • {{ pet.age }} years old</p>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="font-semibold">Gender</p>
                                <p>{{ pet.gender }}</p>
                            </div>

                            <div>
                                <p class="font-semibold">Size</p>
                                <p>{{ pet.size }}</p>
                            </div>

                            <div>
                                <p class="font-semibold">Color</p>
                                <p>{{ pet.color }}</p>
                            </div>

                            <div>
                                <p class="font-semibold">Species</p>
                                <p>{{ pet.species }}</p>
                            </div>
                        </div>

                        <p class="mb-6 line-clamp-3">{{ pet.description }}</p>

                        <div class="mb-6">
                            <p class="font-semibold">Shelter</p>
                            <p>{{ pet.shelter }}</p>
                            <p>{{ pet.shelterLocation }}</p>
                        </div>
                        
                        <Button class="mb-4" fluid severity="secondary" label="View Shelter"></Button>

                        <Button fluid>
                            <i class="pi pi-heart"></i>
                            <span>Adopt {{ pet.name }}</span>
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>