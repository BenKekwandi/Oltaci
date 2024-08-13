import api from "./axios.js"

export const getPaymentLink = (payment) => api.post('/api/iyzipay/pay', payment)