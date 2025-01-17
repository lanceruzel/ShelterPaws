<script setup>
import { Card, Button } from 'primevue';
import Tag from 'primevue/tag';
import { onMounted, reactive, ref } from 'vue';
import { usePetStore } from '../stores/pet';
import { useRoute } from 'vue-router';
import Carousel from 'primevue/carousel';
import Skeleton from 'primevue/skeleton';
import AdoptFormDialog from '../components/Dialogs/AdoptFormDialog.vue';
import PetViewSkeleton from '../components/Skeletons/PetViewSkeleton.vue';

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

        if(pet.vaccines){
            //Format vaccinces field 
            const formatted = pet.vaccines.split(',');
            pet.vaccines = formatted.map(item => item.replace(/[\[\]\\"\\]/g, '').trim());
        }
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

//Date formatter generated using ai
const formattedDate = (date) => {
// Current date and the target date
    const currentDate = new Date();
    const specificDate = new Date(date);

    // Calculate the difference in milliseconds
    let timeDifference = specificDate - currentDate;

    // Calculate the difference in years, months, and days
    const years = Math.floor(timeDifference / (1000 * 60 * 60 * 24 * 365));
    timeDifference -= years * (1000 * 60 * 60 * 24 * 365);

    const months = Math.floor(timeDifference / (1000 * 60 * 60 * 24 * 30));
    timeDifference -= months * (1000 * 60 * 60 * 24 * 30);

    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

    // Format the result
    let result = [];

    if (years > 0) result.push(`${years} year${years > 1 ? 's' : ''}`);
    if (months > 0) result.push(`${months} month${months > 1 ? 's' : ''}`);
    if (days > 0) result.push(`${days} day${days > 1 ? 's' : ''}`);

    // If there's more than one item in the result array, replace the last comma with "and"
    if (result.length > 1) {
        const lastItem = result.pop(); // Remove the last item
        return result.join(', ') + ' and ' + lastItem; // Join the rest with commas and add "and" before the last item
    }

    return result.join('');
}

onMounted(() => {
    loadPetData();
});
</script>

<template>
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 py-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <div v-if="!isLoading" class="md:flex">
                    <div class="md:w-1/2 flex items-center justify-center">
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
                                <p>{{ pet.gender }}</p>
                            </div>

                            <div>
                                <p class="font-semibold">Spayed/Neutered</p>
                                <p>{{ pet.fixed === 1 ? 'Yes' : 'No' }}</p>
                            </div>

                            <div>
                                <p class="font-semibold">Type</p>
                                <p>{{ pet.type }}</p>
                            </div>

                            <div>
                                <p class="font-semibold">Foster Time</p>
                                <!-- <p>{{ pet.color }}</p> -->
                                <p>{{ formattedDate(pet.adopted_at) }}</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-semibold">Vaccines:</p>
                                
                                <div class="flex items-center justify-start gap-3 flex-wrap">
                                    <Tag v-for="(vac, index) in pet.vaccines" :key="index" :value="vac" icon="pi pi-check" severity="secondary" class="cursor-pointer"></Tag>
                                </div>
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

                            <AdoptFormDialog :id="pet.id" :name="pet.name"/>
                        </div>
                    </div>
                </div>

                <PetViewSkeleton v-else/>
            </div>
        </div>
    </div>
</template>