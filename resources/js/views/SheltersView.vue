<script setup>
import { Card, InputText, FloatLabel, Select, Button, Badge } from 'primevue';
import { onMounted, reactive, ref } from 'vue';
import ShelterCard from '../components/ShelterCard.vue';
import { useShelterStore } from '../stores/shelter';
import ShelterCardSkeleton from '../components/Skeletons/ShelterCardSkeleton.vue';

const shelterStore = useShelterStore();
const { getShelters } = shelterStore;

const formData = reactive({
    search: '',
    city: null,
});

const isLoading = ref(false);

let shelters = reactive({});

const loadShelters = async () =>{
    isLoading.value = true;

    try{
        await getShelters();

        //Assign pets
        shelters = shelterStore.shelters;
    }catch(error){
        console.error('Error in load shelter:', error);
    }finally{
        isLoading.value = false;
    }
}

onMounted(() => {
    loadShelters();
});
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
                        <Button label="Search" :pt="{ root: '!px-10' }" />
                    </div>
                </template>
            </Card>

            <div v-if="!isLoading" class="grid md:grid-cols-2 gap-8 mt-10">
                <ShelterCard :shelters="shelters"/>
            </div>
            
            <div v-else class="grid md:grid-cols-2 gap-8 mt-10">
                <ShelterCardSkeleton />
            </div>
        </div>
    </div>
</template>