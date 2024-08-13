import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getUsers = () => api.get('/api/user', getHeaders())

export const addUser = (user) => api.post('/api/user', user, getHeaders())

export const editUser = (user, id) => api.put(`/api/user/${id}`, user, getHeaders())

export const deleteUser = (id) => api.delete(`/api/user/${id}`, getHeaders())