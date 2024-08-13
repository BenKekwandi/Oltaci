import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getCaptains, addCaptain, editCaptain, deleteCaptain } from '../http/captain-api'


export const useCaptainStore = defineStore('captainStore', () => {
    const captains = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchCaptains = async () => {

        try {
            const { data } = await getCaptains();
            captains.value = data.data;

        } catch (error) {
            captains.value = null;
        }
    }

    const handleAddedCaptain = async (captain) => {
        try {
            loading.value = true
            response.value = await addCaptain(captain)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedCaptain = async (captain, id) => {
        try {
            loading.value = true
            response.value = await editCaptain(captain, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedCaptian = async (id) => {
        try {
            loading.value = true
            response.value = await deleteCaptain(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { captains, response, loading, fetchCaptains, handleAddedCaptain, handleUpdatedCaptain, handleDeletedCaptian }

})
