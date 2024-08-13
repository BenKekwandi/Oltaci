import { ref } from 'vue';
import { defineStore } from 'pinia';
import { addSubscriber } from '../http/subscriber-api';

export const useSubscriberStore = defineStore('subscriberStore', () => {
    const subscriber = ref({
        first_name: '',
        last_name: '',
        email: '',
    });
    const errors = ref(null);
    const loading = ref(false);
    const response = ref(null);

    const handleAddSubscriber = async (subscriber) => {

        try {
            loading.value = true;
            response.value = await addSubscriber(subscriber);
            loading.value = false;
        } catch (error) {
            loading.value = false;
            response.value = error?.response;
            errors.value = error?.response?.data;
        }

        window.location.reload();
    };

    return {
        subscriber,
        errors,
        loading,
        response,
        handleAddSubscriber
    };
}, {
    persist: true
});
