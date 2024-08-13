import { ref } from 'vue';
import { defineStore } from 'pinia';
import { addReservation , getReservations} from '../http/reservation-api';

export const useReservationStore = defineStore('reservationStore', () => {
    const reservationData = ref({
        tour_id: '',
        user_id: '',
        number_of_people: '',
        departure_date: '',
        retrun_date: '',
        image: '',
        total: '',
        departure_place: '',
        with_captain: false
    });

    const reservations = ref([]);
    const memberReservations = ref([]);
    const errors = ref(null);
    const loading = ref(false);
    const response = ref(null);

    const fetchMemberReservations = async (user_id) => {
        try {
            const { data } = await getReservations();
            console.log('data1', data)
            var d = [];
            data.data.forEach(function(item, index){
                if(item.user.id ==user_id){
                    d.push(item)
                }   
            })
            console.log('data', d)
            memberReservations.value = d;

        } catch (error) {
            memberReservations.value = null;
        }
    }
    

    const fetchReservations = async () => {

        try {
            const { data } = await getReservations();
            reservations.value = data.data;

        } catch (error) {
            reservations.value = null;
        }
    }


    const handleAddReservation = async () => {
        try {
            loading.value = true;
            response.value = await addReservation(reservationData.value);
            loading.value = false;
        } catch (error) {
            loading.value = false;
            response.value = error?.response;
            errors.value = error?.response?.data;
        }
    };

    return {
        reservationData,
        reservations,
        fetchReservations,
        memberReservations,
        fetchMemberReservations,
        errors,
        loading,
        response,
        handleAddReservation
    };
}, {
    persist: true
});
