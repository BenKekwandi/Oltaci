import api from "./axios.js"

export const getBoats = () => api.get('/api/boat')