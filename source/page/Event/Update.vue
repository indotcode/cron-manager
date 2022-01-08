<template>
    <div>
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3 flex flex-row content-center flex-wrap">
                <h2 class="text-2xl text-gray-800 font-bold">Измене́ние cron задачи</h2>
                <Crumbs :items="[{to: '/', name: 'Список заданий'}, {name: 'Изменить задание'}]"/>
            </div>
        </div>
        <div>
            <div v-on:click="messages = ''" class="text-blue-600 mb-3 cursor-pointer " v-if="messages !== ''">
                {{messages}}
            </div>
            <form action="">
                <label class="block mb-3">
                    <span class="text-gray-800 font-bold">Название <span class="text-red-600">*</span></span>
                    <input v-model="name" @blur="v.name.$commit" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <div class="text-sm text-red-500" v-for="error of v.name.$errors" :key="error.$uid">
                        <template v-if="error.$validator === 'required'">
                            Название обязательно для заполнения
                        </template>
                        <template v-if="error.$validator === 'maxLength'">
                            Максимальное число символов в поле {{error.$params.max}}
                        </template>
                    </div>
                </label>
                <label class="block mb-3">
                    <span class="text-gray-800 font-bold">Event файл <span class="text-red-600">*</span></span>
                    <div class="text-sm text-slate-400">Путь к файлу: {{getOption.path_schedule}}</div>
                    <select v-model="event" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected disabled hidden value="">Выберите файл</option>
                        <option v-for="(file, id) in getEventFile" :key="id" :value="file">{{file}}</option>
                    </select>
                    <span class="text-sm text-red-500" v-if="v.event.$error">
                        Event обязательно для заполнения
                    </span>
                </label>
                <label class="block">
                    <span class="text-gray-800 font-bold">Время (сек) <span class="text-red-600">*</span></span>
                    <input v-model="time" type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="text-sm text-red-500" v-if="v.time.$error">
                        Время обязательно для заполнения
                    </span>
                </label>
                <div class="mt-4">
                    <button v-on:click="submit()" type="submit" class="px-4 py-2 font-semibold bg-indigo-500 hover:bg-indigo-400 text-sm text-white rounded-full shadow-sm">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required, maxLength, numeric } from '@vuelidate/validators'
import { mapActions, mapGetters } from 'vuex'
import Crumbs from './../../components/Crumbs'
export default {
    name: 'PageEventUpdate',
    components: {Crumbs},
    setup () {
        return { v: useVuelidate() }
    },
    data: () => {
        return {
            messages: '',
            name: '',
            event: '',
            time: 1
        }
    },
    validations () {
        return {
            name: { required, maxLength: maxLength(170) },
            event: { required },
            time: {
                required: required,
                numeric: numeric
            }
        }
    },
    computed: {
        ...mapGetters(['getEventFile', 'getOption'])
    },
    async mounted(){
        await this.eventFileAction()
        await this.eventOptionAction()
        const response = await this.axios.post('/api/cron-manager/event/find/'+this.$route.params.id)
        this.name = response.data.name
        this.event = response.data.event
        this.time = response.data.time
    },
    methods: {
        ...mapActions(['eventFileAction', 'eventOptionAction']),
        async submit () {
            const result = await this.v.$validate()
            if (result) {
                await this.axios.post('/api/cron-manager/event/update/'+this.$route.params.id, {
                    name: this.name,
                    event: this.event,
                    time: this.time
                });
                this.messages = 'Задание успешно сохранено.'
            }
        }
    }
};
</script>
