
const routes = [

    {
        path: "/login",
        component: () => import('../pages/LoginPage.vue'),
        name: "login",
        meta: { guest: true }
    },
    {

        path: "",
        component: () => import('../pages/Main.vue'),
        name: 'main',
        meta: {
            auth: true,
        },
        children: [
            {
                path: "",
                component: () => import('../components/Dashboard.vue'),
                name: "dashboard",
                meta: {
                    breadcrumb: [{ title: "Dashboard" }, { title: "Dashboard" }]
                },
            },
            {
                path: "/users",
                component: () => import('../components/Users.vue'),
                name: "users",
                meta: {
                    breadcrumb: [{ title: "Home" }, { title: "Users" }]
                },
            },
            {
                path: "/reservations",
                component: () => import('../components/Reservations.vue'),
                name: "reservations",
                meta: {
                    breadcrumb: [{ title: "Home" }, { title: "Reservations" }]
                }
            },
            {
                path: "/tours",
                component: () => import('../components/Tours.vue'),
                name: "tours",
                meta: {
                    breadcrumb: [{ title: "Home" }, { title: "Tours" }]
                }
            },
            {
                path: "/boats",
                component: () => import('../components/Boats.vue'),
                name: "boats",
                meta: {
                    breadcrumb: [{ title: "Home" }, { title: "Boats" }]
                }
            },
            {
                path: "/regions",
                component: () => import('../components/Regions.vue'),
                name: "regions",
                meta: {
                    breadcrumb: [{ title: "Home" }, { title: "Regions" }]
                }
            },
            {
                path: "/captains",
                component: () => import('../components/Captains.vue'),
                name: "captains",
                meta: {
                    breadcrumb: [{ title: "Home" }, { title: "Captains" }]
                }
            },
            {
                path: "/services",
                component: () => import('../components/AdditionalServices.vue'),
                name: "services",
                meta: {
                    breadcrumb: [{ title: "Home" }, { title: "Additional Services" }]
                }
            },
            {
                path: "/posts",
                component: () => import('../components/Posts.vue'),
                name: "posts",
                meta: {
                    breadcrumb: [{ title: "Posts" }, { title: "Posts" }]
                }
            },
            {
                path: "/trips",
                component: () => import('../components/Trips.vue'),
                name: "trips",
                meta: {
                    breadcrumb: [{ title: "Trips" }, { title: "Boat Trips" }]
                }
            },
            {
                path: "/boat-logs",
                component: () => import('../components/BoatLogs.vue'),
                name: "boat-logs",
                meta: {
                    breadcrumb: [{ title: "Boat Logs" }, { title: "Boat Logs" }]
                }
            },
            {
                path: "/boat-fueling",
                component: () => import('../components/BoatFueling.vue'),
                name: "boat-fueling",
                meta: {
                    breadcrumb: [{ title: "Boat Fueling" }, { title: "Boat Fueling" }]
                }
            },
            {
                path: "/boat-maintenance",
                component: () => import('../components/BoatMaintenance.vue'),
                name: "boat-maintenance",
                meta: {
                    breadcrumb: [{ title: "Maintenance" }, { title: "Boat Maintenance" }]
                }
            },

            {
                path: "/equipment",
                component: () => import('../components/Equipments.vue'),
                name: "equipments",
                meta: {
                    breadcrumb: [{ title: "Equipments" }, { title: "Equipments" }]
                }
            },

            {
                path: "/catch-records",
                component: () => import('../components/CatchRecords.vue'),
                name: "catch-records",
                meta: {
                    breadcrumb: [{ title: "Catch Records" }, { title: "Catch Records" }]
                }
            },

            {
                path: "/expenses",
                component: () => import('../components/Expense.vue'),
                name: "expenses",
                meta: {
                    breadcrumb: [{ title: "Expenses" }, { title: "Expenses" }]
                }
            },

            {
                path: "/incomes",
                component: () => import('../components/Income.vue'),
                name: "incomes",
                meta: {
                    breadcrumb: [{ title: "Incomes" }, { title: "Incomes" }]
                }
            },

            {
                path: "/transactions",
                component: () => import('../components/Transaction.vue'),
                name: "transactions",
                meta: {
                    breadcrumb: [{ title: "Transactions" }, { title: "Transactions" }]
                }
            },

            {
                path: "/invoices",
                component: () => import('../components/Invoice.vue'),
                name: "invoices",
                meta: {
                    breadcrumb: [{ title: "Invoices" }, { title: "Invoices" }]
                }
            },

            {
                path: "/subscribers",
                component: () => import('../components/Subscriber.vue'),
                name: "subscribers",
                meta: {
                    breadcrumb: [{ title: "Subscribers" }, { title: "Subscribers" }]
                }
            },

            {
                path: "/report",
                component: () => import('../components/Report.vue'),
                name: "Report",
                meta: {
                    breadcrumb: [{ title: "Reports" }, { title: "Reports" }]
                }
            },

        ]
    }]

export default routes