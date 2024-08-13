import { useAuthStore } from "../stores/auth"
const routes = [

    {
        path: "/registration",
        component: () => import('../pages/RegistrationPage.vue'),
        name: "registration",
        meta: { guest: true }
    },
    {
        path: "/",
        component: () => import('../pages/HomePage.vue'),
        name: 'home',
        meta: { guest: true },
        beforeEnter: async (to, from, next) => {
            const token = to.query.token;
            if (token) {
                localStorage.setItem('token', token)
                await useAuthStore().fetchExternalUser(token)

                const { query } = to;
                delete query.token;

                next({ path: to.path, query, replace: true });
            } else {
                next();

            }
        }
    },

    {
        path: "/boats",
        component: () => import('../pages/BoatsPage.vue'),
        name: 'boats',
        meta: { guest: true }
    },

    {
        path: "/service",
        component: () => import('../pages/ServicePage.vue'),
        name: 'services',
        meta: { guest: true }
    },
    {
        path: "/contact-us",
        component: () => import('../pages/ContactPage.vue'),
        name: 'contact',
        meta: { guest: true }
    },

    {
        path: "/captains",
        component: () => import('../pages/CaptainsPage.vue'),
        name: 'captains',
        meta: { guest: true }
    },

    // {
    //     path: "/reservation",
    //     component: () => import('../pages/ReservationPage.vue'),
    //     name: 'reservation',
    //     meta: { guest: true }
    // },

    {
        path: "/boat-detail/:id",
        component: () => import('../pages/BoatDetailPage.vue'),
        name: 'BoatDetail',
        meta: { guest: true }
    },

    {
        path: "/payment",
        component: () => import('../pages/PaymentPage.vue'),
        name: 'payment',
        meta: { auth: true }
    },

    {
        path: "/reservation",
        component: () => import('../pages/ReservationPage.vue'),
        name: 'reservation',
        meta: { auth: true }
    },

    {
        path: "/filters",
        component: () => import('../pages/FiltersPage.vue'),
        name: 'filters',
        props: true,
        meta: { guest: true }
    },

    {
        path: "/blog",
        component: () => import('../pages/BlogPage.vue'),
        name: 'blog',
        props: true,
        meta: { guest: true }
    },

    {
        path: "/blog/:id",
        component: () => import('../pages/BlogDetailPage.vue'),
        name: 'BlogDetail',
        meta: { guest: true }
    },

    {
        path: "/profile",
        component: () => import('../pages/ProfilePage.vue'),
        name: 'ProfilePage',
        meta: { guest: true }
    },

    {
        path: "/privacy-policy",
        component: () => import('../pages/PrivacyPolicyPage.vue'),
        name: 'PrivacyPolicyPage',
        meta: { guest: true }
    },

    
    {
        path: "/terms-and-conditions",
        component: () => import('../pages/TermsAndConditionsPage.vue'),
        name: 'TermsAndConditionsPage',
        meta: { guest: true }
    },


]

export default routes