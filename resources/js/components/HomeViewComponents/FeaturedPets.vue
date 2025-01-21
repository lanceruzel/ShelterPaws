<script setup>
import { Button, Card } from 'primevue';
import PetCard from '../PetCard.vue';
import { onMounted, reactive, ref } from 'vue';
import { usePetStore } from '../../stores/pet';
import PetViewCardSkeleton from '../Skeletons/PetViewCardSkeleton.vue';

const petStore = usePetStore();
const { getAllPetListing } = petStore;

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

onMounted(async () => {
    loadPets(); 
});
</script>

<template>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Featured Pets</h2>

            <div v-if="!isLoading" class="grid md:grid-cols-3 gap-8">
                <PetCard :pets="pets" />
            </div>

            <div v-else class="grid md:grid-cols-3 gap-8">
                <PetViewCardSkeleton />
            </div>

            <div class="text-center mt-12">
                <Button as="router-link" label="View All Available Pets" :to="{ name: 'pets' }" severity="secondary" />
            </div>
        </div>
    </section>
</template>