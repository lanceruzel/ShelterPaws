<script setup>
import { Card, InputText, Select, FloatLabel, Button } from 'primevue';
import PetCard from '../components/PetCard.vue';
import { reactive, computed, onMounted, ref } from 'vue';
import { usePetStore } from '../stores/pet';
import PetViewCardSkeleton from '../components/Skeletons/PetViewCardSkeleton.vue';

const petStore = usePetStore();
const { getAllPetListing } = petStore;

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

let pets = reactive([]);
const isLoading = ref(false);

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

const loadPets = async () =>{
    isLoading.value = true;

    try{
        await getAllPetListing();

        //Assign pets
        pets = petStore.pets;

        console.log(pets)
    }catch(error){
        console.error('Error in load pets:', error);
    }finally{
        isLoading.value = false;
    }
}

onMounted(async () => {
    loadPets(); 
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
                                :showClear="true"
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
                                :showClear="true"
                            />

                            <label>Breed</label>
                        </FloatLabel>

                        <Button label="Search" :pt="{ root: '!px-10' }" />
                    </div>
                </template>
            </Card>

            <div v-if="!isLoading" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                <PetCard :pets="pets" />
            </div>
            
            <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                <PetViewCardSkeleton />
            </div>
        </div>
    </div>
</template>