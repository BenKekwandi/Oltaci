import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getSubscribers, addSubscriber, editSubscriber, deleteSubscriber } from '../http/subscriber-api'


export const useSubscriberStore = defineStore('SubscriberStore', () => {
    const subscribers = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchSubscribers = async () => {

        try {
            const { data } = await getSubscribers();
            subscribers.value = data.data;

        } catch (error) {
            subscribers.value = null;
        }
    }

    const handleAddedSubscriber = async (subscriber) => {
        try {
            loading.value = true
            response.value = await addSubscriber(subscriber)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedSubscriber = async (subscriber, id) => {
        try {
            loading.value = true
            response.value = await editSubscriber(subscriber, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedSubscriber = async (id) => {
        try {
            loading.value = true
            response.value = await deleteSubscriber(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }



    return { subscribers, response, loading, fetchSubscribers, handleAddedSubscriber, handleUpdatedSubscriber, handleDeletedSubscriber }

})
