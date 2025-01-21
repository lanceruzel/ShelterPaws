<script setup>
import { Card } from 'primevue';
import Skeleton from 'primevue/skeleton';
</script>

<template>
<div class="md:flex">
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
</template>