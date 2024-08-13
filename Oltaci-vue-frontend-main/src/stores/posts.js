import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getPosts, getPost } from '../http/posts-api'


export const usePostStore = defineStore('PostStore', () => {
    const posts = ref([])
    const post = ref({})
    const loading = ref(false)
    const response = ref(null)

    const fetchPosts = async () => {

        try {
            const { data } = await getPosts();
            posts.value = data.data;
            loading.value = false
        } catch (error) {
            posts.value = null;
            loading.value = false
        }
    }
    const fetchPost = async (id) => {
        loading.value = true
        try {
            const { data } = await getPost(id);
            post.value = data.data;
        } catch (error) {
            post.value = null;
        } finally {
            loading.value = false;
        }
    }

    return { post, posts, loading, response, fetchPosts, fetchPost }

})
