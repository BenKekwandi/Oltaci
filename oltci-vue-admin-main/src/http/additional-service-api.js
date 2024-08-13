import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getServices= () => api.get('/api/additional_service', getHeaders())

export const addService = (boat) => api.post('/api/additional_service', boat, getHeaders())

export const editService = (boat, id) => api.put(`/api/additional_service/${id}`, boat, getHeaders())

export const deleteService = (id) => api.delete(`/api/additional_service/${id}`, getHeaders())