<template>
    <v-dialog v-model="dialog" max-width="450px">

        <v-card class="pb-4">
            <v-card-title class="d-flex justify-space-between align-center">
                <v-spacer></v-spacer>

                <v-btn icon="mdi-window-close" variant="text" @click="close"></v-btn>
            </v-card-title>
            <v-card-item class="text-center my-0 py-0">
                <h2> LOGO</h2>
            </v-card-item>

            <Login v-model="signInExpand" @showRegistration="showSignUp" @closeDialog="close" />
            <Registration v-model="signUpExpand" @showLogin="showSignIn" />
        </v-card>

    </v-dialog>
</template>

<script setup>
import { ref, watch } from 'vue';
import Login from './Login.vue';
import Registration from './Registration.vue';
import { useAuthStore } from '/src/stores/auth.js';
import { storeToRefs } from 'pinia';

const store = useAuthStore()


const { alert } = storeToRefs(store)



const dialog = defineModel({ type: Boolean })



const signInExpand = ref(true)
const signUpExpand = ref(false)



const showSignUp = () => {

    signInExpand.value = false
    setTimeout(() => {
        signUpExpand.value = true;
    }, 250)
}

const showSignIn = () => {
    signUpExpand.value = false

    setTimeout(() => {
        signInExpand.value = true;
    }, 250)
}

const close = () => {
    dialog.value = false
    signInExpand.value = true
    signUpExpand.value = false

    setTimeout(() => {
        Object.assign(alert.value, {
            show: false,
            type: null,
            message: ''
        })
    }, 250)
}

watch(dialog, val => {
    val || close()
})

</script>