import api from "./axios.js"

const getHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
})

export const getInvoices = () => api.get('/api/invoices', getHeaders())

export const addInvoice = (invoice) => api.post('/api/invoice', invoice, getHeaders())

export const editInvoice = (invoice, id) => api.post(`/api/invoice/${id}`, invoice, getHeaders(), {
    params: {
        _method: 'PUT'
    }
})

export const deleteInvoice = (id) => api.delete(`/api/invoice/${id}`, getHeaders())