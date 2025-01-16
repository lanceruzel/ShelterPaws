<script setup>
import { Card, Button } from 'primevue';
import { onMounted, reactive, ref } from 'vue';
import { usePetStore } from '../stores/pet';
import { useRoute } from 'vue-router';
import Carousel from 'primevue/carousel';
import Skeleton from 'primevue/skeleton';

const route = useRoute();

const petStore = usePetStore();
const { getPet } = petStore;
const isLoading = ref(false);

const pet = reactive([]);

const loadPetData = async () => {
    const petId = route.params.id;
    isLoading.value = true;

    try{
        const petData = await getPet(petId);
        Object.assign(pet, petData);
    }catch(error){
        console.error('Error in load pets:', error);
    }finally{
        isLoading.value = false;
    }
}

const responsiveOptions = ref([
    {
        breakpoint: '1300px',
        numVisible: 4
    },
    {
        breakpoint: '575px',
        numVisible: 1
    }
]);

onMounted(() => {
    loadPetData();
});
</script>

<template>
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 py-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <div v-if="!isLoading" class="md:flex">
                    <div class="md:w-1/2">
                        <!-- <img :src="'/storage/' + pet.images" :alt="pet.name" class="w-full h-80 md:h-full xl:h-[550px] object-cover" /> -->
                    
                        <Carousel :value="pet.images" :numVisible="1" circular :autoplayInterval="3000">
                            <template #item="slotProps">
                                <img :src="'/storage/' + slotProps.data" :alt="slotProps.data" class="w-full h-80 md:h-full xl:h-[550px] object-cover" />
                            </template>
                        </Carousel>
                    </div>

                    <div class="md:w-1/2 p-6 md:p-10">
                        <h1 className="text-3xl">{{ pet.name }}</h1>

                        <p class="text-xl mb-4">{{ pet.breed }} • {{ pet.age }} months old</p>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="font-semibold">Gender</p>
                                <!-- <p>{{ pet.gender }}</p> -->
                                <p>Male</p>
                            </div>

                            <div>
                                <p class="font-semibold">Size</p>
                                <!-- <p>{{ pet.size }}</p> -->
                                <p>Large</p>
                            </div>

                            <div>
                                <p class="font-semibold">Color</p>
                                <!-- <p>{{ pet.color }}</p> -->
                                <p>Black</p>
                            </div>

                            <div>
                                <p class="font-semibold">Type</p>
                                <p>{{ pet.type }}</p>
                            </div>
                        </div>

                        <p class="mb-6 line-clamp-3">{{ pet.description }}</p>

                        <div v-if="pet.shelter_profile" class="mb-6">
                            <p class="font-semibold">Shelter</p>
                            <p>{{ pet.shelter_profile.name }}</p>
                            <p>{{ pet.shelter_profile.province + ', ' + pet.shelter_profile.city + ', ' + pet.shelter_profile.barangay }}</p>
                        </div>
                        
                        <div class="bottom-0">
                            <Button class="mb-4" fluid severity="secondary" label="View Shelter"></Button>

                            <Button fluid>
                                <i class="pi pi-heart"></i>
                                <span>Adopt {{ pet.name }}</span>
                            </Button>
                        </div>
                    </div>
                </div>

                <div v-else class="md:flex">
                    <div class="md:w-1/2">
                        <Skeleton class="w-full !h-80 md:!h-full xl:!h-[550px]"></Skeleton>
                    </div>

                    <div class="md:w-1/2 p-6 md:p-10">
                        <Skeleton class="!h-10 mb-3 !w-2/4"></Skeleton>

                        <Skeleton class="!h-5 mb-3 !w-3/4"></Skeleton>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <Skeleton class="!h-5 mb-3 !w-4/6"></Skeleton>
                                <Skeleton class="!h-3 mb-3 !w-2/4"></Skeleton>
                            </div>

                            <div>
                                <Skeleton class="!h-5 mb-3 !w-4/6"></Skeleton>
                                <Skeleton class="!h-3 mb-3 !w-2/4"></Skeleton>
                            </div>

                            <div>
                                <Skeleton class="!h-5 mb-3 !w-4/6"></Skeleton>
                                <Skeleton class="!h-3 mb-3 !w-2/4"></Skeleton>
                            </div>

                            <div>
                                <Skeleton class="!h-5 mb-3 !w-4/6"></Skeleton>
                                <Skeleton class="!h-3 mb-3 !w-2/4"></Skeleton>
                            </div>
                        </div>

                        <Skeleton class="!h-20 mb-3"></Skeleton>

                        <div class="mb-6">
                            <Skeleton class="!h-5 mb-3 !w-2/6"></Skeleton>
                            <Skeleton class="!h-4 mb-3 !w-2/6"></Skeleton>
                            <Skeleton class="!h-3 mb-3 !w-2/6"></Skeleton>
                        </div>

                        <Skeleton class="!h-9 mb-3"></Skeleton>
                        <Skeleton class="!h-9 mb-3"></Skeleton>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>