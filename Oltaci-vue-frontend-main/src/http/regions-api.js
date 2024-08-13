import api from "./axios.js"

export const getRegions = () => api.get('/api/region')
