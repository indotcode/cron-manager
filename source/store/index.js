import { createStore } from 'vuex'
import axios from "../axios";

const store = createStore({
    state () {
        return {
            event_file: []
        }
    },
    mutations: {
        eventFileMutation(state, list){
            state.event_file = list
        }
    },
    actions: {
        async eventFileAction(ctx){
            const response = await axios.get('/cron-manager/api/resource/event-list')
            ctx.commit('eventFileMutation', response.data)
        }
    },
    getters: {
        getEventFile(state){
            return state.event_file
        }
    }
})

export default store;
