import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getTransactions, addTransaction, editTransaction, deleteTransaction } from '../http/transaction-api'


export const useTransactionStore = defineStore('TransactionStore', () => {
    const transactions = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchTransactions = async () => {

        try {
            const { data } = await getTransactions();
            transactions.value = data.data;

        } catch (error) {
            transactions.value = null;
        }
    }

    const handleAddedTransaction = async (transaction) => {
        try {
            loading.value = true
            response.value = await addTransaction(transaction)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedTransaction = async (transaction, id) => {
        try {
            loading.value = true
            response.value = await editTransaction(transaction, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedCaptian = async (id) => {
        try {
            loading.value = true
            response.value = await deleteTransaction(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { transactions, response, loading, fetchTransactions, handleAddedTransaction, handleUpdatedTransaction, handleDeletedCaptian }

})
