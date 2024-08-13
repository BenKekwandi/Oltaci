// stores/countdown.js

import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useCountdownStore = defineStore('countdown', () => {
    const show = ref(false)
    const redirectUrl = ref('')

    const startCountdown = (url) => {
        show.value = true
        redirectUrl.value = url
    }

    const stopCountdown = () => {
        show.value = false
        redirectUrl.value = ''
    }

    return { show, redirectUrl, startCountdown, stopCountdown }
})
