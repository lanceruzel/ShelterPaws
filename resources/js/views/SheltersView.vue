<script setup>
import { Card, InputText, FloatLabel, Select, Button, Badge } from 'primevue';
import { reactive } from 'vue';
import Image from 'primevue/image';

const formData = reactive({
    search: '',
    city: null,
});

const cities = [
    { name: 'Bataan', value: 'bataan' },
    { name: 'Manila', value: 'manila' },
    { name: 'Quezon City', value: 'quezon_city' },
    { name: 'Cebu City', value: 'cebu_city' },
    { name: 'Davao City', value: 'davao_city' },
    { name: 'Baguio', value: 'baguio' },
    { name: 'Zamboanga City', value: 'zamboanga_city' },
    { name: 'Iloilo City', value: 'iloilo_city' },
    { name: 'Pasay', value: 'pasay' },
    { name: 'Makati', value: 'makati' },
    { name: 'Taguig', value: 'taguig' },
    { name: 'Pasig', value: 'pasig' },
    { name: 'Cagayan de Oro', value: 'cagayan_de_oro' },
    { name: 'Parañaque', value: 'paranaque' },
    { name: 'Las Piñas', value: 'las_pinas' },
    { name: 'Mandaluyong', value: 'mandaluyong' },
    { name: 'Marikina', value: 'marikina' },
    { name: 'Valenzuela', value: 'valenzuela' },
    { name: 'Antipolo', value: 'antipolo' },
    { name: 'San Fernando', value: 'san_fernando' },
    { name: 'Lipa', value: 'lipa' },
    { name: 'Batangas City', value: 'batangas_city' },
    { name: 'Calamba', value: 'calamba' },
    { name: 'General Santos', value: 'general_santos' },
    { name: 'Bacolod', value: 'bacolod' },
    { name: 'Tacloban', value: 'tacloban' }
];

const shelters = [
  { 
    id: 1, 
    name: "Happy Tails Rescue", 
    location: "New York, NY", 
    image: "https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80",
    phone: "(123) 456-7890",
    email: "info@happytails.org",
    availablePets: 15,
    specialties: ["Dogs", "Cats", "Small Animals"],
    description: "Happy Tails Rescue is dedicated to finding loving homes for all animals, big and small. We specialize in rehabilitating and rehoming pets with special needs."
  },
  { 
    id: 2, 
    name: "Paws and Claws Shelter", 
    location: "Los Angeles, CA", 
    image: "https://images.unsplash.com/photo-1548767797-d8c844163c4c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80",
    phone: "(987) 654-3210",
    email: "adopt@pawsandclaws.org",
    availablePets: 23,
    specialties: ["Cats", "Senior Pets"],
    description: "Paws and Claws Shelter focuses on providing a safe haven for cats and senior pets. We believe every animal deserves a loving home, regardless of age."
  },
  { 
    id: 3, 
    name: "Furry Friends Foundation", 
    location: "Chicago, IL", 
    image: "https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80",
    phone: "(555) 123-4567",
    email: "hello@furryfriends.org",
    availablePets: 18,
    specialties: ["Dogs", "Puppies", "Training"],
    description: "Furry Friends Foundation specializes in rescuing and training dogs of all ages. We offer post-adoption support and training classes for new pet parents."
  },
  { 
    id: 4, 
    name: "Second Chance Animal Rescue", 
    location: "Houston, TX", 
    image: "https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80",
    phone: "(832) 555-1234",
    email: "rescue@secondchance.org",
    availablePets: 30,
    specialties: ["All Animals", "Wildlife Rehabilitation"],
    description: "Second Chance Animal Rescue is committed to saving animals of all kinds, including wildlife. We work closely with local authorities to rescue and rehabilitate injured wildlife."
  },
]
</script>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Partner Shelters</h1>

            <!-- Search and Filter -->
            <Card>
                <template #title>
                    <span class="font-bold">Search and Filter</span>
                </template>

                <template #content>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <InputText class="flex-grow" type="text" v-model="formData.search" placeholder="Search shelters by name or location" fluid />

                        <FloatLabel class="w-full sm:w-[180px]" variant="on">
                            <Select class="w-full" 
                                v-model="formData.city" 
                                :options="cities" 
                                optionLabel="name" 
                                optionValue="value"
                                checkmark :highlightOnSelect="false"
                            />

                            <label>City</label>
                        </FloatLabel>

                        <Button label="Search" :pt="{ root: '!px-10' }" />
                    </div>
                </template>
            </Card>

            <div class="grid md:grid-cols-2 gap-8 mt-10">
                <Card class="overflow-hidden" v-for="shelter in shelters" :key="shelter.id">
                    <template #header>
                        <div class="overflow-hidden relative h-72 md:h-80 flex items-center justify-center border-b">
                            <Image class="object-cover w-full" preview :src="shelter.image" :alt="shelter.name" />
                        </div>
                    </template>

                    <template #title>
                        <div class="flex items-center justify-between">
                            <span class="font-bold" v-text="shelter.name"></span>

                            <Badge severity="secondary">
                                <div class="text-xs space-x-1 font-bold">
                                    <span v-text="shelter.availablePets"></span>
                                    <span>Pets</span>
                                </div>
                            </Badge>
                        </div>
                    </template>

                    <template #content>
                        <div class="text-gray-600">
                            <p class="line-clamp-2 mb-4" v-text="shelter.description"></p>

                            <div class="grid gri-cols-2 gap-4 mb-4">
                                <div class="flex items-center space-x-2">
                                    <i class="pi pi-map-marker"></i>
                                    <span v-text="shelter.location"></span>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <i class="pi pi-phone"></i>
                                    <span v-text="shelter.phone"></span>
                                </div>

                                <div class="flex items-center space-x-2 col-span-2">
                                    <i class="pi pi-envelope"></i>
                                    <span v-text="shelter.email"></span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 className="font-semibold mb-2 flex items-center">
                                    Specialize
                                </h4>
                                
                                <div class="flex items-center justify-start gap-2 flex-wrap">
                                    <Badge severity="secondary" v-for="specialty in shelter.specialties" :value="specialty" />
                                </div>
                            </div>
                        </div>
                    </template>

                    <template #footer>
                        <Button as="router-link" label="View Shelter" :to="{ name: 'shelter-view', params: { id: shelter.id } }" fluid />
                    </template>
                </Card>
            </div>
        </div>
    </div>
</template>