import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from "../stores/auth"
import routes from './routes'



const router = createRouter({
  routes,
  history: createWebHistory(),
})


router.beforeEach(async (to, from) => {
  const store = useAuthStore()
  if (to.meta.auth) {
    if (localStorage.getItem('token')) {
      await store.fetchExternalUser(localStorage.getItem('token'))
    } else
      await store.fetchUser()

    if (!store.isLoggedIn) {
      store.openLogin()
      return {
        name: "home",
        query: {
          redirect: to.fullPath
        }
      }
    }
  }
})



export default router