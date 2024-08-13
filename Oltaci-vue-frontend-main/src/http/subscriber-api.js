import api from "./axios.js"

export const addSubscriber = (subscriber) => api.post(`/api/subscriber`, subscriber)