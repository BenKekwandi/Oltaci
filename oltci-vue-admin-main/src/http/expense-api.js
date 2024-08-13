import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getExpenses = () => api.get('/api/expenses', getHeaders())

export const addExpense = (expense) => api.post('/api/expense', expense, getHeaders())

export const editExpense = (expense, id) => api.post(`/api/expense/${id}`, expense, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteExpense = (id) => api.delete(`/api/expense/${id}`, getHeaders())