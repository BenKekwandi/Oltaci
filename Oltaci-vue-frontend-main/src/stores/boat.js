import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getBoat } from '../http/boat-api'


export const useBoatStore = defineStore('boatStore', () => {
    const boat = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchBoat = async (id) => {

        try {
            const { data } = await getBoat(id);
            boat.value = data.data;
            loading.value = false
        } catch (error) {
            boat.value = null;
            loading.value = false
        }
    }

    return { boat, loading, response, fetchBoat, }

})
