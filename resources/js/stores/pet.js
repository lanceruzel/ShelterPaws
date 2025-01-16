import axios from "axios";
import { defineStore } from 'pinia';

export const usePetStore = defineStore('petStore', {
    state: () => {
        return {
            pets: {},
            errors: {},
            isFormLoading: false,
            isDeleteLoading: false,

        }
    },
    getters: {

    },
    actions: {
        async getAllPetListing(){
            try{
                const response = await axios.get('/api/pet/all');

                if(response.status === 200){
                    //Get pets
                    this.pets = Object.values(response.data);
                    
                    if(this.pets){
                        //Check images format and convert if it is in string format
                        this.pets.forEach((item) => {
                            //Check if images is in string format
                            if(typeof item.images === 'string'){

                                //Convert string array into array
                                item.images = JSON.parse(item.images);
                            }
                        });
                    }
                }
            }catch (error){
                console.log('Inside Axios get all pet listing:');
                console.error(error);
            }
        },
        async getUserListing(){
            try{
                if(localStorage.getItem('token')){
                    const response = await axios.get('/api/pet', {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    });

                    if(response.status === 200){
                        //Get pets
                        this.pets = Object.values(response.data);
                        
                        if(this.pets){
                            //Check images format and convert if it is in string format
                            this.pets.forEach((item) => {
                                //Check if images is in string format
                                if(typeof item.images === 'string'){

                                    //Convert string array into array
                                    item.images = JSON.parse(item.images);
                                }
                            });
                        }
                    }
                }
            }catch (error){
                console.log('Inside Axios get pets:');
                console.error(error);
            }
        },
        async getPet(id){
            if(localStorage.getItem('token')){
                try{
                    const response = await axios.get(`/api/pet/${id}`);

                    if(response.status === 200){
                        this.errors = {};

                        const pet = response.data;

                        if(pet){
                            pet.images = JSON.parse(pet.images);
                        }

                        //Pass data
                        return pet;
                    }
                }catch(error){
                    console.log('Inside Axios getPet:');
                    console.error(error);  
                }
            }
        },
        async savePet(action, id = null, formData){
            this.isFormLoading = true;

            try{
                const url = (action === 'update' && id) ? `/api/pet/${id}?_method=PUT` : '/api/pet';
        
                const response = await axios.post(url, formData, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                        'Content-Type': 'multipart/form-data',
                    },
                });
        
                if(response.status === 200){
                    const data = response.data;
        
                    if(data){
                        // Get message
                        const message = data.message;
        
                        this.toast.add({
                            severity: 'success',
                            summary: 'Pet Listing',
                            detail: message.detail,
                            life: 3000,
                        });
        
                        return true;
                    }
                }
            }catch (error){
                // Get form input errors
                if(error.response && error.response.data.errors){
                    this.errors = error.response.data.errors;
                }
        
                console.log('Inside Axios savePet:');
                console.error(error);
            }finally{
                this.isFormLoading = false;
            }
        }
    }
});
