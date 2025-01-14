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
        async getPet(id){
            if(localStorage.getItem('token')){
                try{
                    const response = await axios.get(`/api/pet/${id}`);

                    if(response.status === 200){
                        this.errors = {};

                        //Pass data
                        return response.data;
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
                const url = (action === 'update') ? `/api/pet/${id}` : '/api/pet';
                const method = (action === 'update') ? 'put' : 'post';
        
                const response = await axios({
                    method,
                    url,
                    data: formData,
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
