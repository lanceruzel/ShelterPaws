<script setup>
import { Card, Button, IconField, InputIcon, InputText, Select, Tag } from 'primevue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { defineAsyncComponent, onMounted, reactive, ref } from 'vue';
import { useApplicationStore } from '../stores/application';
import { FilterMatchMode } from '@primevue/core/api';
import { useDialog } from 'primevue';

const applicationStore = useApplicationStore();
const { getUserApplications } = applicationStore;

const dialog = useDialog();

const isLoading = ref(false);
const filters = ref();
let applications = reactive([]);

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        // name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        // type: { value: null, matchMode: FilterMatchMode.IN },
        // gender: { value: null, matchMode: FilterMatchMode.IN },
        // breed: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        status: { value: null, matchMode: FilterMatchMode.EQUALS },
    };
};

initFilters();

//Date formatter generated using ai
const formattedDate = (dateString) => {
    const date = new Date(dateString); // Convert the string to a Date object

    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}

const loadApplications = async () =>{
    isLoading.value = true;

    try{
        await getUserApplications();

        //Assign applications
        applications = applicationStore.applications;
    }catch(error){
        console.error('Error in load applications:', error);
    }finally{
        isLoading.value = false;
    }
}

const getStatusSeverity = (status) => {
    switch (status) {
        case 'Pending Home Visit':
            return 'info';

        case 'Approved':
            return 'success';

        case 'Under Review':
            return 'warn';

        default:
            return null;
    }
}

const adoptionApplicationsViewDialog = defineAsyncComponent(() => import('../components/Dialogs/ApplicationInfoDialog.vue'));

const showAdoptionApplicationsViewDialog = (data = null) => {
    console.log(data)
    dialog.open(adoptionApplicationsViewDialog, {
        props: {
            header: 'Adoption Application Information',
            style: {
                width: '50vw',
            },
            breakpoints:{
                '960px': '75vw',
                '640px': '90vw'
            },
            modal: true
        },
        data: {
            applicationData: data ?? null
        },
        onClose: (opt) =>{
            //Reload data table if user store or update a row
            if(opt.data && opt.data.reloadData){
                loadApplications();
            }
        }
    });
}

onMounted(async () => {
    loadApplications();
});
</script>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Manage Adoption Applications</h1>

            <Card>
                <template #title>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-semibold">Applications</h3>
                    </div>

                    <DataTable v-model:filters="filters" filterDisplay="menu" :value="applications" dataKey="id" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" :loading="isLoading">
                        <template #header>
                            <div class="flex justify-end">
                                <IconField>
                                    <InputIcon>
                                        <i class="pi pi-search" />
                                    </InputIcon>
                                    
                                    <InputText v-model="filters['global'].value" placeholder="Search" />
                                </IconField>
                            </div>
                        </template>
                        
                        <template #empty>
                            <div class="flex flex-col items-center justify-center">
                                <img class="h-[400px]" src="/public/assets/imgs/no_found.svg" alt="">
                                <h2 class="text-3xl font-bold">No data found.</h2>
                            </div>
                        </template>
                        
                        <template #loading>Loading applications data. Please wait.</template>

                        <Column field="pet.name" sortable header="Pet" />
                        <Column field="pet.breed" sortable header="Breed" />

                        <Column field="user_profile.name" sortable header="Applicant Name" />

                        <Column field="status" sortable header="Status" :showFilterMatchModes="false">
                            <template #body="{ data }">
                                <Tag :value="data.status" :severity="getStatusSeverity(data.status)" />
                            </template>

                            <template #filter="{ filterModel }">
                                <Select v-model="filterModel.value" :options="['Pending Home Visit', 'Under Review', 'Approved']" placeholder="Select One" :showClear="true">
                                    <template #option="slotProps">
                                        <Tag :value="slotProps.option" :severity="getStatusSeverity(slotProps.option)" />
                                    </template>
                                </Select>
                            </template>
                        </Column>

                        <Column field="created_at" sortable header="Date Submitted">
                            <template #body="{ data }">
                                {{ formattedDate(data.created_at) }}
                            </template>
                        </Column>

                        <Column class="w-24 !text-end" header="Actions">
                            <template #body="{ data }">
                                <div class="flex items-center justify-center gap-3">
                                    <Button label="View" @click="showAdoptionApplicationsViewDialog(data)"></Button>
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </template>
            </Card>
        </div>
    </div>
</template>