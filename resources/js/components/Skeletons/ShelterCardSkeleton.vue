<script setup>
import { Card } from 'primevue';
import Skeleton from 'primevue/skeleton';
</script>

<template>
<Card class="overflow-hidden" v-for="i in 2" :key="i">
    <template #header>
        <div class="overflow-hidden relative h-72 md:h-80 flex items-center justify-center border-b">
            <Skeleton class="!h-full !w-full"></Skeleton>
        </div>
    </template>

    <template #title>
        <Skeleton class="!h-10 !w-3/4 md:!w-2/4 mb-3"></Skeleton>
    </template>

    <template #content>
        <div>
            <Skeleton class="!h-16 w-full mb-3"></Skeleton>

            <Skeleton class="!h-5 !w-full mb-3"></Skeleton>

            <div class="mb-4">
                <Skeleton class="!h-5 !w-2/4 md:!w-1/4 mb-3"></Skeleton>
                <Skeleton class="!h-5 !w-2/4 md:!w-1/4 mb-3"></Skeleton>
            </div>
        </div>
    </template>

    <template #footer>
        <Skeleton class="!h-10 !w-full"></Skeleton>
    </template>
</Card>
</template>