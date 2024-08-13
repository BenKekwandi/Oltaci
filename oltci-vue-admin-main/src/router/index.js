import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from "../stores/auth"
import routes from './routes'





const router = createRouter({
  routes,
  history: createWebHistory(),
})


router.beforeEach(async (to, from) => {

  const store = useAuthStore()
  if (localStorage.getItem('token'))
    await store.fetchUser(localStorage.getItem('token'))

  if (to.meta.auth && !store.isLoggedIn) {
    return {
      name: "login",
      query: {
        redirect: to.fullPath
      }
    }
  }


})


export default router