import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getBoatLogs = () => api.get('/api/boat_logs', getHeaders())

export const addBoatLog = (boatLog) => api.post('/api/boat_log', boatLog, getHeaders())

export const editBoatLog = (boatLog, id) => api.post(`/api/boat_log/${id}`, boatLog, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteBoatLog = (id) => api.delete(`/api/boat_log/${id}`, getHeaders())