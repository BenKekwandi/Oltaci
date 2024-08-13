import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getServices, addService, editService, deleteService } from '../http/additional-service-api'


export const useServiceStore = defineStore('serviceStore', () => {
    const services = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchServices = async () => {

        try {
            const { data } = await getServices();
            services.value = data.data;

        } catch (error) {
            services.value = null;
        }
    }

    const handleAddedService = async (service) => {
        try {
            loading.value = true
            response.value = await addService(service)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedService = async (service, id) => {
        try {
            loading.value = true
            response.value = await editService(service, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedService = async (id) => {
        try {
            loading.value = true
            response.value = await deleteService(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { services, loading, response, fetchServices, handleAddedService, handleUpdatedService, handleDeletedService }

})
