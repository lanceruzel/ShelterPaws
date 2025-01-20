<script setup>
import { InputText, Select, FloatLabel, Button } from 'primevue';
import PetCard from '../components/PetCard.vue';
import { reactive, computed, onMounted, ref } from 'vue';
import { usePetStore } from '../stores/pet';
import PetViewCardSkeleton from '../components/Skeletons/PetViewCardSkeleton.vue';
import DataView from 'primevue/dataview';

const petStore = usePetStore();
const { getAllPetListing } = petStore;

const formData = reactive({
    search: '',
    type: null,
    breed: null,
});

const dogBreeds = reactive(['Golden Retriever', 'Labrador', 'Beagle']);
const catBreeds = reactive(['Siamese', 'Persian', 'Maine Coon']);

let pets = reactive([]);
const isLoading = ref(false);

const loadPets = async () =>{
    isLoading.value = true;

    try{
        await getAllPetListing();

        //Assign pets
        pets = petStore.pets;
    }catch(error){
        console.error('Error in load pets:', error);
    }finally{
        isLoading.value = false;
    }
}

const filteredPets = computed(() => {
    let filtered = [...pets];

    if(formData.type){
        filtered = filtered.filter(pet => {
            return pet.type === formData.type;
        });
    }

    if(formData.breed){
        filtered = filtered.filter(pet => {
            return pet.breed === formData.breed;
        });
    }

    if(formData.search?.trim()){
        filtered = filtered.filter(pet => {
            return pet.name.toLowerCase().includes(formData.search.toLowerCase());
        });
    }

    return filtered;
});

const filteredBreeds = computed(() => {
    let breeds = [];

    if(formData.type === 'Dog'){
        breeds = dogBreeds;
    }else if(formData.type === 'Cat'){
        breeds = catBreeds;
    }

    formData.breed = null;
    return breeds;
});

onMounted(async () => {
    loadPets(); 
});
</script>

<style scoped>
::v-deep(.p-dataview-paginator-bottom) {
    @apply border-none
}

::v-deep(.p-paginator){
    @apply bg-transparent
}

::v-deep(.p-paginator-content){
    @apply bg-white py-1 px-5 rounded shadow
}
</style>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Find Your Perfect Companion</h1>

            <div v-if="!isLoading && pets.length > 0">
                <DataView :value="filteredPets" paginator :rows="5"
                    :pt="{ 
                        header: {
                            class: '!rounded-lg !p-5'
                        },
                        content: { 
                            class: '!bg-transparent my-10' 
                        },
                    }">
                    <template #header>
                        <h2 class="block font-bold">Search and Filter</h2>

                        <div class="flex flex-col sm:flex-row gap-4 rounded mt-2">
                            <InputText class="flex-grow" type="text" v-model="formData.search" placeholder="Search pet name" fluid />

                            <FloatLabel class="w-full sm:w-[180px]" variant="on">
                                <Select class="w-full" 
                                    v-model="formData.type" 
                                    :options="['Dog', 'Cat']" 
                                    checkmark :highlightOnSelect="false"
                                    :showClear="true"
                                />

                                <label>Type</label>
                            </FloatLabel>

                            <FloatLabel v-if="formData.type" class="w-full sm:w-[180px]" variant="on">
                                <Select class="w-full" 
                                    v-model="formData.breed" 
                                    :options="filteredBreeds" 
                                    checkmark :highlightOnSelect="false"
                                    :showClear="true"
                                />

                                <label>Breed</label>
                            </FloatLabel>
                        </div>
                    </template>

                    <template #list="slotProps">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <PetCard :pets="slotProps.items" />
                        </div>
                    </template>

                    <template #empty>
                        No data found.
                    </template>
                </DataView>
            </div>
            
            <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                <PetViewCardSkeleton />
            </div>
        </div>
    </div>
</template>