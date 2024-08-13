import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getExpenses, addExpense, editExpense, deleteExpense } from '../http/expense-api'


export const useExpenseStore = defineStore('ExpenseStore', () => {
    const expenses = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchExpenses = async () => {

        try {
            const { data } = await getExpenses();
            expenses.value = data.data;

        } catch (error) {
            expenses.value = null;
        }
    }

    const handleAddedExpense = async (expense) => {
        try {
            loading.value = true
            response.value = await addExpense(expense)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedExpense = async (expense, id) => {
        try {
            loading.value = true
            response.value = await editExpense(expense, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedCaptian = async (id) => {
        try {
            loading.value = true
            response.value = await deleteExpense(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { expenses, response, loading, fetchExpenses, handleAddedExpense, handleUpdatedExpense, handleDeletedCaptian }

})
