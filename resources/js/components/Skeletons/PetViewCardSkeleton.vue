<script setup>
import { Card } from 'primevue';
import Skeleton from 'primevue/skeleton';
</script>

<template>
<Card v-for="i in 3" :key="i">
    <template #header>
        <div class="overflow-hidden relative h-72 md:h-80 flex items-center justify-center border-b">
            <Skeleton class="w-full !h-full"></Skeleton>
        </div>
    </template>

    <template #title>
        <Skeleton class="!h-5" width="15rem"></Skeleton>
    </template>

    <template #subtitle>
        <Skeleton class="mt-3" width="6rem"></Skeleton>
    </template>

    <template #footer>
        <Skeleton class="!h-10 w-full"></Skeleton>
    </template>
</Card>
</template>