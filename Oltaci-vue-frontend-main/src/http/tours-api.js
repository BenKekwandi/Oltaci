import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getTours = () => api.get('/api/tour',)

export const getTour = (id) => api.get(`/api/tour/${id}`)

export const filterTours = (data) => api.post('/api/tours-filter', data)
