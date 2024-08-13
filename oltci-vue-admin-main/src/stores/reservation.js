import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getReservation } from '../http/reservation-api'


export const useReservationStore = defineStore('reservationStore', () => {
    const reservations = ref([])
    const errors = ref(null)
    const loading = ref(false)
    const response = ref(null)

    const fetchReservations = async () => {

        try {
            const { data } = await getReservation();
            reservations.value = data.data;

        } catch (error) {
            reservations.value = null;
        }
    }

    // const handleAddedUser = async (user) => {
    //     try {
    //         loading.value = true
    //         await addUser(user)
    //         loading.value = false
    //     } catch (error) {
    //         loading.value = false
    //         errors.value = error.response?.data?.message || 'Something went wrong'
    //     }
    // }



    return { reservations, errors, loading, fetchReservations }

})
