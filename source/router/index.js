import {createRouter, createWebHashHistory} from 'vue-router'
import PageHome from "./../page/Home"
import PageOptions from "./../page/Options"
import PageEventInsert from "./../page/Event/Insert"

const routes = [
    {
        path: '/',
        component: PageHome
    },
    {
        path: '/options',
        component: PageOptions
    },
    {
        path: '/event/insert',
        component: PageEventInsert
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;
