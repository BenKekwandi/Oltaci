import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getTransactions = () => api.get('/api/transactions', getHeaders())

export const addTransaction = (transaction) => api.post('/api/transaction', transaction, getHeaders())

export const editTransaction = (transaction, id) => api.post(`/api/transaction/${id}`, transaction, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteTransaction = (id) => api.delete(`/api/transaction/${id}`, getHeaders())