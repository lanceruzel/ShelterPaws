<script setup>
import { Button, InputText } from 'primevue';
import Dialog from 'primevue/dialog';
import { onMounted, reactive, ref } from "vue";
import Textarea from 'primevue/textarea';
import InputMask from 'primevue/inputmask';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import { useApplicationStore } from '../../stores/application';
import { storeToRefs } from 'pinia';
import { useRouter } from 'vue-router';

const router = useRouter();

const applicationStore = useApplicationStore();
const { saveApplication } = applicationStore;
const { errors } = storeToRefs(applicationStore);

const visible = ref(false);

const props = defineProps({
    id: Number,
    name: String
});

const formData = reactive({
    pet_id: props.id,
    contact: '',
    adopter_description: '',
});

const clearForm = () => {
    formData.contact = '';
    formData.adopter_description = '';
}

async function submit(){
    const application = await saveApplication('store', null, formData)

    if(application){
        //Redirect
        router.push({ name: 'adoption-status' });

        //Clear form
        clearForm();

        visible.value = false;
    }
}
</script>

<template>
<Button fluid icon="pi pi-heart" :label="'Adopt ' + name" @click="visible = true" />

<Dialog v-model:visible="visible" modal header="Adoption Application" :style="{ width: '25rem' }">
    <form @submit.prevent="submit">
        <span class="text-surface-500 dark:text-surface-400 block mb-8">Input information.</span>

        <div class="flex flex-col gap-1 mb-3">
            <label class="font-semibold">Contact</label> 
            <InputGroup>
                <InputGroupAddon>+63</InputGroupAddon>
                <InputMask mask="999-9999-999" placeholder="999-9999-999" v-model="formData.contact" :invalid="errors.contact" />
            </InputGroup>
            <small class="form-error-message" v-if="errors.contact">{{ errors.contact[0] }}</small>
        </div>

        <div class="flex flex-col gap-1 mb-3">
            <label class="font-semibold">Description</label>
            <Textarea v-model="formData.adopter_description" :invalid="errors.adopter_description" rows="5" cols="30" />
            <small class="form-error-message" v-if="errors.adopter_description">{{ errors.adopter_description[0] }}</small>
        </div>

        <div class="flex justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
            <Button type="submit" label="Submit" :loading="applicationStore.isFormLoading"></Button>
        </div>
    </form>
</Dialog>
</template>