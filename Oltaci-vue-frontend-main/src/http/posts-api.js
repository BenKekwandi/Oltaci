import api from "./axios.js"

export const getPosts = () => api.get(`/api/posts`)
export const getPost = (id) => api.get(`/api/post/${id}`)
