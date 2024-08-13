import api from "./axios.js"

export const getBoat = (id) => api.get(`/api/boat/${id}`)