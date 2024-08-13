import api from "./axios.js"

export const getWeather = () => api.get('api/weather')

