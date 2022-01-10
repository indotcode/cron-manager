<template>
    <div class="mb-4">
        <div class="text-gray-800 font-bold mb-1">Ограничить выполнение задачи днями</div>
        <Field name="restrictionsDay" v-model="restrictionsDay" type="hidden" />
        <div class="flex flex-wrap">
            <div class="mr-2 mt-1" v-for="item in restrictionsDayResult" :key="item.key">
                <div @click="restrictionsDayEvent(item.key)" :class="item.className">
                    {{item.name}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';

export default {
    name: 'FieldRestrictionsDay',
    components: {Form, Field, ErrorMessage},
    props: {
        value: {
            type: String
        }
    },
    data(){
        return {
            data: {},
            restrictionsDay: '',
            restrictionsDayResult: [],
            de_active_class: 'border-slate-600 border-2 border-solid text-slate-600 hover:bg-slate-50',
            active_class: 'border-slate-600 border-2 border-solid bg-white bg-slate-600 hover:bg-slate-500'
        }
    },
    async mounted() {
        const response = await this.axios.get('/api/cron-manager/resource/restrictions-day')
        this.restrictionsDayResult = this.restrictionsDayTransform(response.data, this.value);
    },

    methods: {
        restrictionsDayEvent(key){
            this.restrictionsDayResult.map(v => {
                if(v.key === key){
                    if(v.active){
                        v.className[1] = this.de_active_class
                        this.removeRestrictionsDay(v.key)
                    } else {
                        v.className[1] = this.active_class
                        this.addRestrictionsDay(v.key)
                    }
                    v.active = !v.active
                }
                return v
            })
        },
        restrictionsDayTransform(result, value){
            let in_params = [];
            if(value){
                this.restrictionsDay = value
                in_params = value.split(',')
            }
            return result.map(v => {
                v.active = false
                let className = []
                className[0] = 'px-2 py-1 font-semibold text-sm text-white rounded-lg shadow-sm cursor-pointer'
                className[1] = this.de_active_class
                if(in_params.indexOf(v.key) !== -1){
                    className[1] = this.active_class
                    v.active = true
                }
                v.className = className
                return v
            })
        },
        addRestrictionsDay(key){
            let map = this.restrictionsDay.length !== 0 ? this.restrictionsDay.split(',') : [];
            map.push(key);
            this.restrictionsDay = map.join(',')
        },
        removeRestrictionsDay(key){
            this.restrictionsDay = this.restrictionsDay.split(',').filter(v => v !== key).join(',')
        }
    }
};
</script>
