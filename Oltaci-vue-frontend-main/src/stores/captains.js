import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getCaptains, } from '../http/captains-api'


export const useCaptainStore = defineStore('CaptainStore', () => {
    const captains = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchCaptains = async () => {

        try {
            const { data } = await getCaptains();
            captains.value = data.data;
            loading.value = false
        } catch (error) {
            captains.value = null;
            loading.value = false
        }
    }

    return { captains, loading, response, fetchCaptains, }

})
