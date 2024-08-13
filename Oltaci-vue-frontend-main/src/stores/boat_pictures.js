import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getBoatPictures } from '../http/boat-pictures-api'


export const useBoatPictureStore = defineStore('boatPictureStore', () => {
    const pictures = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchBoatPictures = async (boatId) => {

        try {
            const { data } = await getBoatPictures(boatId);
            pictures.value = data.data;
            loading.value = false
        } catch (error) {
            pictures.value = null;
            loading.value = false
        }
    }

    return { pictures, loading, response, fetchBoatPictures }

})
