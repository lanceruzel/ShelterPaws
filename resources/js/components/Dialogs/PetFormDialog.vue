<script setup>
import { InputText, Button, Select, InputNumber, ProgressBar, Message, Badge } from 'primevue';
import { computed, onMounted, reactive, ref, watch } from 'vue';
import { inject } from "vue";
import Textarea from 'primevue/textarea';
import { useToast } from "primevue/usetoast";
import FileUpload from 'primevue/fileupload';
import { usePrimeVue } from 'primevue/config';
import { usePetStore } from '../../stores/pet';
import { storeToRefs } from 'pinia';

const dialogRef = inject('dialogRef');

const mode = ref('store');

const petStore = usePetStore();
const { savePet } = petStore;
const { errors } = storeToRefs(petStore);
const visible = ref(false);
const reloadData = ref(false);

const formData = reactive({
    id: null,
    name: '',
    type: 'Dog',
    breed: null,
    age: 1,
    health_status: 'Good',
    description: '',
    images: [],
    newImages: []
});

const closeDialog = () => {
    resetForm();

    dialogRef.value.close({
        reloadData: reloadData.value
    });
}

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

const filteredBreeds = computed(() => {
    if (formData.type === 'Dog') {
        return dogBreeds;
    } else if (formData.type === 'Cat') {
        return catBreeds;
    } else {
        return [];
    }

    formData.breed = null;
});

const files = ref([]);

const onSelectedFiles = (event) => {
    files.value = event.files;
};

const removeImage = (index, mode) => {
    if(mode === 'files'){
        files.value.splice(index, 1);
    }else{
        formData.images.splice(index, 1);
    }
};

const onClearTemplatingUpload = (clear) => {
    clear();
};

function resetForm(){
    formData.name = '';
    formData.type = 'Dog';
    formData.breed = null;
    formData.age = 1;
    formData.health_status = 'Good';
    formData.description = '';
    formData.images = [];
    formData.newImages = [];
}

async function submit(){
    if(mode.value === 'update'){
        //Push new images on form data
        files.value.forEach((val) => {
            formData.newImages.push(val);
        });
    }else{
        formData.images = files.value;
    }

    const pet = await savePet(
        (formData.id) ? 'update' : 'store', 
        formData.id, formData);

    if(pet){
        //Reload data
        reloadData.value = true;
        
        closeDialog();
        
        //Clear form
        resetForm();
    }
}

onMounted(() => {
    errors.value = {};

    //Retrieved passed data and store it on formData
    Object.assign(formData, dialogRef.value.data.petData);

    //Identify form mode
    if(formData.id){
        mode.value = 'update';
    }else{
        mode.value = 'store';
    }
});
</script>

