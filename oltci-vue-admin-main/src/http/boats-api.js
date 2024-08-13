import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getBoats = () => api.get('/api/boats', getHeaders())

export const addBoat = (boat) => api.post('/api/boat', boat, getHeaders())

export const editBoat = (boat, id) => api.post(`/api/boat/${id}`, boat, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteBoat = (id) => api.delete(`/api/boat/${id}`, getHeaders())