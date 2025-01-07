<script setup>
import { Card, Tag, Button } from 'primevue';
import ProgressBar from 'primevue/progressbar';
</script>

<template>
    <Card>
        <template #content>
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="w-full h-72 md:size-32 overflow-hidden">
                    <img class="w-full h-full object-cover rounded-lg" src="https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="" />
                </div>
                
                <div class="flex-grow text-gray-600">
                    <h1 class="text-2xl font-semibold mb-2">Max</h1>
                    <p class="mb-2">Shelter: <span>Happy Tails Rescue</span></p>
                    <p class="space-x-2 mb-4">
                        <i class="pi pi-calendar"></i> 
                        <span>Applied on 2023-05-15</span>
                    </p>

                    <Tag value="Under Review" severity="warn"></Tag>
                </div>

                <div class="w-full md:w-auto">
                    <Button fluid label="View Pet Details" severity="contrast" />
                </div>
            </div>
            
            <div class="mt-6">
                <h3 className="font-semibold mb-2">Application Status</h3>
                <div class="flex items-center gap-4">
                    <div class="pi pi-clock"></div>
                    <p className="text-gray-600">Your application is currently being reviewed by the shelter.</p>
                </div>

                <ProgressBar :value="33" class="mt-3" style="height: 0.8rem;"
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