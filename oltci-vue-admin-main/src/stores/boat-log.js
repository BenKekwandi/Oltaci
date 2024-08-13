import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getBoatLogs, addBoatLog, editBoatLog, deleteBoatLog } from '../http/boat-log-api'


export const useBoatLogStore = defineStore('boatLogStore', () => {
    const boatLogs = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchBoatLogs = async () => {

        try {
            const { data } = await getBoatLogs();
            boatLogs.value = data.data;

        } catch (error) {
            boatLogs.value = null;
        }
    }

    const handleAddedBoatLog = async (boatLog) => {
        try {
            loading.value = true
            response.value = await addBoatLog(boatLog)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedBoatLog = async (boatLog, id) => {
        try {
            loading.value = true
            response.value = await editBoatLog(boatLog, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedBoatLog = async (id) => {
        try {
            loading.value = true
            response.value = await deleteBoatLog(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { boatLogs, response, loading, fetchBoatLogs, handleAddedBoatLog, handleUpdatedBoatLog, handleDeletedBoatLog }

})
