import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getBoatFuelings = () => api.get('/api/boat_fuelings', getHeaders())

export const addBoatFueling = (boatFueling) => api.post('/api/boat_fueling', boatFueling, getHeaders())

export const editBoatFueling = (boatFueling, id) => api.post(`/api/boat_fueling/${id}`, boatFueling, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteBoatFueling = (id) => api.delete(`/api/boat_fueling/${id}`, getHeaders())