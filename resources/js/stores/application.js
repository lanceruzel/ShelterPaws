import axios from "axios";
import { defineStore } from 'pinia';

export const useApplicationStore = defineStore('petApplication', {
    state: () => {
        return {
            applications: {},
            errors: {},
            isFormLoading: false,
            isDeleteLoading: false,

        }
    },
    getters: {

    },
    actions: {
        async getUserApplications(){
            try{
                if(localStorage.getItem('token')){
                    const response = await axios.get('/api/application', {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`
                        }
                    });

                    if(response.status === 200){
                        //Get applications
                        this.applications = Object.values(response.data);

                        if(this.applications){
                            //Check images format and convert if it is in string format
                            this.applications.forEach((item) => {

                                //Check if images is in string format
                                if(typeof item.pet.images === 'string'){
                                    
                                    //Convert string array into array
                                    item.pet.images = JSON.parse(item.pet.images);
                                }
                            });
                        }
                    }
                }
            }catch (error){
                console.log('Inside Axios get applications:');
                console.error(error);
            }
        },
        async saveApplication(action, id = null, formData){
            this.isFormLoading = true;

            try{
                const url = (action === 'update' && id) ? `/api/application/${id}?_method=PUT` : '/api/application';
        
                const response = await axios.post(url, formData, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                    },
                });
        
                if(response.status === 200){
                    const data = response.data;
        
                    if(data){
                        // Get message
                        const message = data.message;
        
                        this.toast.add({
                            severity: 'success',
                            summary: 'Adoption Application',
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
        
                console.log('Inside Axios save application:');
                console.error(error);
            }finally{
                this.isFormLoading = false;
            }
        }
    }
});
