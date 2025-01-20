<script setup>
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Button from 'primevue/button';
import InputMask from 'primevue/inputmask';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import { Select } from 'primevue';
import { onMounted, reactive, ref, watch } from 'vue';
import FileUpload from 'primevue/fileupload';
import Divider from 'primevue/divider';
import { useAuthStore } from '../stores/auth';
import { storeToRefs } from 'pinia';
import Textarea from 'primevue/textarea';

const authStore = useAuthStore();
const { authenticate } = authStore;
const { errors } = storeToRefs(authStore);

const src = ref(null);

let geoData = ref();
let provinces = ref([]);
let cities = ref([]);
let barangay = ref([]);

const formData = reactive({
    name: '',
    contact: '',
    province: '',
    city: '',
    barangay: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'shelter',
    cover_photo: null,
    description: ''
});

function onFileSelect(event) {
    const file = event.files[0];
    formData.cover_photo = file;
    const reader = new FileReader();

    reader.readAsDataURL(file);

    reader.onload = async (e) => {
        src.value = e.target.result;
    };
}

async function loadData() {
    try{
        const response = await axios.get('/data/philippines.json');

        if(response.status === 200){
            geoData.value = response.data;
        }
    }catch(error){
        console.error('Error fetching data:', error);
    }
}

// Provinces
watch(geoData, (updatedData) => {
    if(updatedData){
        provinces.value = Object.keys(updatedData).map((provinceName) => {
            return provinceName;
        });

        provinces.value.sort()
    }
});

//Cities
watch(() => formData.province, (selectedProvince) => {
    if(selectedProvince && geoData.value){
        const citiesInProvince = geoData.value[selectedProvince];

        if(citiesInProvince){
            cities.value = Object.keys(citiesInProvince).map(cityName => cityName);
            provinces.value.sort()
        }else{
            cities.value = [];
        }
    }
});

//Barangays
watch(() => formData.city, (selectedCity) => {
    if(selectedCity && geoData.value){
        const barangaysInCity = geoData.value[formData.province][selectedCity];

        if(barangaysInCity){
            barangay.value = barangaysInCity.map(barangayName => barangayName);
            barangay.value.sort()
        }else{
            barangay.value = [];
        }
    }
});

onMounted(() => {
    loadData();
    errors.value = {};
});
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
                    <form @submit.prevent="authenticate('register', formData)">
                        <div class="flex flex-col gap-1 mt-3">
                            <label>Shelter Name</label>
                            <InputText v-model="formData.name" :invalid="errors.name" type="text"/>
                            <small class="form-error-message" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>

                        <div class="flex flex-col gap-1 mt-3">
                            <label class="font-semibold">Description</label>
                            <Textarea v-model="formData.description" :invalid="errors.description" rows="5" cols="30" />
                            <small class="form-error-message" v-if="errors.description">{{ errors.description[0] }}</small>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="flex flex-col gap-1 mt-3">
                                <label>Province</label>
                                <Select v-model="formData.province" :invalid="errors.province" filter :options="provinces" placeholder="Select a province" fluid  />
                                <small class="form-error-message" v-if="errors.province">{{ errors.province[0] }}</small>
                            </div>

                            <div class="flex flex-col gap-1 mt-3">
                                <label>City</label>
                                <Select v-model="formData.city" :invalid="errors.city" filter :options="cities" placeholder="Select a city" fluid />
                                <small class="form-error-message" v-if="errors.city">{{ errors.city[0] }}</small>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 mt-3">
                            <label>Barangay</label>
                            <Select v-model="formData.barangay" :invalid="errors.barangay" filter :options="barangay" placeholder="Select a barangay" fluid />
                            <small class="form-error-message" v-if="errors.barangay">{{ errors.barangay[0] }}</small>
                        </div>

                        <div class="flex flex-col gap-1 mt-3">
                            <label>Contact</label>
                            <InputGroup>
                                <InputGroupAddon>+63</InputGroupAddon>
                                <InputMask mask="999-9999-999" placeholder="999-9999-999" v-model="formData.contact" :invalid="errors.contact" />
                            </InputGroup>
                            <small class="form-error-message" v-if="errors.contact">{{ errors.contact[0] }}</small>
                        </div>

                        <div class="flex flex-col gap-1 mt-3">
                            <label>Email</label>
                            <InputText v-model="formData.email" :invalid="errors.email" type="email"/>
                            <small class="form-error-message" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>

                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="flex flex-col gap-1 mt-3">
                                <label>Password</label>
                                <Password v-model="formData.password" :invalid="errors.password" toggleMask fluid />
                                <small class="form-error-message" v-if="errors.password">{{ errors.password[0] }}</small>
                            </div>

                            <div class="flex flex-col gap-1 mt-3">
                                <label>Password Confirmation</label>
                                <Password v-model="formData.password_confirmation" :invalid="errors.password_confirmation" toggleMask fluid />
                                <small class="form-error-message" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>
                            </div>
                        </div>

                        <div class="flex flex-col items-center gap-1 mt-3 ">
                            <label>Cover Photo</label>

                            <div class="flex flex-col items-center gap-6">
                                <FileUpload mode="basic" @select="onFileSelect" accept="image/*" customUpload auto severity="secondary" class="p-button-outlined" />
                                <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" />
                                <small class="form-error-message" v-if="errors.cover_photo">{{ errors.cover_photo[0] }}</small>
                            </div>
                        </div>

                        <Button type="submit" label="Register" class="mt-5" fluid :loading="authStore.isFormLoading" />
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