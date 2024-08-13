import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getTours, filterTours, getTour } from '../http/tours-api'


export const useTourStore = defineStore('tourStore', () => {
    const tours = ref([])
    const tour = ref({})
    const loading = ref(false)
    const response = ref(null)
    const filterData = ref(null)

    const fetchTours = async () => {

        try {
            const { data } = await getTours();
            tours.value = data.data;

        } catch (error) {
            tours.value = null;
        }
    }

    const fetchTour = async (id) => {

        try {
            const { data } = await getTour(id);
            tour.value = data.data;
        } catch (error) {
            tour.value = null;
        }
    }

    const handleFilteredTours = async (searchData) => {

        try {
            loading.value = true
            const { data } = await filterTours(searchData);
            tours.value = data
            loading.value = false

        } catch (error) {
            loading.value = false
            tours.value = null;
        }
    }


    return { tour, tours, response, loading, filterData, fetchTours, fetchTour, handleFilteredTours }


}, {
    persist: true
})
