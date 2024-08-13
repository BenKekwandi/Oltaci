import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getTrips } from '../http/trips-api'


export const useTripStore = defineStore('tripStore', () => {
    const trips = ref([])
    const memberTrips = ref([])
    const loading = ref(false)
    const response = ref(null)



    const fetchMemberTrips = async (user_id) => {
        try {
            const { data } = await getTrips();
            var d = [];
            data.data.forEach(function(item, index){
                if(item.user.id==user_id){
                    d.push(item)
                }   
            })
            memberTrips.value = d;

        } catch (error) {
            memberTrips.value = null;
        }
    }

    return { trips, memberTrips, response, loading, fetchMemberTrips }

})
