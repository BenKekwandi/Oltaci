import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getBoats, } from '../http/boats-api'


export const useBoatStore = defineStore('boatStore', () => {
    const boats = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchBoats = async () => {

        try {
            const { data } = await getBoats();
            boats.value = data.data;
            loading.value = false
        } catch (error) {
            boats.value = null;
            loading.value = false
        }
    }

    return { boats, loading, response, fetchBoats, }

})
