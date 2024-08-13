import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getUsers, addUser, editUser, deleteUser } from '../http/users-api'


export const useUsersStore = defineStore('usersStore', () => {
    const users = ref([])
    const errors = ref(null)
    const loading = ref(false)
    const response = ref(null)

    const fetchUsers = async () => {

        try {
            const { data } = await getUsers();
            users.value = data.data;

        } catch (error) {
            users.value = null;
        }
    }

    const handleAddedUser = async (user) => {
        try {
            loading.value = true
            const { data } = await addUser(user)
            response.value = data
            loading.value = false
        } catch (error) {
            loading.value = false
            errors.value = error.response?.data?.message || 'Something went wrong'
        }
    }

    const handleUpdatedUser = async (user, id) => {
        try {
            loading.value = true
            const { data } = await editUser(user, id)
            response.value = data
            loading.value = false

        } catch (error) {
            loading.value = false
            errors.value = error.response?.data?.message || 'Something went wrong'
        }
    }

    const handleDeletedUser = async (id) => {
        try {
            loading.value = true
            const { data } = await deleteUser(id)
            response.value = data
            loading.value = false

        } catch (error) {
            loading.value = false
            errors.value = error.response?.data?.message || 'Something went wrong'
        }
    }



    return { users, errors, response, loading, fetchUsers, handleAddedUser, handleUpdatedUser, handleDeletedUser }

})
