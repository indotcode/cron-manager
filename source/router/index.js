import {createRouter, createWebHashHistory} from 'vue-router'
import axios from './../axios'
import PageHome from "./../page/Home"
import PageOptionMain from "../page/Option/Main"
import PageEventInsert from "./../page/Event/Insert"
import PageEventUpdate from "./../page/Event/Update"


const routes = [
    {
        path: '/',
        component: PageHome,
        name: 'PageHome'
    },
    {
        path: '/option',
        component: PageOptionMain,
        name: 'PageOptionMain'
    },
    {
        path: '/event/insert',
        component: PageEventInsert,
        name: 'PageEventInsert'
    },
    {
        path: '/event/update/:id',
        component: PageEventUpdate,
        name: 'PageEventUpdate'
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

router.beforeEach(async (to, from, next) => {
    if(to.name === 'PageEventUpdate'){
        const response = await axios.post('/cron-manager/api/event/find/'+to.params.id)
        if(!('name' in response.data)){
            next({ name: 'PageHome' })
        }
    }
    next()
})

export default router;
