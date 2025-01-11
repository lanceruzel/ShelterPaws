<script setup>
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Button from 'primevue/button';
import Message from 'primevue/message';
import { Select } from 'primevue';
import { ref } from 'vue';
import FileUpload from 'primevue/fileupload';
import Divider from 'primevue/divider';

const cities = ref([
    { name: 'New York', code: 'NY' },
    { name: 'Rome', code: 'RM' },
    { name: 'London', code: 'LDN' },
    { name: 'Istanbul', code: 'IST' },
    { name: 'Paris', code: 'PRS' }
]);

const src = ref(null);

function onFileSelect(event) {
    const file = event.files[0];
    const reader = new FileReader();

    reader.onload = async (e) => {
        src.value = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

<template>
    <div class="py-20 bg-gray-50 min-h-[calc(100vh-300px)]">
        <div class="container mx-auto px-4 flex flex-col items-center justify-center gap-5 text-black">
            <div className="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Register Your Shelter
                </h2>
                
                <p className="mt-2 text-center text-sm text-gray-600">
                    Join our network of shelters and help more pets find loving homes
                </p>
            </div>

            <Card class="w-[500px]">
                <template #title>
                    <p class="text-2xl font-semibold">Shelter Information</p>
                </template>

                <template #subtitle>
                    <p>Please provide your shelter's details</p>
                </template>

                <template #content>
                    <Message class="mt-2" severity="success">fdsf</Message>
                    
                    <form>
                        <div class="flex flex-col gap-1 mt-3">
                            <label>Shelter Name</label>
                            <InputText type="text"/>
                            <small class="form-error-message"></small>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="flex flex-col gap-1 mt-3">
                                <label>Province</label>
                                <Select :options="cities" optionLabel="name" placeholder="Select a province" fluid />
                                <small class="form-error-message"></small>
                            </div>

                            <div class="flex flex-col gap-1 mt-3">
                                <label>City</label>
                                <Select :options="cities" optionLabel="name" placeholder="Select a city" fluid />
                                <small class="form-error-message"></small>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 mt-3">
                            <label>Barangay</label>
                            <Select :options="cities" optionLabel="name" placeholder="Select a barangay" fluid />
                            <small class="form-error-message"></small>
                        </div>

                        <div class="flex flex-col gap-1 mt-3">
                            <label>Contact</label>
                            <InputText/>
                            <small class="form-error-message"></small>
                        </div>

                        <div class="flex flex-col gap-1 mt-3">
                            <label>Email</label>
                            <InputText type="email"/>
                            <small class="form-error-message"></small>
                        </div>

                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="flex flex-col gap-1 mt-3">
                                <label>Password</label>
                                <Password toggleMask fluid />
                                <small class="form-error-message"></small>
                            </div>

                            <div class="flex flex-col gap-1 mt-3">
                                <label>Password Confirmation</label>
                                <Password toggleMask fluid />
                                <small class="form-error-message"></small>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 mt-3">
                            <label>Cover Photo</label>

                            <div class="flex flex-col items-center gap-6">
                                <FileUpload mode="basic" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                                <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(100%)" />
                            </div>
                            
                            <small class="form-error-message"></small>
                        </div>

                        <Button type="submit" label="Register" class="mt-5" fluid />
                    </form>

                    <Button class="mt-3" label="Already have an account? Sign in" link fluid as="router-link" :to="{ name: 'signin' }" />

                    <Divider align="center" class="!py-0" :pt="{ root: { class: '!my-0' } }">
                        OR
                    </Divider>

                    <Button label="Sign up as adopter instead?" link fluid as="router-link" :to="{ name: 'signup' }" />
                </template>
            </Card>
        </div>
    </div>
</template>