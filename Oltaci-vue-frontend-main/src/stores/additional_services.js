import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getAdditionalServices } from '../http/additional_services-api'


export const useAdditionalServiceStore = defineStore('additionalServiceStore', () => {
    const additionalServices = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchAdditionalServices = async () => {

        try {
            const { data } = await getAdditionalServices();
            additionalServices.value = data.data;
            loading.value = false
        } catch (error) {
            additionalServices  .value = null;
            loading.value = false
        }
    }

    return { additionalServices, loading, response, fetchAdditionalServices, }

})
