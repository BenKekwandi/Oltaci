import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getBoatMaintenances = () => api.get('/api/boat_maintenances', getHeaders())

export const addBoatMaintenance = (boatMaintenance) => api.post('/api/boat_maintenance', boatMaintenance, getHeaders())

export const editBoatMaintenance = (boatMaintenance, id) => api.post(`/api/boat_maintenance/${id}`, boatMaintenance, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteBoatMaintenance = (id) => api.delete(`/api/boat_maintenance/${id}`, getHeaders())