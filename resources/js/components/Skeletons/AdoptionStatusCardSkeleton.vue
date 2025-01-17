<script setup>
import { Card } from 'primevue';
import Skeleton from 'primevue/skeleton';
</script>

<template>
<Card>
    <template #content>
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="w-full h-72 md:size-32 overflow-hidden">
                <Skeleton class="!w-full !h-full rounded-lg" width="15rem"></Skeleton>
            </div>
            
            <div class="flex-grow text-gray-600 w-full">
                <Skeleton class="!h-8 !w-3/4 md:!w-2/4 mb-3"></Skeleton>
                <Skeleton class="!h-5 !w-2/4 md:!w-1/4 mb-3"></Skeleton>
                
                <Skeleton class="!h-5 !w-2/4 md:!w-1/4 mb-4"></Skeleton>

                <Skeleton class="!h-5 !w-20 mb-3"></Skeleton>
            </div>

            <div class="w-full md:w-auto">
                <Skeleton class="!h-5 !w-full"></Skeleton>
            </div>
        </div>
        
        <div class="mt-6">
            <Skeleton class="!h-5 !w-2/4 md:!w-1/4 mb-4"></Skeleton>
            
            <Skeleton class="!h-5 !w-full mb-4"></Skeleton>
        </div>
    </template>
</Card>
</template>