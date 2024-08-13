import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getSubscribers = () => api.get('/api/subscribers', getHeaders())

export const addSubscriber = (subscriber) => api.post('/api/subscriber', subscriber, getHeaders())

export const editSubscriber = (subscriber, id) => api.post(`/api/subscriber/${id}`, subscriber, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteSubscriber = (id) => api.delete(`/api/subscriber/${id}`, getHeaders())