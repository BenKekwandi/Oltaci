import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getPosts = () => api.get('/api/posts', getHeaders())

export const addPost = (Post) => api.post('/api/post', Post, getHeaders())

export const editPost = (Post, id) => api.put(`/api/post/${id}`, Post, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deletePost = (id) => api.delete(`/api/post/${id}`, getHeaders())