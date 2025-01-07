<script setup>
import { InputText, Button, Select, InputNumber, ProgressBar, Message, Badge } from 'primevue';
import { computed, onMounted, reactive, ref } from 'vue';
import { inject } from "vue";
import Textarea from 'primevue/textarea';
import { useToast } from "primevue/usetoast";
import FileUpload from 'primevue/fileupload';
import { usePrimeVue } from 'primevue/config';

const dialogRef = inject('dialogRef');

const $primevue = usePrimeVue();
const toast = useToast();

const mode = ref('store');

const closeDialog = () => {
    dialogRef.value.close();
}

const formData = reactive({
    type: 'Dog',
    breed: '',
    age: 1,
    healthStatus: 'Good'
});

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

const totalSize = ref(0);
const totalSizePercent = ref(0);
const files = ref([]);

const onRemoveTemplatingFile = (file, removeFileCallback, index) => {
    removeFileCallback(index);
    totalSize.value -= parseInt(formatSize(file.size));
    totalSizePercent.value = totalSize.value / 10;
};

const onClearTemplatingUpload = (clear) => {
    clear();
    totalSize.value = 0;
    totalSizePercent.value = 0;
};

const onSelectedFiles = (event) => {
    files.value = event.files;
    files.value.forEach((file) => {
        totalSize.value += parseInt(formatSize(file.size));
    });
};

const uploadEvent = (callback) => {
    totalSizePercent.value = totalSize.value / 10;
    callback();
};

const onTemplatedUpload = () => {
    toast.add({ severity: "info", summary: "Success", detail: "File Uploaded", life: 3000 });
};

const formatSize = (bytes) => {
    const k = 1024;
    const dm = 3;
    const sizes = $primevue.config.locale.fileSizeTypes;

    if (bytes === 0) {
        return `0 ${sizes[0]}`;
    }

    const i = Math.floor(Math.log(bytes) / Math.log(k));
    const formattedSize = parseFloat((bytes / Math.pow(k, i)).toFixed(dm));

    return `${formattedSize} ${sizes[i]}`;
};

onMounted(() => {
    Object.assign(formData, dialogRef.value.data);

    if(formData.id){
        mode.value = 'update';
    }
});
</script>

<template>
    <form @submit.prevent="submit">
        <span class="text-surface-500 dark:text-surface-400 block mb-4">Input pet details.</span>

        <div class="flex flex-col gap-1 mb-3">
            <label class="font-semibold">Pet Name</label>
            <InputText />
            <small class="form-error-message"></small>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="flex flex-col gap-1 mb-3">
                <label class="font-semibold">Type</label>

                <Select 
                    v-model="formData.type" 
                    optionLabel="type" 
                    optionValue="value"
                    :options="[{ type: 'Dog', value: 'Dog' }, { type: 'Cat', value: 'Cat' }]" 
                    checkmark :highlightOnSelect="false" 
                />

                <small class="form-error-message"></small>
            </div>

            <div class="flex flex-col gap-1 mb-3">
                <label class="font-semibold">Breed</label>

                <Select  
                    v-model="formData.breed" 
                    :options="filteredBreeds" 
                    optionLabel="breed" 
                    optionValue="value"
                    checkmark :highlightOnSelect="false" 
                />

                <small class="form-error-message"></small>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="flex flex-col gap-1 mb-3">
                <label class="font-semibold">Age <small>(In months)</small></label>

                <InputNumber v-model="formData.age" fluid showButtons buttonLayout="horizontal" :step="1">
                    <template #incrementbuttonicon>
                        <span class="pi pi-plus" />
                    </template>

                    <template #decrementbuttonicon>
                        <span class="pi pi-minus" />
                    </template>
                </InputNumber>

                <small class="form-error-message"></small>
            </div>

            <div class="flex flex-col gap-1 mb-3">
                <label class="font-semibold">Health Status</label>
                <Select 
                    v-model="formData.healthStatus" 
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
            <Textarea rows="5" cols="30" />
            <small class="form-error-message"></small>
        </div>

        <div class="mb-5">
            <FileUpload name="demo[]" url="/api/upload" @upload="onTemplatedUpload($event)" :multiple="true" accept="image/*" :maxFileSize="1000000" @select="onSelectedFiles">
                <template #header="{ chooseCallback, uploadCallback, clearCallback, files }">
                    <div class="flex flex-wrap justify-between items-center flex-1 gap-4">
                        <div class="flex gap-2">
                            <Button @click="chooseCallback()" icon="pi pi-images" rounded outlined severity="secondary"></Button>
                            <Button @click="uploadEvent(uploadCallback)" icon="pi pi-cloud-upload" rounded outlined severity="success" :disabled="!files || files.length === 0"></Button>
                            <Button @click="clearCallback()" icon="pi pi-times" rounded outlined severity="danger" :disabled="!files || files.length === 0"></Button>
                        </div>
                        <ProgressBar :value="totalSizePercent" :showValue="false" class="md:w-20rem h-1 w-full md:ml-auto">
                            <span class="whitespace-nowrap">{{ totalSize }}B / 1Mb</span>
                        </ProgressBar>
                    </div>
                </template>

                <template #content="{ files, uploadedFiles, removeUploadedFileCallback, removeFileCallback, messages }">
                    <div class="flex flex-col gap-8 pt-4">
                        <Message v-for="message of messages" :key="message" :class="{ 'mb-8': !files.length && !uploadedFiles.length}" severity="error">
                            {{ message }}
                        </Message>

                        <div v-if="files.length > 0">
                            <h5>Pending</h5>
                            
                            <div class="grid max-sm:grid-cols-1 md:grid-cols-2 gap-3">
                                <div v-for="(file, index) of files" :key="file.name + file.type + file.size" class="p-8 rounded-border flex flex-col border border-surface items-center gap-4">
                                    <div>
                                        <img role="presentation" :alt="file.name" :src="file.objectURL" width="100" height="50" />
                                    </div>
                                    <span class="font-semibold text-ellipsis max-w-60 whitespace-nowrap overflow-hidden">{{ file.name }}</span>
                                    <div>{{ formatSize(file.size) }}</div>
                                    <Badge value="Pending" severity="warn" />
                                    <Button icon="pi pi-times" @click="onRemoveTemplatingFile(file, removeFileCallback, index)" outlined rounded severity="danger" />
                                </div>
                            </div>
                        </div>

                        <div v-if="uploadedFiles.length > 0">
                            <h5>Completed</h5>
                            <div class="flex flex-wrap gap-4">
                                <div v-for="(file, index) of uploadedFiles" :key="file.name + file.type + file.size" class="p-8 rounded-border flex flex-col border border-surface items-center gap-4">
                                    <div>
                                        <img role="presentation" :alt="file.name" :src="file.objectURL" width="100" height="50" />
                                    </div>
                                    <span class="font-semibold text-ellipsis max-w-60 whitespace-nowrap overflow-hidden">{{ file.name }}</span>
                                    <div>{{ formatSize(file.size) }}</div>
                                    <Badge value="Completed" class="mt-4" severity="success" />
                                    <Button icon="pi pi-times" @click="removeUploadedFileCallback(index)" outlined rounded severity="danger" />
                                </div>
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
        </div>

        <div class="flex items-center justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="closeDialog"></Button>
            <Button type="submit" :label="(mode === 'store') ? 'Add' : 'Update'"></Button>
        </div>
    </form>
</template>