<script setup>
import { Card, Button, IconField, InputIcon, InputText, Select, Tag } from 'primevue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { defineAsyncComponent, onMounted, reactive, ref, watch } from 'vue';
import { FilterMatchMode } from '@primevue/core/api';
import { useDialog } from 'primevue';
import { usePetStore } from '../stores/pet';

const petStore = usePetStore();
const { getUserListing } = petStore;

const dialog = useDialog();

let pets = reactive([]);
const isLoading = ref(false);
const filters = ref();

const dogBreeds = reactive([
    { breed: 'Golden Retriever', value: 'Golden Retriever' },
    { breed: 'Labrador', value: 'Labrador' },
    { breed: 'Beagle', value: 'Beagle' },
    { breed: 'Other', value: 'Other' },
]);

const catBreeds = reactive([
    { breed: 'Siamese', value: 'Siamese' },
    { breed: 'Persian', value: 'Persian' },
    { breed: 'Maine Coon', value: 'Maine Coon' },
    { breed: 'Other', value: 'Other' },
]);

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        type: { value: null, matchMode: FilterMatchMode.IN },
        gender: { value: null, matchMode: FilterMatchMode.IN },
        breed: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        status: { value: null, matchMode: FilterMatchMode.EQUALS },
    };
};

initFilters();

const clearFilter = () => {
    initFilters();
};

const getStatusSeverity = (status) => {
    switch (status) {
        case 'Available':
            return 'info';

        case 'Unavailable':
            return 'warn';

        case 'Adopted':
            return 'success';

        default:
            return null;
    }
}

const updateRow = (data) => {
   showPetFormDialog(data);
};

const petFormDialog = defineAsyncComponent(() => import('../components/Dialogs/PetFormDialog.vue'));

const showPetFormDialog = (data = null) => {
    let headerTitle = (data) ? 'Update Pet Listing' : 'Store Pet Listing';
    
    dialog.open(petFormDialog, {
        props: {
            header: headerTitle,
            style: {
                class: 'max-w-46'
            },
            modal: true
        },
        data: {
            petData: data ?? null
        },
        onClose: (opt) =>{
            //Reload data table if user store or update a row
            if(opt.data && opt.data.reloadData){
                loadPets();
            }
        }
    });
}

const loadPets = async () =>{
    isLoading.value = true;

    try{
        await getUserListing();

        //Assign pets
        pets = petStore.pets;
    }catch(error){
        console.error('Error in load pets:', error);
    }finally{
        isLoading.value = false;
    }
}

watch(petStore.pets, (newValue) => {
    if(newValue){
        loadPets();
    }
});

onMounted(async () => {
    loadPets();
})
</script>

<template>
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">Manage Pet Listings</h1>

            <Card>
                <template #title>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-semibold">Your Pet Listings</h3>

                        <Button label="Add new pet" @click="showPetFormDialog" />
                    </div>

                    <DataTable v-model:filters="filters" filterDisplay="menu" :value="pets" dataKey="id" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" :loading="isLoading">
                        <template #header>
                            <div class="flex justify-between">
                                <Button type="button" icon="pi pi-filter-slash" label="Clear Filters" outlined @click="clearFilter()" />
                                <IconField>
                                    <InputIcon>
                                        <i class="pi pi-search" />
                                    </InputIcon>
                                    <InputText v-model="filters['global'].value" placeholder="Search" />
                                </IconField>
                            </div>
                        </template>
                        
                        <template #empty>
                            <p class="text-center">No pets found.</p>
                        </template>
                        
                        <template #loading>Loading pets data. Please wait.</template>

                        <Column field="images" header="Image">
                            <template #body="{ data }">
                                <img class="size-16 object-cover rounded" :src="'/storage/' + data.images[0]" :alt="data.name">
                            </template>
                        </Column>

                        <Column field="name" sortable header="Name" :pt="{ columnTitle: { class: 'text-sm' } }" style="min-width: 12rem" />

                        <Column field="type" header="Type" sortable sortField="type" filterField="type" :showFilterMatchModes="false">
                            <template #body="{ data }">
                                {{ data.type }}
                            </template>

                            <template #filter="{ filterModel }">
                                <Select fluid v-model="filterModel.value" :options="['Dog', 'Cat']" placeholder="Select One" style="min-width: 12rem" :showClear="true" />
                            </template>
                        </Column>

                        <Column field="breed" sortable header="Breed" />

                        <Column field="gender" sortable header="Gender" :showFilterMatchModes="false">
                            <template #filter="{ filterModel }">
                                <Select v-model="filterModel.value" :options="['Male', 'Female']" placeholder="Select One" :showClear="true" />
                            </template>
                        </Column>

                        <Column field="status" sortable header="Status" :showFilterMatchModes="false">
                            <template #body="{ data }">
                                <Tag :value="data.status" :severity="getStatusSeverity(data.status)" />
                            </template>

                            <template #filter="{ filterModel }">
                                <Select v-model="filterModel.value" :options="['Available', 'Unavailable', 'Adopted']" placeholder="Select One" :showClear="true">
                                    <template #option="slotProps">
                                        <Tag :value="slotProps.option" :severity="getStatusSeverity(slotProps.option)" />
                                    </template>
                                </Select>
                            </template>
                        </Column>

                        <Column class="w-24 !text-end" header="Actions">
                            <template #body="{ data }">
                                <div class="flex items-center justify-center gap-3">
                                    <Button label="Edit" @click="updateRow(data)" severity="secondary"></Button>
                                    <Button label="Delete" @click="updateRow(data)" severity="danger"></Button>
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </template>
            </Card>
        </div>
    </div>
</template>