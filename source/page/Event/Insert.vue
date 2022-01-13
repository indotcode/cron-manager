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
                    <Field name="methods" v-model="methods" type="hidden" :rules="methodsRule"/>
                    <span class="text-gray-800 font-bold">Метод <span class="text-red-600">*</span></span>
                    <select v-model="methods" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected disabled hidden value="">Выберите метод</option>
                        <option v-for="(item, id) in getEventMethods" :key="id" :value="item.method">{{item.title}} <span class="text-red-200">(Метод: {{item.method}})</span></option>
                    </select>
                    <ErrorMessage class="text-sm text-red-500" name="methods" />
                </label>

                <label class="block mb-3">
                    <Field name="periodicity" v-model="periodicity" type="hidden" :rules="periodicityRule"/>
                    <span class="text-gray-800 font-bold">Параметры периодичности расписания <span class="text-red-600">*</span></span>
                    <select required v-model="periodicity" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected disabled hidden value="">Выберите период расписания</option>
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

                <template v-if="periodicity === 'twiceDaily'">
                    <PeriodicityTwiceDaily/>
                </template>

                <template v-if="periodicity === 'dailyAt'">
                    <PeriodicityDailyAt/>
                </template>

                <template v-if="periodicity === 'monthlyOn'">
                    <PeriodicityMonthlyOn/>
                </template>

                <FieldTimezone/>

                <FieldRestrictionsDay/>

                <FieldActiveAttempts/>

                <label class="block mb-5">
                    <span class="text-gray-800 font-bold">Описание</span>
                    <Field v-model="description" name="description" v-slot="{ handleChange, handleBlur }">
                        <textarea v-model="description" type="description" placeholder="Краткое описание" @change="handleChange" @blur="handleBlur" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    </Field>
                </label>

                <div class="flex justify-end">
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
export default {
    name: 'PageEventInsert',
    components: {
        Crumbs,
        Form,
        Field,
        ErrorMessage
    },
    data: () => {
        return {
            name: '',
            methods: '',
            periodicity: '',
            description: ''
        }
    },
    computed: {
        ...mapGetters(['getEventMethods', 'getOption', 'getPlanning']),
    },
    async mounted(){
        await this.eventMethodsAction()
        await this.eventOptionAction()
    },
    methods: {
        ...mapActions(['eventMethodsAction', 'eventOptionAction']),
        async onSubmit (values) {
            let data = {}
            data.name = values.name
            data.methods = values.methods
            data.periodicity = values.periodicity
            data.description = values.description
            let params = [];
            if(values.params){
                params = values.params;
            }
            data.periodicity_value = JSON.stringify(params)
            data.restrictions_days = values.restrictionsDay
            data.de_active_attempts = values.de_active_attempts.length === 0 ? 0 : values.de_active_attempts
            if(values.timezone){
                data.timezone = values.timezone;
            }
            await this.axios.post('/api/cron-manager/event/insert', data);
            await this.$router.push('/')
        },
        periodicityRule(value) {
            if(!value){
                return 'Параметр периодичности расписания обязателен для заполнения';
            }
            return true;
        },
        methodsRule(value) {
            if(!value){
                return 'Метод обязателен для заполнения';
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
