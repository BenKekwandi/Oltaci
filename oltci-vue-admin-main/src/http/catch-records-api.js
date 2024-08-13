import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getCatchRecords = () => api.get('/api/catch_records', getHeaders())

export const addCatchRecord = (catchRecord) => api.post('/api/catch_record', catchRecord, getHeaders())

export const editCatchRecord = (catchRecord, id) => api.post(`/api/catch_record/${id}`, catchRecord, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteCatchRecord = (id) => api.delete(`/api/catch_record/${id}`, getHeaders())