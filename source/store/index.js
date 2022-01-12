import { createStore } from 'vuex'
import axios from "../axios";

const store = createStore({
    state () {
        return {
            event_methods: [],
            option: [],
            planning: [],
            restrictionsDay: [],
            log: [],
            logIdEvent: 0,
            logActive: false,
        }
    },
    mutations: {
        eventMethodsMutation(state, list){
            state.event_methods = list
        },
        eventOptionMutation(state, option){
            state.option = option
        },
        planningMutation(state, planning){
            state.planning = planning
        },
        windowLogOpenMutation(state, {result, id_event}){
            state.log = result
            state.logIdEvent = id_event
        },
        windowLogCloseMutation(state){
            state.log = []
            state.logIdEvent = 0
            state.logActive = false
        },
        logActiveMutation(state, type){
            state.logActive = type
        },
        deleteLogAllMutation(state){
            state.log = []
        }
    },
    actions: {
        async eventMethodsAction(ctx){
            const response = await axios.get('/api/cron-manager/resource/event-list')
            ctx.commit('eventMethodsMutation', response.data)
        },
        async eventOptionAction(ctx){
            const response = await axios.post('/api/cron-manager/option/select')
            ctx.commit('eventOptionMutation', response.data)
        },
        async planningAction(ctx){
            const response = await axios.get('/api/cron-manager/resource/planning')
            ctx.commit('planningMutation', response.data)
        },
        async windowLogOpenAction(ctx, id_event){
            ctx.commit('logActiveMutation', false)
            const response = await axios.get('/api/cron-manager/log/select/event/'+ id_event);
            ctx.commit('windowLogOpenMutation', {result: response.data, id_event})
            ctx.commit('logActiveMutation', true)
        },
        async windowLogCloseAction(ctx){
            ctx.commit('windowLogCloseMutation')
        },
        async deleteLogAllAction(ctx, id_event){
            await axios.post('/api/cron-manager/log/delete/event/'+ id_event);
            ctx.commit('deleteLogAllMutation')
        }
    },
    getters: {
        getEventMethods(state){
            return state.event_methods
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
        },
        getLog(state){
            return state.log.map(item => {
                item.date = item.created_at.split(".")[0].replace("T", " ")
                return item;
            })
        },
        getLogActive(state){
            return state.logActive
        },
        getLogIdEvent(state){
            return state.logIdEvent
        }
    }
})

export default store;
