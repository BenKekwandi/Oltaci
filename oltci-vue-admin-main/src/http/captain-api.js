import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getCaptains = () => api.get('/api/captains', getHeaders())

export const addCaptain = (captain) => api.post('/api/captain', captain, getHeaders())

export const editCaptain = (captain, id) => api.post(`/api/captain/${id}`, captain, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteCaptain = (id) => api.delete(`/api/captain/${id}`, getHeaders())