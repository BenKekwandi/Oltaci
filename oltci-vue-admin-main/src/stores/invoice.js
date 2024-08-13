import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getInvoices, addInvoice, editInvoice, deleteInvoice } from '../http/invoice-api'


export const useInvoiceStore = defineStore('InvoiceStore', () => {
    const invoices = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchInvoices = async () => {

        try {
            const { data } = await getInvoices();
            invoices.value = data.data;

        } catch (error) {
            invoices.value = null;
        }
    }

    const handleAddedInvoice = async (invoice) => {
        try {
            loading.value = true
            response.value = await addInvoice(invoice)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedInvoice = async (invoice, id) => {
        try {
            loading.value = true
            response.value = await editInvoice(invoice, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedInvoice = async (id) => {
        try {
            loading.value = true
            response.value = await deleteInvoice(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { invoices, response, loading, fetchInvoices, handleAddedInvoice, handleUpdatedInvoice, handleDeletedInvoice }

})
