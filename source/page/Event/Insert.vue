<template>
    <div>
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3 flex flex-row content-center flex-wrap">
                <h2 class="text-2xl text-gray-800 font-bold">Добавление cron задачи</h2>
                <Crumbs :items="[{to: '/', name: 'Список заданий'}, {name: 'Добавление задачи'}]"/>
            </div>
        </div>
        <div>
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
                    <PeriodicityCron/>
                </template>
                <template v-if="periodicity === 'hourlyAt'">
                    <PeriodicityHourlyAt/>
                </template>

                <div class="mt-4">
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
import PeriodicityCron from './../../components/Periodicity/Cron'
import PeriodicityHourlyAt from './../../components/Periodicity/HourlyAt'
export default {
    name: 'PageEventInsert',
    components: {Crumbs, PeriodicityCron, Form, Field, ErrorMessage, PeriodicityHourlyAt},
    data: () => {
        return {
            name: '',
            event: '',
            periodicity: ''
        }
    },
    computed: {
        ...mapGetters(['getEventFile', 'getOption', 'getPlanning']),
    },
    async mounted(){
        await this.eventFileAction()
        await this.eventOptionAction()
    },
    methods: {
        ...mapActions(['eventFileAction', 'eventOptionAction']),
        async onSubmit (values) {
            console.log(JSON.stringify(values, null, 2))
            // if (result) {
            //     await this.axios.post('/api/cron-manager/event/insert', {
            //         name: this.name,
            //         event: this.event,
            //         periodicity: this.periodicity
            //     });
            //     await this.$router.push('/')
            // }
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
