<script setup>
import { Card, Button, Badge } from 'primevue';
import Image from 'primevue/image';

defineProps({
   shelters: Object,
});

const getPetsCount = (pets) =>{
    if(Array.isArray(pets)){
        return pets.length;
    }
}
</script>

<template>
    <Card class="overflow-hidden" v-for="user in shelters" :key="user.id">
        <template #header>
            <div class="overflow-hidden relative h-72 md:h-80 flex items-center justify-center border-b">
                <Image class="object-cover w-full" preview :src="'/storage/' + user.user_profile.cover_photo" :alt="user.user_profile.name" />
            </div>
        </template>

        <template #title>
            <div class="flex items-center justify-between">
                <span class="font-bold" v-text="user.user_profile.name"></span>

                <Badge severity="secondary">
                    <div class="text-xs space-x-1 font-bold">
                        <span>{{ getPetsCount(user.user_profile.pets) }}</span>
                        <span>Pets</span>
                    </div>
                </Badge>
            </div>
        </template>

        <template #content>
            <div class="text-gray-600">
                <p class="line-clamp-2 mb-4">{{ user.user_profile.description }}</p>

                <div class="grid gri-cols-2 gap-4 mb-4">
                    <div class="flex items-center space-x-2">
                        <i class="pi pi-map-marker"></i>
                        <span>{{ user.user_profile.province + ', ' + user.user_profile.city + ', ' + user.user_profile.barangay }}</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <i class="pi pi-phone"></i>
                        <span>{{ user.user_profile.contact }}</span>
                    </div>

                    <div class="flex items-center space-x-2 col-span-2">
                        <i class="pi pi-envelope"></i>
                        <span>{{ user.email }}</span>
                    </div>
                </div>
            </div>
        </template>

        <template #footer>
            <Button as="router-link" label="View Shelter" :to="{ name: 'shelter-view', params: { id: user.id } }" fluid />
        </template>
    </Card>
</template>