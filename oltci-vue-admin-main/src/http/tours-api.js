import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getTours = () => api.get('/api/tours', getHeaders())

export const addTour = (tour) => api.post('/api/tour', tour, getHeaders())

export const editTour = (tour, id) => api.put(`/api/tour/${id}`, tour, getHeaders())

export const deleteTour = (id) => api.delete(`/api/tour/${id}`, getHeaders())