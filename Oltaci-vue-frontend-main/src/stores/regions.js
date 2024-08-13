import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getRegions } from '../http/regions-api'


export const useRegionStore = defineStore('regionStore', () => {
    const collection = ref([])
    const regions = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchRegions = async () => {

        try {
            const { data } = await getRegions();
            regions.value = data.data;
            collection.value = data.data

        } catch (error) {
            regions.value = null;
        }
    }



    return { collection, regions, loading, response, fetchRegions }

})
