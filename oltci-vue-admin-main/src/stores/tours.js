import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getTours, addTour, editTour, deleteTour } from '../http/tours-api'


export const useTourStore = defineStore('tourStore', () => {
    const tours = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchTours = async () => {

        try {
            const { data } = await getTours();
            tours.value = data.data;

        } catch (error) {
            tours.value = null;
        }
    }

    const handleAddedTour = async (tour) => {
        try {
            loading.value = true
            response.value = await addTour(tour)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedTour = async (tour, id) => {
        try {
            loading.value = true
            response.value = await editTour(tour, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedTour = async (id) => {
        try {
            loading.value = true
            response.value = await deleteTour(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { tours, response, loading, fetchTours, handleAddedTour, handleUpdatedTour, handleDeletedTour }

})
