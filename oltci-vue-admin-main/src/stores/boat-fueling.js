import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getBoatFuelings, addBoatFueling, editBoatFueling, deleteBoatFueling } from '../http/boat-fueling-api'


export const useBoatFuelingStore = defineStore('boatFuelingStore', () => {
    const boatFuelings = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchBoatFuelings = async () => {

        try {
            const { data } = await getBoatFuelings();
            boatFuelings.value = data.data;

        } catch (error) {
            boatFuelings.value = null;
        }
    }

    const handleAddedBoatFueling = async (boatFueling) => {
        try {
            loading.value = true
            response.value = await addBoatFueling(boatFueling)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedBoatFueling = async (boatFueling, id) => {
        try {
            loading.value = true
            response.value = await editBoatFueling(boatFueling, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedBoatFueling = async (id) => {
        try {
            loading.value = true
            response.value = await deleteBoatFueling(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { boatFuelings, response, loading, fetchBoatFuelings, handleAddedBoatFueling, handleUpdatedBoatFueling, handleDeletedBoatFueling }

})