<template>
    <form @submit.prevent="submit">
        <span class="text-surface-500 dark:text-surface-400 block mb-4">Input pet details.</span>

        <div class="flex flex-col gap-1 mb-3">
            <label class="font-semibold">Pet Name</label>
            <InputText v-model="formData.name" :invalid="errors.name"/>
            <small class="form-error-message" v-if="errors.name">{{ errors.name[0] }}</small>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="flex flex-col gap-1 mb-3">
                <label class="font-semibold">Type</label>

                <Select 
                    v-model="formData.type" 
                    :invalid="errors.type"
                    optionLabel="type" 
                    optionValue="value"
                    :options="[{ type: 'Dog', value: 'Dog' }, { type: 'Cat', value: 'Cat' }]" 
                    checkmark :highlightOnSelect="false" 
                />

                <small class="form-error-message" v-if="errors.type">{{ errors.type[0] }}</small>
            </div>

            <div class="flex flex-col gap-1 mb-3">
                <label class="font-semibold">Breed</label>

                <Select  
                    v-model="formData.breed" 
                    :invalid="errors.breed"
                    :options="filteredBreeds" 
                    optionLabel="breed" 
                    optionValue="value"
                    checkmark :highlightOnSelect="false" 
                />

                <small class="form-error-message" v-if="errors.breed">{{ errors.breed[0] }}</small>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="flex flex-col gap-1 mb-3">
                <label class="font-semibold">Age <small>(In months)</small></label>

                <InputNumber v-model="formData.age" :invalid="errors.age" fluid showButtons buttonLayout="horizontal" :step="1">
                    <template #incrementbuttonicon>
                        <span class="pi pi-plus" />
                    </template>

                    <template #decrementbuttonicon>
                        <span class="pi pi-minus" />
                    </template>
                </InputNumber>

                <small class="form-error-message" v-if="errors.age">{{ errors.age[0] }}</small>
            </div>

            <div class="flex flex-col gap-1 mb-3">
                <label class="font-semibold">Health Status</label>
                <Select 
                    v-model="formData.health_status" 
                    optionLabel="status" 
                    optionValue="value"
                    :options="[{ status: 'Good', value: 'Good' }, { status: 'Recovery', value: 'Recovery' }]" 
                    checkmark :highlightOnSelect="false" 
                />
                <small class="form-error-message"></small>
            </div>
        </div>

        <div class="flex flex-col gap-1 mb-3">
            <label class="font-semibold">Description</label>
            <Textarea v-model="formData.description" :invalid="errors.description" rows="5" cols="30" />
            <small class="form-error-message" v-if="errors.description">{{ errors.description[0] }}</small>
        </div>

        <div class="mb-5">
            <label class="font-semibold mb-1">Images</label>
            
            <FileUpload :multiple="true" @select="onSelectedFiles" accept="image/*" :maxFileSize="1000000">
                <template #header="{ chooseCallback, clearCallback, files }">
                    <div class="flex flex-wrap justify-between items-center flex-1 gap-4">
                        <div class="flex gap-2">
                            <Button @click="chooseCallback()" icon="pi pi-images" rounded outlined severity="secondary"></Button>
                            <Button @click="clearCallback()" icon="pi pi-times" rounded outlined severity="danger" :disabled="!files || files.length === 0"></Button>
                        </div>
                    </div>
                </template>

                <template #content="{ files }">
                    <div class="flex flex-col gap-8 pt-4">
                        <div class="grid md:grid-cols-2 gap-5 w-full">
                            <!-- Existing images -->
                            <div v-if="mode === 'update' && formData.images && formData.images.length > 0" v-for="(image, index) in formData.images" :key="index" class="flex flex-col items-center w-full">
                                <img :src="'/storage/' + image" :alt="image" class="shadow-md rounded-xl w-full sm:w-64 h-64 object-cover mb-1" />

                                <p class="mb-3 text-ellipsis sm:max-w-64 line-clamp-1 text-center" v-text="image"></p>
                            
                                <Button 
                                    icon="pi pi-times" 
                                    @click="removeImage(index, 'formData')"
                                    outlined 
                                    rounded 
                                    severity="danger" 
                                />
                            </div>

                            <div v-if="files.length > 0" v-for="(file, index) in files" :key="file.name + file.type + file.size" class="flex flex-col items-center w-full">
                                <img :src="file.objectURL" :alt="file.name" class="shadow-md rounded-xl w-full sm:w-64 h-64 object-cover mb-1" />

                                <p class="mb-3 text-ellipsis sm:max-w-64 line-clamp-1 text-center" v-text="file.name"></p>
                            
                                <Button 
                                    icon="pi pi-times" 
                                    @click="removeImage(index, 'files')"
                                    outlined 
                                    rounded 
                                    severity="danger" 
                                />
                            </div>
                        </div>
                    </div>
                </template>

                <template #empty>
                    <div class="flex items-center justify-center flex-col">
                        <i class="pi pi-cloud-upload !border-2 !rounded-full !p-8 !text-4xl !text-muted-color" />
                        <p class="mt-6 mb-0">Drag and drop files to here to upload.</p>
                    </div>
                </template>
            </FileUpload>

            <small class="form-error-message block" v-if="errors.images" v-for="(err, index) in errors.images" :key="index">{{ err }}</small>
            <small class="form-error-message block" v-if="errors.newImages" v-for="(err, index) in errors.newImages" :key="index">{{ err }}</small>
        </div>

        <div class="flex items-center justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="closeDialog"></Button>
            <Button type="submit" :label="(mode === 'store') ? 'Add' : 'Update'" :loading="petStore.isFormLoading"></Button>
        </div>
    </form>
</template>