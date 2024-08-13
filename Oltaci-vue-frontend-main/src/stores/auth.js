import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { csrfCookie, login, register, getUser, geteExternalUser, logout } from '../http/auth-api'


export const useAuthStore = defineStore('authStore', () => {
    const user = ref(null)
    const errors = ref(null)
    const response = ref(null)
    const loading = ref(false)
    const dialogLogin = ref(false)

    const alert = ref({
        show: false,
        type: null,
        message: ''
    })

    const isLoggedIn = computed(() => !!user.value)

    const fetchUser = async () => {
        try {
            const { data } = await getUser();
            user.value = data;

        } catch (error) {
            user.value = null;
        }
    }

    const fetchExternalUser = async (token) => {

        try {
            const { data } = await geteExternalUser(token);
            user.value = data;
        } catch (error) {
            user.value = null;
        }
    }

    const handleLogin = async (credentials) => {
        await csrfCookie();
        try {
            loading.value = true
            response.value = await login(credentials)
            await fetchUser()
            loading.value = false
            errors.value = null
        }
        catch (error) {
            loading.value = false
            response.value = error?.response
            if (error.response) {
                errors.value = error.response.data?.message || error.response.data?.error
                user.value = null
            }

        }
    }

    const handleRegistration = async (credentials) => {
        await csrfCookie();
        try {
            loading.value = true
            response.value = await register(credentials)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response
            if (error.response) {
                errors.value = error.response.data.message
                user.value = null
            }
        }
    }

    const handleLogout = async () => {
        loading.value = true
        await logout()
        user.value = null
        loading.value = false
    }

    const openLogin = () => {
        dialogLogin.value = true
    }



    return { user, isLoggedIn, errors, loading, response, alert, dialogLogin, fetchUser, fetchExternalUser, handleLogin, handleRegistration, handleLogout, openLogin }

})
