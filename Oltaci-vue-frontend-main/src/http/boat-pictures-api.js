import api from "./axios.js"

export const getBoatPictures = (boatId) => api.get(`/api/boat-pictures/${boatId}`)