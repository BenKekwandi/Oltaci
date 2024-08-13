<template>
    <v-fade-transition>

        <v-card-text v-show="signInExpand" class="pa-10">
            <v-alert v-show="alert.show" :type="alert.type" variant="outlined" class="mb-2">
                {{ alert.message }}
            </v-alert>
            <form>
                <div class=" text-medium-emphasis">Username</div>
                <v-text-field v-model="form.username" placeholder="Enter your username"
                    prepend-inner-icon="mdi-account-outline" variant="outlined" density="comfortable"
                    :error-messages="v$.username.$errors.map(e => e.$message)"></v-text-field>

                <div class=" text-medium-emphasis d-flex align-center justify-space-between">
                    Password

                    <a class="text-caption text-decoration-none text-blue" href="#" rel="noopener noreferrer"
                        target="_blank">
                        Forgot login password?</a>
                </div>

                <v-text-field v-model="form.password"
                    :append-inner-icon="visible ? 'mdi-eye-off-outline' : 'mdi-eye-outline'"
                    :type="visible ? 'text' : 'password'" placeholder="Enter your password"
                    prepend-inner-icon="mdi-lock-outline" variant="outlined" @click:append-inner="visible = !visible"
                    density="comfortable" :error-messages="v$.password.$errors.map(e => e.$message)"></v-text-field>

                    <vue-recaptcha 
                        ref="recaptcha"
                        @verify="onVerify"
                        @expired="onExpired"
                        sitekey="6LduRxwqAAAAAHnRdMqqHlw1rcmexa_-nN-QHnfV"
                    ></vue-recaptcha> 

                    <template>
                        <vue-recaptcha v2 @verify="onVerify"></vue-recaptcha>
                    </template>

                <v-btn @click="submit" class="my-4" color="blue" block>
                    Sign In
                </v-btn>

            </form>

            <div class="text-center">Or</div>

            <v-btn href="http://api.oltaci.com.tr/auth/google/redirect" class="my-4" prepend-icon="mdi-google"
                color="blue" size="small" block variant="outlined">
                Sign in with google
            </v-btn>
            <br>
            <div class="text-center">New Here? <a type="button" class="text-decoration-underline text-primary"
                    @click="redirect">Create an Account</a></div>
        </v-card-text>
    </v-fade-transition>


</template>

<script setup>

import VueRecaptcha from 'vue-recaptcha';
import { ref } from 'vue'
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, helpers } from '@vuelidate/validators'
import { useAuthStore } from '/src/stores/auth.js';
import { storeToRefs } from 'pinia';
import { useI18n } from "vue-i18n";
import { useReCaptcha } from 'vue-recaptcha-v3';
 
const { t } = useI18n();

const { executeRecaptcha } = useReCaptcha();

const onVerify = async () => {
  const token = await executeRecaptcha('login');
  console.log('reCAPTCHA token:', token);
};

const store = useAuthStore()

const visible = ref(false)

const { user, isLoggedIn, errors, response, alert, loading } = storeToRefs(store)

const signInExpand = defineModel({ type: Boolean })

const emits = defineEmits(["showRegistration", "closeDialog"])

const form = ref({
    username: "",
    password: ""
})

const rules = {
    username: {
        required: helpers.withMessage('This field cannot be empty', required),
        minLength: helpers.withMessage('The username field must be at least 5 characters.', minLength(5))
    },

    password: {
        required: helpers.withMessage('This field cannot be empty', required),
        minLength: helpers.withMessage('The password field must be at least 6 characters long', minLength(6))
    }
}

const v$ = useVuelidate(rules, form.value)

const redirect = () => {
    emits('showRegistration')
    setTimeout(() => {
        Object.assign(alert.value, {
            show: false,
            type: null,
            message: ''
        })
    }, 250)
}

async function submit() {
    v$.value.$validate()
    if (v$.value.$error) {
        return
    }
    await store.handleLogin(form.value)
    if (response.value.status !== 200) {
        Object.assign(alert.value, {
            show: true,
            type: 'error',
            message: errors.value
        })
    }
    if (isLoggedIn.value) {
        emits('closeDialog')
    }
}



</script>