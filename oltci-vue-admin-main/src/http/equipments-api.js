import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getEquipments = () => api.get('/api/equipments', getHeaders())

export const addEquipment = (equipment) => api.post('/api/equipment', equipment, getHeaders())

export const editEquipment = (equipment, id) => api.post(`/api/equipment/${id}`, equipment, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteEquipment = (id) => api.delete(`/api/equipment/${id}`, getHeaders())