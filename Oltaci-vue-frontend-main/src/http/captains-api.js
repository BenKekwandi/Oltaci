import api from "./axios.js"

export const getCaptains = () => api.get('/api/captain')