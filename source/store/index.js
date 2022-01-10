import { createStore } from 'vuex'
import axios from "../axios";

const store = createStore({
    state () {
        return {
            event_file: [],
            option: [],
            planning: [],
            restrictionsDay: []
        }
    },
    mutations: {
        eventFileMutation(state, list){
            state.event_file = list
        },
        eventOptionMutation(state, option){
            state.option = option
        },
        planningMutation(state, planning){
            state.planning = planning
        }
    },
    actions: {
        async eventFileAction(ctx){
            const response = await axios.get('/api/cron-manager/resource/event-list')
            ctx.commit('eventFileMutation', response.data)
        },
        async eventOptionAction(ctx){
            const response = await axios.post('/api/cron-manager/option/select')
            ctx.commit('eventOptionMutation', response.data)
        },
        async planningAction(ctx){
            const response = await axios.get('/api/cron-manager/resource/planning')
            ctx.commit('planningMutation', response.data)
        }
    },
    getters: {
        getEventFile(state){
            return state.event_file
        },
        getOption(state){
            let option = [];
            state.option.forEach((v, i) => {
                option[v.key] = v.value
            })
            return option
        },
        getPlanning(state){
            return state.planning
        }
    }
})

export default store;
