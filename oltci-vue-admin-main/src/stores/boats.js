import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getBoats, addBoat, editBoat, deleteBoat } from '../http/boats-api'


export const useBoatStore = defineStore('boatStore', () => {
    const boats = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchBoats = async () => {

        try {
            const { data } = await getBoats();
            boats.value = data.data;

        } catch (error) {
            boats.value = null;
        }
    }

    const handleAddedBoat = async (boat) => {
        try {
            loading.value = true
            response.value = await addBoat(boat)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedBoat = async (boat, id) => {
        try {
            loading.value = true
            response.value = await editBoat(boat, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedBoat = async (id) => {
        try {
            loading.value = true
            response.value = await deleteBoat(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { boats, loading, response, fetchBoats, handleAddedBoat, handleUpdatedBoat, handleDeletedBoat }

})
