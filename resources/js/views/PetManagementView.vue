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

const statuses = ref(['under-review', 'available', 'adopted', 'pending-visit']);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    species: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    breed: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    status: { value: null, matchMode: FilterMatchMode.EQUALS },
});

const getSeverity = (status) => {
    switch (status) {
        case 'under-review':
            return 'warn';

        case 'available':
            return 'success';

        case 'adopted':
            return 'info';

        case 'pending-visit':
            return 'danger';

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
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold">Your Pet Listings</h3>

                        <Button label="Add new pet" @click="showPetFormDialog" />
                    </div>

                    <DataTable :value="pets" dataKey="id" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" :loading="isLoading">
                        <template #empty>
                            <p class="text-center">No pets found.</p>
                        </template>
                        
                        <template #loading>Loading pets data. Please wait.</template>

                        <Column field="images" header="Image">
                            <template #body="{ data }">
                                <img class="size-16 object-cover rounded" :src="'/storage/' + data.images[0]" :alt="data.name">
                            </template>
                        </Column>

                        <Column field="name" header="Name" :pt="{ columnTitle: { class: 'text-sm' } }">
                            <template #body="{ data }">
                                {{ data.name }}
                            </template>

                            <!-- <template #filter="{ filterModel, filterCallback }">
                                <InputText fluid v-model="filterModel.value" type="text" @input="filterCallback()" placeholder="Search by name" />
                            </template> -->
                        </Column>

                        <Column field="species" header="Type">
                            <template #body="{ data }">
                                {{ data.type }}
                            </template>

                            <!-- <template #filter="{ filterModel, filterCallback }">
                                <InputText fluid v-model="filterModel.value" type="text" @input="filterCallback()" placeholder="Search by type" />
                            </template> -->
                        </Column>

                        <Column field="breed" header="Breed">
                            <template #body="{ data }">
                                {{ data.breed }}
                            </template>

                            <!-- <template #filter="{ filterModel, filterCallback }">
                                <InputText fluid v-model="filterModel.value" type="text" @input="filterCallback()" placeholder="Search by breed" />
                            </template> -->
                        </Column>

                        <Column field="status" header="Status" style="min-width: 12rem">
                            <template #body="{ data }">
                                <Tag :value="data.status" :severity="getSeverity(data.status)" />
                            </template>

                            <!-- <template #filter="{ filterModel, filterCallback }">
                                <Select fluid v-model="filterModel.value" @change="filterCallback()" :options="statuses" placeholder="Select One" style="min-width: 12rem" :showClear="true">
                                    <template #option="slotProps">
                                        <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                                    </template>
                                </Select>
                            </template> -->
                        </Column>

                        <Column class="w-24 !text-end">
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