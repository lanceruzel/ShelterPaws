import axios from "axios";
import { defineStore } from "pinia";

export const useShelterStore = defineStore('authShelter', {
    state: () => {
        return {
            shelters: null,
            errors: {},
            message: '',
            isFormLoading: false
        };
    },
    getters: {
        address: (state) => {
            return `${state.user.user_profile.province}, ${state.user.user_profile.city}, ${state.user.user_profile.barangay}`;
        }
    },
    actions: {
        async getShelters(){
            try{
                const response = await axios.get('/api/shelter');

                if(response.status === 200){
                    //Get pets
                    this.shelters = Object.values(response.data);
                }
            }catch (error){
                console.log('Inside Axios get all pet listing:');
                console.error(error);
            }
        },
        async getShelter(id){
            if(localStorage.getItem('token')){
                try{
                    const response = await axios.get(`/api/shelter/${id}`);

                    if(response.status === 200){
                        this.errors = {};

                        const user = response.data;

                        if(user.user_profile.pets){
                            //Check images format and convert if it is in string format
                            user.user_profile.pets.forEach((item) => {
                                //Check if images is in string format
                                if(typeof item.images === 'string'){
    
                                    //Convert string array into array
                                    item.images = JSON.parse(item.images);
                                }
                            });
                        }

                        //Pass data
                        return user;
                    }
                }catch(error){
                    console.log('Inside Axios getPet:');
                    console.error(error);  
                }
            }
        },
        async saveShelter(){

        }
    },
});