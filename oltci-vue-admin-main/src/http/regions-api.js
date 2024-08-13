import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getRegions = () => api.get('/api/region', getHeaders())

export const addRegion = (region) => api.post('/api/region', region, getHeaders())

export const editRegion = (region, id) => api.put(`/api/region/${id}`, region, getHeaders())

export const deleteRegion = (id) => api.delete(`/api/region/${id}`, getHeaders())