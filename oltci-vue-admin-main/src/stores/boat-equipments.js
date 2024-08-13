import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getBoatEquipments, addBoatEquipment, editBoatEquipment, deleteBoatEquipment } from '../http/boat-equipment-api'


export const useBoatEquipmentStore = defineStore('boatEquipmentStore', () => {
    const boatEquipments = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchBoatEquipments = async () => {

        try {
            const { data } = await getBoatEquipments();
            boatEquipments.value = data.data;

        } catch (error) {
            boatEquipments.value = null;
        }
    }

    const handleAddedBoatEquipment = async (boatEquipment) => {
        try {
            loading.value = true
            response.value = await addBoatEquipment(boatEquipment)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedBoatEquipment = async (boatEquipment, id) => {
        try {
            loading.value = true
            response.value = await editBoatEquipment(boatEquipment, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedBoatEquipment = async (id) => {
        try {
            loading.value = true
            response.value = await deleteBoatEquipment(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { BoatEquipments, response, loading, fetchBoatEquipments, handleAddedBoatEquipment, handleUpdatedBoatEquipment, handleDeletedBoatEquipment }

})
