import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getRegions, addRegion, editRegion, deleteRegion } from '../http/regions-api'


export const useRegionStore = defineStore('regionStore', () => {
    const regions = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchRegions = async () => {

        try {
            const { data } = await getRegions();
            regions.value = data.data;

        } catch (error) {
            regions.value = null;
        }
    }

    const handleAddedRegion = async (boat) => {
        try {
            loading.value = true
            response.value = await addRegion(boat)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedRegion = async (region, id) => {
        try {
            loading.value = true
            response.value = await editRegion(region, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedRegion = async (id) => {
        try {
            loading.value = true
            response.value = await deleteRegion(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { regions, loading, response, fetchRegions, handleAddedRegion, handleUpdatedRegion, handleDeletedRegion }

})
