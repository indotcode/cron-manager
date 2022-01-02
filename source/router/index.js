import {createRouter, createWebHashHistory} from 'vue-router'
import PageHome from "./../page/Home"
import PageOptions from "./../page/Options"
import PageEventInsert from "./../page/Event/Insert"
import PageEventUpdate from "./../page/Event/Update"

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
    },
    {
        path: '/event/update/:id',
        component: PageEventUpdate
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router;
