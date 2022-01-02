<template>
    <div>
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3 flex flex-row content-center flex-wrap">
                <h2 class="text-2xl text-gray-800 font-bold">Измене́ние cron задачи</h2>
                <Crumbs :items="[{to: '/', name: 'Список заданий'}, {name: 'Изменить задание'}]"/>
            </div>
        </div>
        <div>
            <div v-on:click="messages = ''" class="text-blue-600 mb-3 cursor-pointer" v-if="messages !== ''">
                {{messages}}
            </div>
            <form action="">
                <label class="block mb-3">
                    <span class="text-gray-800 font-bold">Название</span>
                    <input v-model="name" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <div class="text-sm text-red-500" v-if="valid.name.$error">
                        Название обязательно для заполнения
                    </div>
                </label>
                <label class="block mb-3">
                    <span class="text-gray-800 font-bold">Event файл</span>
                    <input v-model="event" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="text-sm text-red-500" v-if="valid.event.$error">
                        Event обязательно для заполнения
                    </span>
                </label>
                <label class="block">
                    <span class="text-gray-800 font-bold">Время (сек)</span>
                    <input v-model="time" type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="text-sm text-red-500" v-if="valid.time.$error">
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
import { required, minValue, maxValue, numeric } from '@vuelidate/validators'
import Crumbs from './../../components/Crumbs'
export default {
    name: 'PageEventUpdate',
    components: {Crumbs},
    setup () {
        return { valid: useVuelidate() }
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
            name: { required },
            event: { required },
            time: {
                required: required,
                numeric: numeric
            }
        }
    },
    async mounted(){
        const response = await this.axios.post('/cron-manager/api/event/find/'+this.$route.params.id)
        this.name = response.data.name
        this.event = response.data.event
        this.time = response.data.time
    },
    methods: {
        async submit () {
            const result = await this.valid.$validate()
            if (result) {
                await this.axios.post('/cron-manager/api/event/update/'+this.$route.params.id, {
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
