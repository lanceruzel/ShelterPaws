<script setup>
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';
import { onMounted, reactive, ref, watch } from 'vue';
import AdoptionStatusCard from '../components/AdoptionStatusCard.vue';
import { useApplicationStore } from '../stores/application';
import AdoptionStatusCardSkeleton from '../components/Skeletons/AdoptionStatusCardSkeleton.vue';

const applicationStore = useApplicationStore();
const { getUserApplications } = applicationStore;

const value = ref('0');
const isLoading = ref(false);

let applications = reactive([]);

const loadApplications = async () =>{
    isLoading.value = true;

    try{
        await getUserApplications();

        //Assign applications
        applications = applicationStore.applications;

        console.log(applicationStore.applications)
    }catch(error){
        console.error('Error in load applications:', error);
    }finally{
        isLoading.value = false;
    }
}

const filteredApplications = (status) => {
    return applications.filter(application => application.status === status);
};

watch(value, (newValue) => {
    console.log(newValue);
});

onMounted(async () => {
    loadApplications();
});
</script>

<style scoped>
    .p-tab{
        @apply !justify-center !p-1.5 !border-none
    }

    .p-tab-active > span{
        @apply !font-medium bg-white w-full h-full text-center !p-1.5 rounded !text-gray-800 shadow-sm
    }

    .p-tab > span{
        @apply !font-medium text-gray-500 text-sm px-3 py-1.5
    }
</style>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Your Adoption Applications</h1>

            <Tabs value="0" class="bg-gray-50">
                <TabList unstyled :pt="{
                    tabList: {
                        class: 'bg-gray-100 grid grid-cols-4 rounded-lg w-full font-semibold !h-12'
                    },
                    activeBar : {
                        class: ''
                    },
                }">
                    <Tab value="0" as="div" class="flex items-center gap-2">
                        <span class="font-bold whitespace-nowrap">All</span>
                    </Tab>

                    <Tab value="1" as="div" class="flex items-center gap-2">
                        <span class="font-bold whitespace-nowrap">Under Review</span>
                    </Tab>

                    <Tab value="2" class="flex items-center gap-2">
                        <span class="font-bold whitespace-nowrap">Pending Visit</span>
                    </Tab>

                    <Tab value="3" class="flex items-center gap-2">
                        <span class="font-bold whitespace-nowrap">Approved</span>
                    </Tab> 
                </TabList>

                <TabPanels
                :pt="{
                    root: {
                        class: '!bg-transparent !px-0'
                    }
                }">
                    <TabPanel value="0" as="p" class="m-0 space-y-8">
                        <AdoptionStatusCard v-if="!isLoading" v-for="application in applications" :key="application.id" :application="application" />
                        <AdoptionStatusCardSkeleton v-else />
                    </TabPanel>

                    <TabPanel value="1" as="p" class="m-0 space-y-8">
                        <AdoptionStatusCard v-if="!isLoading" v-for="application in filteredApplications('Under Review')" :key="application.id" :application="application" />
                        <AdoptionStatusCardSkeleton v-else />
                    </TabPanel>

                    <TabPanel value="2" as="p" class="m-0 space-y-8">
                        <AdoptionStatusCard v-if="!isLoading" v-for="application in filteredApplications('Pending Home Visit')" :key="application.id" :application="application" />
                        <AdoptionStatusCardSkeleton v-else />
                    </TabPanel>

                    <TabPanel value="3" as="p" class="m-0 space-y-8">
                        <AdoptionStatusCard v-if="!isLoading" v-for="application in filteredApplications('Approved')" :key="application.id" :application="application" />
                        <AdoptionStatusCardSkeleton v-else />
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </div>
    </div>
</template>