import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getEquipments, addEquipment, editEquipment, deleteEquipment } from '../http/equipments-api'


export const useEquipmentStore = defineStore('EquipmentStore', () => {
    const equipments = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchEquipments = async () => {

        try {
            const { data } = await getEquipments();
            equipments.value = data.data;

        } catch (error) {
            equipments.value = null;
        }
    }

    const handleAddedEquipment = async (equipment) => {
        try {
            loading.value = true
            response.value = await addEquipment(equipment)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedEquipment = async (equipment, id) => {
        try {
            loading.value = true
            response.value = await editEquipment(equipment, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedEquipment = async (id) => {
        try {
            loading.value = true
            response.value = await deleteEquipment(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { equipments, response, loading, fetchEquipments, handleAddedEquipment, handleUpdatedEquipment, handleDeletedEquipment }

})
