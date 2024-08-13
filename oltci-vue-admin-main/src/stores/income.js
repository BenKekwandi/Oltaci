import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getIncomes, addIncome, editIncome, deleteIncome } from '../http/income-api'


export const useIncomeStore = defineStore('IncomeStore', () => {
    const incomes = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchIncomes = async () => {

        try {
            const { data } = await getIncomes();
            incomes.value = data.data;

        } catch (error) {
            incomes.value = null;
        }
    }

    const handleAddedIncome = async (income) => {
        try {
            loading.value = true
            response.value = await addIncome(income)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedIncome = async (income, id) => {
        try {
            loading.value = true
            response.value = await editIncome(income, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedCaptian = async (id) => {
        try {
            loading.value = true
            response.value = await deleteIncome(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { incomes, response, loading, fetchIncomes, handleAddedIncome, handleUpdatedIncome, handleDeletedCaptian }

})
