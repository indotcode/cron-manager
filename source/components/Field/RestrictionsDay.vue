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
<!--        <div class="mt-3">-->
<!--            <label class="block mb-2" v-for="item in getRestrictionsDay" :key="item.key">-->
<!--                <Field v-slot="{ restrictions_day }" name="restrictions_day" type="checkbox" :value="item.key">-->
<!--                    <input type="checkbox" name="restrictions_day" v-bind="restrictions_day" :value="true" />-->
<!--                </Field>-->
<!--                <span class="ml-2">{{item.name}}</span>-->
<!--&lt;!&ndash;                <Field name="restrictions_day" type="checkbox" checked="checked" :value="false" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" />&ndash;&gt;-->
<!--&lt;!&ndash;                <span class="ml-2">{{item.name}}</span>&ndash;&gt;-->
<!--            </label>-->
<!--        </div>-->
<!--        <label class="block mb-3" v-if="timezone_checkbox">-->
<!--            <span class="text-gray-800 font-bold">Часовой пояс <span class="text-red-600">*</span></span>-->
<!--            <Field placeholder="America/New_York" name="timezone" v-model="timezone" type="text" :rules="roles"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />-->
<!--            <ErrorMessage class="text-sm text-red-500" name="timezone" />-->
<!--        </label>-->
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
import {mapActions, mapGetters} from "vuex";
import axios from "../../axios";

export default {
    name: 'FieldRestrictionsDay',
    components: {Form, Field, ErrorMessage},
    data(){
        return {
            restrictionsDay: '',
            restrictionsDayResult: []
        }
    },
    async mounted() {
        const response = await axios.get('/api/cron-manager/resource/restrictions-day')
        this.restrictionsDayResult = this.restrictionsDayTransform(response.data);
    },
    computed: {

    },
    methods: {
        restrictionsDayEvent(key){
            this.restrictionsDayResult.map(v => {
                if(v.key === key){
                    if(v.active){
                        v.className[1] = 'border-slate-600 border-2 border-solid text-slate-600 hover:bg-slate-50'
                        this.removeRestrictionsDay(v.key)
                    } else {
                        v.className[1] = 'border-slate-600 border-2 border-solid bg-white bg-slate-600 hover:bg-slate-500'
                        this.addRestrictionsDay(v.key)
                    }
                    v.active = !v.active
                }
                return v
            })
        },
        restrictionsDayTransform(result){
            return result.map(v => {
                let className = []
                className[0] = 'px-2 py-1 font-semibold text-sm text-white rounded-lg shadow-sm cursor-pointer'
                className[1] = 'border-slate-600 border-2 border-solid text-slate-600 hover:bg-slate-50'
                v.className = className
                v.active = false
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
