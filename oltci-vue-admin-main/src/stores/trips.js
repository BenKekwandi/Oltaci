import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getTrips, addTrip, editTrip, deleteTrip } from '../http/trips-api'


export const useTripStore = defineStore('tripStore', () => {
    const trips = ref([])
    const ongoingTrips = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchTrips = async () => {

        try {
            const { data } = await getTrips();
            trips.value = data.data;

        } catch (error) {
            trips.value = null;
        }
    }

    const fetchOngoingTrips = async () => {

        try {
            const { data } = await getTrips();
            var d = [];
            data.data.forEach(function(item, index){
                if(item.status == 'ONGOING'){
                    d.push(item)
                }   
            })
            ongoingTrips.value = d;

        } catch (error) {
            ongoingTrips.value = null;
        }
    }

    const handleAddedTrip = async (trip) => {
        try {
            loading.value = true
            response.value = await addTrip(trip)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedTrip = async (trip, id) => {
        try {
            loading.value = true
            response.value = await editTrip(trip, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedTrip = async (id) => {
        try {
            loading.value = true
            response.value = await deleteTrip(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    return { trips, ongoingTrips, response, loading, fetchTrips,fetchOngoingTrips, handleAddedTrip, handleUpdatedTrip, handleDeletedTrip }

})
