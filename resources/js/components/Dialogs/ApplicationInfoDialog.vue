<script setup>
import { Button, Tag, Select } from 'primevue';
import { useApplicationStore } from '../../stores/application';
const applicationStore = useApplicationStore();
const { saveApplication } = applicationStore;
import { inject, onMounted, reactive, ref } from "vue";
import ApplicationInfoSkeleton from '../Skeletons/ApplicationInfoSkeleton.vue';

let formData = reactive([]);
const reloadData = ref(false);
const currentStatus = ref('');

const dialogRef = inject('dialogRef');

const closeDialog = () => {
    formData = [];
    currentStatus.value = [];

    dialogRef.value.close({
        reloadData: reloadData.value
    });
}

const getStatusSeverity = (status) =>{
    if(status === 'Under Review'){
        return 'warn';
    }else if(status === 'Approved'){
        return 'success';
    }else{
        return 'secondary';
    }
}

const submit = async () => {
    const application = await saveApplication('update', formData.id, {status: formData.status});

    if(application){
        //Reload data
        reloadData.value = true;
        
        closeDialog();
    }
}

onMounted(() => {
    //Retrieved passed data and store it on formData
    Object.assign(formData, dialogRef.value.data.applicationData);
    currentStatus.value = formData.status;
});
</script>

<style scoped>
tbody > tr > td{
    @apply !p-3 border
}

.p-dialog > .p-component{
    @apply !w-48
}
</style>

<template>
    <form v-if="formData.pet" @submit.prevent="submit">
        <div class="flex items-center gap-2 mb-4">
            <p>Current Status: </p>
            <Tag :value="currentStatus" :severity="getStatusSeverity(currentStatus)" />
        </div>

        <table class="table-auto w-full mb-4">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="font-semibold">Pet Name</td>
                    <td>{{ formData.pet.name }}</td>
                </tr>

                <tr>
                    <td class="font-semibold">Applicant Name</td>
                    <td>{{ formData.user_profile.name }}</td>
                </tr>

                <tr>
                    <td class="font-semibold">Contact</td>
                    <td>{{ formData.user_profile.contact }}</td>
                </tr>

                <tr>
                    <td class="font-semibold">Province</td>
                    <td>{{ formData.user_profile.province }}</td>
                </tr>

                <tr>
                    <td class="font-semibold">City</td>
                    <td>{{ formData.user_profile.city }}</td>
                </tr>

                <tr>
                    <td class="font-semibold">Barangay</td>
                    <td>{{ formData.user_profile.barangay }}</td>
                </tr>

                <tr>
                    <td class="font-semibold">Adopter Description</td>
                    <td class="text-wrap break-words max-w-48">{{ formData.adopter_description }}</td>
                </tr>

                <tr>
                    <td class="font-semibold">Status</td>
                    <td class="text-wrap break-words max-w-48">
                        <Select fluid v-model="formData.status" :options="['Pending Home Visit', 'Under Review', 'Approved']" placeholder="Select One" :showClear="true">
                            <template #option="slotProps">
                                <Tag :value="slotProps.option" :severity="getStatusSeverity(slotProps.option)" />
                            </template>
                        </Select>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="flex items-center justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="closeDialog"></Button>
            <Button type="submit" label="Update" :loading="applicationStore.isFormLoading"></Button>
        </div>
    </form>

    <ApplicationInfoSkeleton v-else />
</template>