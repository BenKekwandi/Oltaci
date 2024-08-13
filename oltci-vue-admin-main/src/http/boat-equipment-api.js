import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getBoatEquipments = () => api.get('/api/boat_equipments', getHeaders())

export const addBoatEquipment = (boatEquipment) => api.post('/api/boat_equipment', boatEquipment, getHeaders())

export const editBoatEquipment = (boatEquipment, id) => api.post(`/api/boat_equipment/${id}`, boatEquipment, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteBoatEquipment = (id) => api.delete(`/api/boat_equipment/${id}`, getHeaders())