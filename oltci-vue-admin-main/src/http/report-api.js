import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getReport = () => api.get('/api/report', getHeaders())

export const getGeneralReport = () => api.get('/api/general-report', getHeaders())
