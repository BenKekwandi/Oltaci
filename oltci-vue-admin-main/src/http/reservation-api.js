import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getReservation = () => api.get('/api/reservation', getHeaders())