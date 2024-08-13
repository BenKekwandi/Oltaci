import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getPosts, editPost, addPost, deletePost } from '../http/posts-api'


export const usePostStore = defineStore('PostStore', () => {
    const posts = ref([])
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

    const handleAddedPost = async (Post) => {
        try {
            loading.value = true
            response.value = await addPost(Post)
            loading.value = false
        } catch (error) {
            loading.value = false
            response.value = error?.response

        }
    }

    const handleUpdatedPost = async (Post, id) => {
        try {
            loading.value = true
            response.value = await editPost(Post, id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }

    const handleDeletedPost = async (id) => {
        try {
            loading.value = true
            response.value = await deletePost(id)
            loading.value = false

        } catch (error) {
            loading.value = false
            response.value = error?.response
        }
    }
    return { posts, loading, response, fetchPosts, handleAddedPost, handleUpdatedPost, handleDeletedPost }

})
