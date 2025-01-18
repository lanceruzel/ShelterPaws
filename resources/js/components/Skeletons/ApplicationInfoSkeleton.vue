<script setup>
import { Card } from 'primevue';
import Skeleton from 'primevue/skeleton';
</script>

<template>
<div>
    <Skeleton class="!h-5 mb-3 !w-2/6"></Skeleton>

    <div v-for="i in 3" :key="i" class="flex gap-3">
        <Skeleton class="!h-5 mb-3 !w-2/4"></Skeleton>
        <Skeleton class="!h-5 mb-3 !w-2/4"></Skeleton>
    </div>
</div>
</template>