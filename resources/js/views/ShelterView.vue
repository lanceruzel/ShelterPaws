<script setup>
import { Button } from 'primevue';
import PetCard from '../components/PetCard.vue';
import { onMounted, reactive, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useShelterStore } from '../stores/shelter';
import ShelterViewSkeleton from '../components/Skeletons/ShelterViewSkeleton.vue';
import DataView from 'primevue/dataview';

const shelterStore = useShelterStore();
const { getShelter } = shelterStore;

const route = useRoute();
const isLoading = ref(false);

let shelter = reactive({
  user_profile: {
    cover_photo: '',
    name: '',
    description: '',
    province: '',
    city: '',
    barangay: '',
    contact: '',
    pets: [],
  },
  email: '',
});

const loadShelterData = async () =>{
    const userId = route.params.id;
    isLoading.value = true;

    try{
        const shelterData = await getShelter(userId);
        Object.assign(shelter, shelterData);
    }catch(error){
        console.error('Error in load shelter data:', error);
    }finally{
        isLoading.value = false;
    }
}

onMounted(() => {
    loadShelterData();
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
    <div class="bg-gray-50 py-20">
        <div v-if="!isLoading" class="container mx-auto px-4 py-8">
            <div  class="overflow-hidden bg-white rounded-lg shadow-lg mb-8">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <img :src="'/storage/' + shelter.user_profile.cover_photo" :alt="shelter.user_profile.name" class="w-full h-80 md:h-full xl:h-[400px] object-cover" />
                    </div>

                    <div class="md:w-1/2 p-6 md:p-10">
                        <h1 className="text-3xl mb-6 font-bold">{{ shelter.user_profile.name }}</h1>

                        <p class="mb-6 line-clamp-3">{{ shelter.user_profile.description }}</p>

                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="font-semibold text-lg">Location</p>

                                <div class="flex items-center space-x-2">
                                    <i class="pi pi-map-marker"></i>
                                    <span>{{ shelter.user_profile.province + ', ' + shelter.user_profile.city + ', ' + shelter.user_profile.barangay }}</span>
                                </div>
                            </div>

                            <div>
                                <p class="font-semibold text-lg">Contact</p>

                                <div class="flex items-center space-x-2">
                                    <i class="pi pi-phone"></i>
                                    <span>{{ shelter.user_profile.contact }}</span>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <p class="font-semibold text-lg">Email</p>

                                <div class="flex items-center space-x-2">
                                    <i class="pi pi-envelope"></i>
                                    <span>{{ shelter.email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-bold mb-4">Pets available for Adoption</h2>

            <DataView :value="shelter.user_profile.pets" paginator :rows="5"
                :pt="{ 
                    header: {
                        class: '!rounded-lg !p-5'
                    },
                    content: { 
                        class: '!bg-transparent my-10' 
                    },
                }">
                <template #list="slotProps">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <PetCard :pets="slotProps.items" />
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

        <div v-else class="container mx-auto px-4 py-8">
            <ShelterViewSkeleton />
        </div>
    </div>
</template>