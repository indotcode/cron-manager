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
                            <span class="text-gray-800 font-bold">Путь до файлов заданий <span class="text-red-600">*</span></span>
                            <input v-model="form.path_schedule" required type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </label>
                        <label class="block mb-3">
                            <span class="text-gray-800 font-bold">Пространство имен файлов заданий <span class="text-red-600">*</span></span>
                            <input v-model="form.namespace" required type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
export default {
    name: 'PageOptionMain',
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
                path_schedule: '',
                namespace: ''
            }
        }
    },
    async mounted() {
        this.initClassLink(this.$route.path)
        const response = await this.axios.post('/api/cron-manager/option/select')
        this.form.path_schedule = response.data.find(v => v.key === 'path_schedule').value
        this.form.namespace = response.data.find(v => v.key === 'namespace').value
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
            const response = await this.axios.post('/api/cron-manager/option/select');
            const option = response.data;
            for(let key in this.form){
                let value = this.form[key]
                let id = option.find(v => v.key === key).id;
                await this.axios.post('/api/cron-manager/option/update/'+id, {
                    value: value
                });
            }
            this.messages = 'Настройки успешно сохранены.'
        },
        roles_path_schedule(value) {
            if(!value){
                return 'Тайминг cron обязателен для заполнения';
            }
            return true;
        },
        roles_namespace(value) {
            if(!value){
                return 'Тайминг cron обязателен для заполнения';
            }
            return true;
        }
    }
};
</script>

<style>

</style>
