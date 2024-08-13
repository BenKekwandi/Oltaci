
import api from "./axios.js"

export const getUser = (token) => api.get('/api/me', {
    headers: {
        'Authorization': `Bearer ${token}`
    }
})

export const login = ($credentials) => api.post('/api/admin/login', $credentials)

export const logout = () => api.get('/api/logout', {
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
}) 