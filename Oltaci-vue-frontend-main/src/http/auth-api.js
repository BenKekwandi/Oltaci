import api from "../http/axios"

// User auth and related actions


export const csrfCookie = () => api.get('/sanctum/csrf-cookie')

export const getUser = () => api.get('/api/auth-user')

export const geteExternalUser = (token) => api.get('/api/me', {
    headers: {
        'Authorization': `Bearer ${token}`
    }
})

export const login = ($credentials) => api.post('api/login', $credentials)

export const register = ($credentials) => api.post('api/member/register', $credentials)

export const logout = () => api.get('/api/logout', {
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})  