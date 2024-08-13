<template>
    <div class="h-100 d-flex align-center justify-center">
        <v-card class="pa-12 pb-8" elevation="4" width="400" rounded="lg">
            <div class="text-center text-h5 mb-8 font-weight-medium">Oltaci Admin</div>
            <div class="text-subtitle-1 text-medium-emphasis">Username</div>
            <form>
                <v-text-field v-model="form.username" density="comfortable" placeholder="Username"
                    prepend-inner-icon="mdi-account-outline" variant="outlined"
                    :error-messages="v$.username.$errors.map(e => e.$message)"></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
                    Password

                    <a class="text-caption text-decoration-none text-orange-darken-4" href="#" rel="noopener noreferrer"
                        target="_blank">
                        Forgot login password?</a>
                </div>

                <v-text-field v-model="form.password" :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'" density="comfortable" placeholder="Enter your password"
                    prepend-inner-icon="mdi-lock-outline" variant="outlined" @click:append-inner="visible = !visible"
                    :error-messages="v$.password.$errors.map(e => e.$message)"></v-text-field>



                <v-btn class="mb-8 mt-6" color="orange-darken-4" size="large" block @click="login"
                    :loading="loading" flat>
                    Log In
                </v-btn>
            </form>
            <v-card-text class="text-center">

            </v-card-text>
        </v-card>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '../../stores/auth'
import { storeToRefs } from 'pinia'
import { useRouter } from "vue-router"
import { useVuelidate } from '@vuelidate/core'
import { required, helpers  } from '@vuelidate/validators'


const router = useRouter()
const store = useAuthStore()

const { isLoggedIn, loading } = storeToRefs(store)

const visible = ref(false)


const form = ref({
    username: '',
    password: ''
})

const rules = {
    username: { required: helpers.withMessage('This field cannot be empty', required) },
    password: { required: helpers.withMessage('This field cannot be empty', required) }
}

const v$ = useVuelidate(rules, form.value)

const login = async () => {

    v$.value.$validate()
    if (v$.value.$error) {
        return
    }
    await store.handleLogin(form.value)
    if (isLoggedIn.value)
        router.push({ name: "dashboard" })


}
</script>