import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { login, getUser, logout } from '../http/auth-api'


export const useAuthStore = defineStore('authStore', () => {
    const user = ref(null)
    const errors = ref(null)
    const loading = ref(false)

    const isLoggedIn = computed(() => !!user.value)

    const fetchUser = async (token) => {

        try {
            const { data } = await getUser(token);
            user.value = data;

        } catch (error) {
            user.value = null;
        }
    }



    const handleLogin = async (credentials) => {
        try {
            loading.value = true
            const { data } = await login(credentials)
            user.value = data.user
            localStorage.setItem('token', data.token)
            loading.value = false
            errors.value = null

        }
        catch (error) {
            loading.value = false
            if (error.response)
                errors.value = error.response.data.message
            user.value = null
        }
    }

    const handleLogout = async () => {
        await logout()
        user.value = null
    }




    return { user, isLoggedIn, errors, loading, fetchUser, handleLogin,  handleLogout}

})
