import api from "./axios.js"

export const getAdditionalServices = () => api.get('/api/additional-services')