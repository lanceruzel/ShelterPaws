<script setup>
import { Card, Button, IconField, InputIcon, InputText, Select, Tag } from 'primevue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { defineAsyncComponent, ref } from 'vue';
import { FilterMatchMode } from '@primevue/core/api';
import { useDialog } from 'primevue';

const dialog = useDialog();

const pets = [
  { id: 1, name: "Max", species: "Dog", breed: "Golden Retriever", status: "under-review", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80", },
  { id: 2, name: "Luna", species: "Cat", breed: "Siamese", status: "available", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80", },
  { id: 3, name: "Buddy", species: "Dog", breed: "Labrador", status: "available", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80", },
  { id: 4, name: "Bella", species: "Cat", breed: "Persian", status: "pending-visit", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80", },
  { id: 5, name: "Bella", species: "Cat", breed: "Persian", status: "under-review", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80", },
  { id: 6, name: "Bella", species: "Cat", breed: "Persian", status: "available", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80", },
  { id: 7, name: "Bella", species: "Cat", breed: "Persian", status: "pending-visit", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80", },
  { id: 8, name: "Bella", species: "Cat", breed: "Persian", status: "pending-visit", image: "https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80", },
];

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

const selectRow = (data) => {
   console.log(data)
};

const petFormDialog = defineAsyncComponent(() => import('../components/Dialogs/PetFormDialog.vue'));

const showPetFormDialog = () => {
    dialog.open(petFormDialog, {
        props: {
            header: 'Update Task',
            style: {

                class: 'max-w-46'
            },
            modal: true
        },
        data: {
            // id: 2,
            // test: 'test'
        }
    });
}
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

                    <DataTable :value="pets" v-model:filters="filters" dataKey="id" filterDisplay="row" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]">
                        <template #empty>
                            <p class="text-center">No pets found.</p>
                        </template>
                        <template #loading>Loading pets data. Please wait.</template>

                        <Column field="image" header="Image">
                            <template #body="{ data }">
                                <img class="size-16 object-cover rounded" :src="data.image" :alt="data.name">
                            </template>
                        </Column>

                        <Column field="name" header="Name" :pt="{ columnTitle: { class: 'text-sm' } }">
                            <template #body="{ data }">
                                {{ data.name }}
                            </template>

                            <template #filter="{ filterModel, filterCallback }">
                                <InputText fluid v-model="filterModel.value" type="text" @input="filterCallback()" placeholder="Search by name" />
                            </template>
                        </Column>

                        <Column field="species" header="Type">
                            <template #body="{ data }">
                                {{ data.species }}
                            </template>

                            <template #filter="{ filterModel, filterCallback }">
                                <InputText fluid v-model="filterModel.value" type="text" @input="filterCallback()" placeholder="Search by type" />
                            </template>
                        </Column>

                        <Column field="breed" header="Breed">
                            <template #body="{ data }">
                                {{ data.breed }}
                            </template>

                            <template #filter="{ filterModel, filterCallback }">
                                <InputText fluid v-model="filterModel.value" type="text" @input="filterCallback()" placeholder="Search by breed" />
                            </template>
                        </Column>

                        <Column field="status" header="Status" :showFilterMenu="false" style="min-width: 12rem">
                            <template #body="{ data }">
                                <Tag :value="data.status" :severity="getSeverity(data.status)" />
                            </template>

                            <template #filter="{ filterModel, filterCallback }">
                                <Select fluid v-model="filterModel.value" @change="filterCallback()" :options="statuses" placeholder="Select One" style="min-width: 12rem" :showClear="true">
                                    <template #option="slotProps">
                                        <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                                    </template>
                                </Select>
                            </template>
                        </Column>

                        <Column class="w-24 !text-end">
                            <template #body="{ data }">
                                <div class="flex items-center justify-center gap-3">
                                    <Button label="Edit" @click="selectRow(data)" severity="secondary"></Button>
                                    <Button label="Delete" @click="selectRow(data)" severity="danger"></Button>
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </template>
            </Card>
        </div>
    </div>
</template>