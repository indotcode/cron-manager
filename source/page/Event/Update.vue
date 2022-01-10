<template>
    <div v-if="loading">
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3 flex flex-row content-center flex-wrap">
                <h2 class="text-2xl text-gray-800 font-bold">Изменение cron задачи</h2>
                <Crumbs :items="[{to: '/', name: 'Список заданий'}, {name: 'Изменить задание'}]"/>
            </div>
        </div>
        <div>
            <div v-on:click="messages = ''" class="text-blue-600 mb-3 cursor-pointer " v-if="messages !== ''">
                {{messages}}
            </div>
            <Form @submit="onSubmit">

                <label class="block mb-3">
                    <span class="text-gray-800 font-bold">Название <span class="text-red-600">*</span></span>
                    <Field v-model="name" placeholder="Введите название задачи" name="name" type="text" :rules="nameRule"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                    <ErrorMessage class="text-sm text-red-500" name="name" />
                </label>

                <label class="block mb-3">
                    <Field name="event" v-model="event" type="hidden" :rules="eventRule"/>
                    <span class="text-gray-800 font-bold">Event файл <span class="text-red-600">*</span></span>
                    <div class="text-sm text-slate-400">Путь к файлу: {{getOption.path_schedule}}</div>
                    <select v-model="event" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected disabled hidden value="">Выберите файл</option>
                        <option v-for="(file, id) in getEventFile" :key="id" :value="file">{{file}}</option>
                    </select>
                    <ErrorMessage class="text-sm text-red-500" name="event" />
                </label>

                <label class="block mb-3">
                    <Field name="periodicity" v-model="periodicity" type="hidden" :rules="periodicityRule"/>
                    <span class="text-gray-800 font-bold">Параметры периодичности расписания <span class="text-red-600">*</span></span>
                    <select required v-model="periodicity" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected disabled hidden value="">Выберите периуд расписания</option>
                        <option v-for="(param, id) in getPlanning" :key="id" :value="param.key">{{param.name}}</option>
                    </select>
                    <ErrorMessage class="text-sm text-red-500" name="periodicity" />
                </label>

                <template v-if="periodicity === 'cron'">
                    <PeriodicityCron :value="data.periodicity_value"/>
                </template>

                <template v-if="periodicity === 'hourlyAt'">
                    <PeriodicityHourlyAt :value="data.periodicity_value"/>
                </template>

                <template v-if="periodicity === 'twiceDaily'">
                    <PeriodicityTwiceDaily :value="data.periodicity_value"/>
                </template>

                <template v-if="periodicity === 'dailyAt'">
                    <PeriodicityDailyAt :value="data.periodicity_value"/>
                </template>

                <template v-if="periodicity === 'monthlyOn'">
                    <PeriodicityMonthlyOn :value="data.periodicity_value"/>
                </template>

                <FieldTimezone :value="data.timezone"/>

                <FieldRestrictionsDay :value="data.restrictions_days"/>


                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 font-semibold bg-indigo-500 hover:bg-indigo-400 text-sm text-white rounded-full shadow-sm">Сохранить</button>
                </div>

            </Form>
        </div>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
import { mapActions, mapGetters } from 'vuex'
import Crumbs from './../../components/Crumbs'
import axios from "../../axios";
export default {
    name: 'PageEventUpdate',
    components: {Crumbs, Form, Field, ErrorMessage},
    data: () => {
        return {
            loading: false,
            data: {},
            messages: '',
            name: '',
            event: '',
            periodicity: ''
        }
    },
    computed: {
        ...mapGetters(['getEventFile', 'getOption', 'getPlanning'])
    },
    async mounted(){
        await this.eventFileAction()
        await this.eventOptionAction()
        this.axios.post('/api/cron-manager/event/find/'+this.$route.params.id).then(response => {
            this.data = response.data
            this.name = response.data.name
            this.event = response.data.event
            this.periodicity = response.data.periodicity
        }).then(() => {
            this.loading = true
        })
    },
    methods: {
        ...mapActions(['eventFileAction', 'eventOptionAction']),
        async onSubmit (values) {
            let data = {}
            data.name = values.name
            data.event = values.event
            data.periodicity = values.periodicity
            let params = [];
            if(values.params){
                params = values.params;
            }
            data.periodicity_value = JSON.stringify(params)
            data.restrictions_days = values.restrictionsDay
            data.timezone = values.timezone ? values.timezone : ''
            await this.axios.post('/api/cron-manager/event/update/'+this.$route.params.id, data)
            this.messages = 'Задание успешно сохранено.'
        },
        periodicityRule(value) {
            if(!value){
                return 'Параметр периодичности расписания обязателен для заполнения';
            }
            return true;
        },
        eventRule(value) {
            if(!value){
                return 'Event файл обязателен для заполнения';
            }
            return true;
        },
        nameRule(value) {
            if(!value){
                return 'Название обязательно для заполнения';
            }
            if(value && value.length >= 170){
                return 'Название не должно привышать 170 символов';
            }
            return true;
        }
    }
};
</script>
