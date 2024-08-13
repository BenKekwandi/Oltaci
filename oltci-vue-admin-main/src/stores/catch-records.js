import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getCatchRecords, addCatchRecord, editCatchRecord, deleteCatchRecord } from '../http/catch-records-api'


export const useCatchRecordStore = defineStore('CatchRecordStore', () => {
    const catchRecords = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchCatchRecords = async () => {

        try {
            const { data } = await getCatchRecords();
            catchRecords.value = data.data;

        } catch (error) {
            catchRecords.value = null;
        }
    }

    const handleAddedCatchRecord = async (catchRecord) => {
        try {
            loading.value = true
            response.value = await addCatchRecord(catchRecord)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedCatchRecord = async (catchRecord, id) => {
        try {
            loading.value = true
            response.value = await editCatchRecord(catchRecord, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedCatchRecord = async (id) => {
        try {
            loading.value = true
            response.value = await deleteCatchRecord(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { catchRecords, response, loading, fetchCatchRecords, handleAddedCatchRecord, handleUpdatedCatchRecord, handleDeletedCatchRecord }

})
