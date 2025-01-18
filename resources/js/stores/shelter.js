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
        async getShelter(){

        },
        async saveShelter(){

        }
    },
});