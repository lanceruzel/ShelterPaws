<script setup>
import { Card, InputText, Select, FloatLabel, Button } from 'primevue';
import Image from 'primevue/image';
import { reactive, computed } from 'vue';

const formData = reactive({
    search: '',
    type: null,
    breed: null,
});

const petType = reactive([
    { type: 'Dog', value: 'dog' },
    { type: 'Cat', value: 'cat' },
]);

const dogBreeds = reactive([
    { breed: 'Golden Retriever', value: 'golden-retriever' },
    { breed: 'Labrador', value: 'labrador' },
    { breed: 'Beagle', value: 'beagle' },
    { breed: 'Other', value: 'other' },
]);

const catBreeds = reactive([
    { breed: 'Siamese', value: 'siamese' },
    { breed: 'Persian', value: 'persian' },
    { breed: 'Maine Coon', value: 'maine-coon' },
    { breed: 'Other', value: 'other' },
]);

const pets = [
  { id: 1, name: 'Max', species: 'Dog', breed: 'Golden Retriever', age: 2, image: 'https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
  { id: 2, name: 'Luna', species: 'Cat', breed: 'Siamese', age: 1, image: 'https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
  { id: 3, name: 'Buddy', species: 'Dog', breed: 'Labrador', age: 3, image: 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
  { id: 4, name: 'Bella', species: 'Cat', breed: 'Persian', age: 4, image: 'https://images.unsplash.com/photo-1513245543132-31f507417b26?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
  { id: 5, name: 'Charlie', species: 'Dog', breed: 'Beagle', age: 2, image: 'https://images.unsplash.com/photo-1537151625747-768eb6cf92b2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
  { id: 6, name: 'Lucy', species: 'Cat', breed: 'Maine Coon', age: 3, image: 'https://images.unsplash.com/photo-1533743983669-94fa5c4338ec?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
];

const filteredBreeds = computed(() => {
  if (formData.type === 'dog') {
    return dogBreeds;
  } else if (formData.type === 'cat') {
    return catBreeds;
  } else {
    return [];
  }

  formData.breed = null;
});
</script>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Find Your Perfect Companion</h1>

            <!-- Search and Filter -->
            <Card>
                <template #title>
                    <span class="font-bold">Search and Filter</span>
                </template>

                <template #content>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <InputText class="flex-grow" type="text" v-model="formData.search" placeholder="Search pet name or breed..." fluid />

                        <FloatLabel class="w-full sm:w-[180px]" variant="on">
                            <Select class="w-full" 
                                v-model="formData.type" 
                                :options="petType" 
                                optionLabel="type" 
                                optionValue="value"
                                checkmark :highlightOnSelect="false"
                            />

                            <label>Type</label>
                        </FloatLabel>

                        <FloatLabel v-if="formData.type" class="w-full sm:w-[180px]" variant="on">
                            <Select class="w-full" 
                                v-model="formData.breed" 
                                :options="filteredBreeds" 
                                optionLabel="breed" 
                                optionValue="value"
                                checkmark :highlightOnSelect="false"
                            />

                            <label>Breed</label>
                        </FloatLabel>

                        <Button label="Search" :pt="{ root: '!px-10' }" />
                    </div>
                </template>
            </Card>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                <Card class="overflow-hidden" v-for="pet in pets" :key="pet.id">
                    <template #header>
                        <div class="overflow-hidden relative h-72 md:h-80 flex items-center justify-center">
                            <Image class="object-cover" preview :src="pet.image" :alt="pet.name" />
                        </div>
                    </template>

                    <template #title>
                        <span class="font-bold" v-text="pet.name"></span>
                    </template>

                    <template #subtitle>
                        <span v-text="pet.breed"></span>
                    </template>

                    <template #footer>
                        <Button label="View Details" fluid />
                    </template>
                </Card>
            </div>
        </div>
    </div>
</template>