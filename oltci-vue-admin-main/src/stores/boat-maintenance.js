import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getBoatMaintenances, addBoatMaintenance, editBoatMaintenance, deleteBoatMaintenance } from '../http/boat-maintenance-api'


export const useBoatMaintenanceStore = defineStore('boatMaintenanceStore', () => {
    const boatMaintenances = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchBoatMaintenances = async () => {

        try {
            const { data } = await getBoatMaintenances();
            boatMaintenances.value = data.data;

        } catch (error) {
            boatMaintenances.value = null;
        }
    }

    const handleAddedBoatMaintenance = async (boatMaintenance) => {
        try {
            loading.value = true
            response.value = await addBoatMaintenance(boatMaintenance)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedBoatMaintenance = async (boatMaintenance, id) => {
        try {
            loading.value = true
            response.value = await editBoatMaintenance(boatMaintenance, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedBoatMaintenance = async (id) => {
        try {
            loading.value = true
            response.value = await deleteBoatMaintenance(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { boatMaintenances, response, loading, fetchBoatMaintenances, handleAddedBoatMaintenance, handleUpdatedBoatMaintenance, handleDeletedBoatMaintenance }

})
