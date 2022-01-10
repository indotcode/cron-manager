<template>
    <div class="p-6">
        <div class="flex flex-wrap ">
            <div v-for="item in menu" :key="item.id" v-bind:class="[item.id === 1 ? 'mr-3' : '', 'mb-3']">
                <router-link v-bind:class="['block px-4 py-2 font-semibold text-sm text-white rounded-full shadow-sm', item.class]" :to="item.to">
                    {{item.name}}
                </router-link>
            </div>
        </div>
        <div class="App mt-3">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: 'App',
    data: () => {
        return {
            menu: [
                {
                    id: 1,
                    name: 'Список заданий',
                    to: '/'
                },
                {
                    id: 2,
                    name: 'Настройки',
                    to: '/option'
                }
            ]
        }
    },
    async mounted() {
        await this.planningAction()
    },
    methods: {
        ...mapActions(['planningAction']),
    },
    watch: {
        '$route' (to, from) {
            this.menu.map(item => {
                item.class = to.path === item.to ? 'bg-gray-900' : 'bg-indigo-500'
                return item
            })
        }
    }
};
</script>

<style>

</style>
