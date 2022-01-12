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
                    <Form @submit="onSubmit" v-slot="slot">
                        <label class="block mb-3">
                            <span class="text-gray-800 font-bold">Часовой пояс</span>
                            <div class="text-sm text-slate-400">Пример: America/New_York</div>
                            <Field v-model="form.timezone" name="timezone" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </label>
                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="px-4 py-2 font-semibold bg-indigo-500 hover:bg-indigo-400 text-sm text-white rounded-full shadow-sm">Сохранить</button>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {ErrorMessage, Field, Form} from "vee-validate";

export default {
    name: 'PageOptionMain',
    components: {Form, Field, ErrorMessage},
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
                timezone: ''
            }
        }
    },
    async mounted() {
        this.initClassLink(this.$route.path)
        const response = await this.axios.post('/api/cron-manager/option/select')
        this.form.timezone = response.data.find(v => v.key === 'timezone').value
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
        async onSubmit (values) {
            const response = await this.axios.post('/api/cron-manager/option/select');
            const option = response.data;
            for(let key in values){
                let value = values[key]
                if(value.length !== 0){
                    let id = option.find(v => v.key === key).id;
                    await this.axios.post('/api/cron-manager/option/update/'+id, {
                        value: value
                    });
                }
            }
            this.messages = 'Настройки успешно сохранены.'
            setTimeout(() => {
                this.messages = ''
            }, 2000)
        },
        roles(value) {
            if(!value){
                return 'required';
            }
            return true;
        }
    }
};
</script>
