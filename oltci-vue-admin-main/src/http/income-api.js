import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getIncomes = () => api.get('/api/incomes', getHeaders())

export const addIncome = (income) => api.post('/api/income', income, getHeaders())

export const editIncome = (income, id) => api.post(`/api/income/${id}`, income, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteIncome = (id) => api.delete(`/api/income/${id}`, getHeaders())