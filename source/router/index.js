import {createRouter, createWebHashHistory} from 'vue-router'
import PageHome from "./../page/Home"
import PageOptions from "./../page/Options"

// 2. Define some routes
// Each route should map to a component.
// We'll talk about nested routes later.
const routes = [
    {
        path: '/',
        component: PageHome
    },
    {
        path: '/options',
        component: PageOptions
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;
