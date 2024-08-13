import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getTrips = () => api.get('/api/trips', getHeaders())

export const addTrip = (trip) => api.post('/api/trip', trip, getHeaders())

export const editTrip = (trip, id) => api.post(`/api/trip/${id}`, trip, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteTrip = (id) => api.delete(`/api/trip/${id}`, getHeaders())