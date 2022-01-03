<template>
    <div>
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3 flex flex-row content-center flex-wrap">
                <h2 class="text-2xl text-gray-800 font-bold">Настройки</h2>
            </div>
        </div>
        <div>
            <div class="flex flex-wrap">
                <div class="w-60 h-96 border-r border-stone-100 min-h-full">
                    <div v-for="item in menu_option" :key="item.id">
                        <router-link v-bind:class="['block p-3 text-gray-800 font-bold', item.class]" :to="item.to">
                            {{item.name}}
                        </router-link>
                    </div>
                </div>
                <div class="grow min-h-full py-3 px-4">
                    <div v-on:click="messages = ''" class="text-blue-600 mb-3 cursor-pointer " v-if="messages !== ''">
                        {{messages}}
                    </div>
                    <form action="">
                        <label class="block mb-3">
                            <span class="text-gray-800 font-bold">Путь до папки с заданиями <span class="text-red-600">*</span></span>
                            <input v-model="form.path_schedule" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <div class="text-sm text-red-500" v-if="valid.form.path_schedule.$error">
                                Путь до папки с заданиями обязательно для заполнения
                            </div>
                        </label>
                        <div class="mt-4">
                            <button v-on:click="submit()" type="submit" class="px-4 py-2 font-semibold bg-indigo-500 hover:bg-indigo-400 text-sm text-white rounded-full shadow-sm">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {required} from "@vuelidate/validators";

export default {
    name: 'PageOptionMain',
    setup () {
        return { valid: useVuelidate() }
    },
    data: () => {
        return {
            menu_option: [
                {
                    id: 1,
                    name: 'Основные',
                    to: '/option'
                }
            ],
            messages: '',
            form: {
                path_schedule: ''
            }
        }
    },
    validations () {
        return {
            form: {
                path_schedule: { required }
            }
        }
    },
    async mounted() {
        this.initClassLink(this.$route.path)
        const response = await this.axios.post('/cron-manager/api/option/select')
        this.form.path_schedule = response.data.find(v => v.key === 'path_schedule').value
    },
    watch: {
        '$route' (to, from) {
            this.initClassLink(to.path)
        }
    },
    methods: {
        initClassLink(path){
            this.menu_option.map(item => {
                item.class = path === item.to ? 'bg-slate-50 border-l border-t border-b border-stone-100' : 'bg-white'
                return item
            })
        },
        async submit () {
            const result = await this.valid.$validate()
            if (result) {
                const response = await this.axios.post('/cron-manager/api/option/select');
                const option = response.data;
                for(let key in this.form){
                    let value = this.form[key]
                    let id = option.find(v => v.key === key).id;
                    await this.axios.post('/cron-manager/api/option/update/'+id, {
                        value: value
                    });
                }
                this.messages = 'Настройки успешно сохранены.'
            }
        }
    }
};
</script>

<style>

</style>
