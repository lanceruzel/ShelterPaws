<script setup>
import { Card, InputText, FloatLabel, Select, Button, Badge } from 'primevue';
import { computed, onMounted, reactive, ref } from 'vue';
import ShelterCard from '../components/ShelterCard.vue';
import { useShelterStore } from '../stores/shelter';
import ShelterCardSkeleton from '../components/Skeletons/ShelterCardSkeleton.vue';
import DataView from 'primevue/dataview';

const shelterStore = useShelterStore();
const { getShelters } = shelterStore;

const formData = reactive({
    search: '',
    province: null,
});

const isLoading = ref(false);

let shelters = reactive([]);
let geoData = ref();
let provinces = ref([]);

const loadShelters = async () =>{
    isLoading.value = true;

    try{
        await getShelters();

        //Assign shelters
        shelters = shelterStore.shelters;
    }catch(error){
        console.error('Error in load shelter:', error);
    }finally{
        isLoading.value = false;
    }
}

async function loadProvinces() {
    try{
        const response = await axios.get('/data/philippines.json');

        if(response.status === 200){
            geoData.value = response.data;

            //Get provinces
            provinces.value = Object.keys(geoData.value).map((provinceName) => {
                return provinceName;
            });

            provinces.value.sort();
        }
    }catch(error){
        console.error('Error fetching data:', error);
    }
}

const filteredShelter = computed(() => {
    let filtered = [...shelters];

    if(formData.province){
        filtered = filtered.filter(shelter => {
            return shelter.user_profile.province === formData.province;
        });
    }

    if(formData.search?.trim()){
        filtered = filtered.filter(shelter => {
            return shelter.user_profile.name.toLowerCase().includes(formData.search.toLowerCase());
        });
    }
    return filtered;
});

onMounted(() => {
    loadProvinces();
    loadShelters();
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
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Partner Shelters</h1>

            <div v-if="!isLoading && shelters.length > 0">
                <DataView :value="filteredShelter" paginator :rows="5" 
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

                        <div class="flex flex-col sm:flex-row gap-4 mt-2">
                            <InputText class="flex-grow" type="text" v-model="formData.search" placeholder="Search shelters by name" fluid />

                            <FloatLabel class="w-full sm:w-[180px]" variant="on">
                                <Select class="w-full" 
                                    v-model="formData.province" 
                                    :options="provinces" 
                                    checkmark :highlightOnSelect="false"
                                    :showClear="true"
                                />

                                <label>Province</label>
                            </FloatLabel>
                        </div>
                    </template>

                    <template #list="slotProps">
                        <div class="grid md:grid-cols-2 gap-8 mt-10">
                            <ShelterCard :shelters="slotProps.items"/>
                        </div>
                    </template>

                    <template #empty>
                        <div class="flex flex-col items-center justify-center">
                            <img class="h-[400px]" src="/public/assets/imgs/no_found.svg" alt="">
                            <h2 class="text-3xl font-bold">No data found.</h2>
                        </div>
                    </template>
                </DataView>
            </div>
            
            <div v-else class="grid md:grid-cols-2 gap-8 mt-10">
                <ShelterCardSkeleton />
            </div>
        </div>
    </div>
</template>