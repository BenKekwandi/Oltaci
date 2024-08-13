import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getPaymentLink } from '../http/payment-api'


export const usePaymentStore = defineStore('paymentStore', () => {
    const collection = ref([])
    const payments = ref([])
    const loading = ref(false)
    const paymentResponse = ref(null)

    const handleAddedPayment = async (payment) => {
        try {
            loading.value = true;
            paymentResponse.value = await getPaymentLink(payment);
            loading.value = false;
        } catch (error) {
            loading.value = false;
            paymentResponse.value = error?.response;
        }
    }



    return { collection, payments, loading, paymentResponse, handleAddedPayment }

})
