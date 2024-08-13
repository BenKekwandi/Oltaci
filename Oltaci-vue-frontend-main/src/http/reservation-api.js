import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const addReservation = (reservation) => api.post('/api/reservation', reservation)

export const getReservations = () => api.get('/api/reservations', getHeaders())

