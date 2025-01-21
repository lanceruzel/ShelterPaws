<script setup>
import { Card, Tag, Button } from 'primevue';
import ProgressBar from 'primevue/progressbar';

defineProps({
    application: Object
});

const progressValue = (status) =>{
    if(status === 'Under Review'){
        return 33;
    }else if(status === 'Approved'){
        return 100;
    }else{
        return 66;
    }
}

const progressInfo = (status) =>{
    if(status === 'Under Review'){
        return 'Your application is currently being reviewed by the shelter.';
    }else if(status === 'Approved'){
        return 'Congratulations! Your application has been approved. The next step will be scheduled soon.';
    }else{
        return 'Your application is pending home visit. A shelter representative will contact you for further steps.'; //Pending home visit
    }
}

//Date formatter generated using ai
const formattedDate = (dateString) => {
    const date = new Date(dateString); // Convert the string to a Date object

    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}

const getStatusSeverity = (status) =>{
    if(status === 'Under Review'){
        return 'warn';
    }else if(status === 'Approved'){
        return 'success';
    }else{
        return 'secondary';
    }
}
</script>

<template>
    <Card v-if="application && application.pet">
        <template #content>
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="w-full h-72 md:size-32 overflow-hidden">
                    <img class="w-full h-full object-cover rounded-lg" :src="'/storage/' + application.pet.images[0]" alt="" />
                </div>
                
                <div class="flex-grow text-gray-600">
                    <h1 class="text-2xl font-semibold mb-2">{{ application.pet.name }}</h1>
                    <p class="mb-2">Shelter: <span>{{ application.pet.shelter_profile.name }}</span></p>
                    <p class="space-x-2 mb-4">
                        <i class="pi pi-calendar"></i> 
                        <span>Applied on {{ formattedDate(application.created_at) }}</span>
                    </p>

                    <Tag :value="application.status" :severity="getStatusSeverity(application.status)"></Tag>
                </div>

                <div class="w-full md:w-auto">
                    <Button fluid as="router-link" severity="contrast" label="View Pet Details" :to="{ name: 'pet-view', params: { id: application.pet_id } }" />
                </div>
            </div>
            
            <div class="mt-6">
                <h3 className="font-semibold mb-2">Application Status</h3>
                <div class="flex items-center gap-4">
                    <div class="pi pi-clock"></div>
                    <p className="text-gray-600">{{ progressInfo(application.status) }}</p>
                </div>

                <ProgressBar :value="progressValue(application.status)" class="mt-3" style="height: 0.8rem;"
                 :pt="{ 
                    label: { 
                            class: '!hidden' 
                        },
                    value: {
                            class: '!bg-gray-700'
                        }
                    }"
                ></ProgressBar>

                <div className="flex justify-between text-sm text-gray-600 mt-2">
                    <span>Submitted</span>
                    <span>Under Review</span>
                    <span>Home Visit</span>
                    <span>Approved</span>
                </div>
            </div>
        </template>
    </Card>
</template>