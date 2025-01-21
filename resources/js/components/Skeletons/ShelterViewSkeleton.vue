<script setup>
import Skeleton from 'primevue/skeleton';
import PetViewCardSkeleton from './PetViewCardSkeleton.vue';
</script>

<template>
    <div class="overflow-hidden bg-white rounded-lg shadow-lg mb-8">
        <div class="md:flex">
            <div class="md:w-1/2">
                <Skeleton class="!w-full !h-80 md:!h-full xl:!h-[400px]"></Skeleton>
            </div>

            <div class="md:w-1/2 p-6 md:p-10">
                <Skeleton class="!h-10 !w-3/4 md:!w-2/4 mb-3"></Skeleton>

                <Skeleton class="!h-28 !w-full mb-3"></Skeleton>

                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <Skeleton class="!h-7 !w-3/4 md:!w-2/4 mb-3"></Skeleton>

                        <div class="flex items-center space-x-2">
                            <Skeleton class="!h-5 !w-3/4 md:!w-2/4 mb-3"></Skeleton>
                        </div>
                    </div>

                    <div>
                        <Skeleton class="!h-7 !w-3/4 md:!w-2/4 mb-3"></Skeleton>

                        <div class="flex items-center space-x-2">
                            <Skeleton class="!h-5 !w-3/4 md:!w-2/4 mb-3"></Skeleton>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4">Pets available for Adoption</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <PetViewCardSkeleton />
        </div>
    </div>
</template>