<template>
    <div>
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3">
                <h2 class="text-2xl text-gray-800 font-bold">Список заданий</h2>
            </div>
            <div class="mb-3">
                <router-link class="px-4 py-2 font-semibold bg-indigo-500 hover:bg-indigo-400 text-sm text-white rounded-full shadow-sm" to="/event/insert">Добавить задание</router-link>
            </div>
        </div>

        <table class="border-collapse border table-fixed w-full text-sm">
            <thead>
                <tr>
                    <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-left">ID</th>
                    <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-left">Название</th>
                    <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-left">Event файл</th>
                    <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-left">Время (сек)</th>
                    <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-right">Опции</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
                <tr v-for="item in items" :key="item.id">
                    <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400 text-left">{{item.id}}</td>
                    <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400 text-left">{{item.name}}</td>
                    <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400 text-left">{{item.event}}</td>
                    <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400 text-left">{{item.time}}</td>
                    <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400 text-right">
                        <div class="flex flex-wrap justify-end">
                            <svg v-on:click="editEvent(item.id)" class="mx-2 cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="fill-blue-600 hover:fill-blue-400" d="M22 7.24002C22.0008 7.10841 21.9756 6.97795 21.9258 6.85611C21.876 6.73427 21.8027 6.62346 21.71 6.53002L17.47 2.29002C17.3766 2.19734 17.2658 2.12401 17.1439 2.07425C17.0221 2.02448 16.8916 1.99926 16.76 2.00002C16.6284 1.99926 16.4979 2.02448 16.3761 2.07425C16.2543 2.12401 16.1435 2.19734 16.05 2.29002L13.22 5.12002L2.29002 16.05C2.19734 16.1435 2.12401 16.2543 2.07425 16.3761C2.02448 16.4979 1.99926 16.6284 2.00002 16.76V21C2.00002 21.2652 2.10537 21.5196 2.29291 21.7071C2.48045 21.8947 2.7348 22 3.00002 22H7.24002C7.37994 22.0076 7.51991 21.9857 7.65084 21.9358C7.78176 21.8858 7.90073 21.8089 8.00002 21.71L18.87 10.78L21.71 8.00002C21.8013 7.9031 21.8757 7.79155 21.93 7.67002C21.9397 7.59031 21.9397 7.50973 21.93 7.43002C21.9347 7.38347 21.9347 7.33657 21.93 7.29002L22 7.24002ZM6.83002 20H4.00002V17.17L13.93 7.24002L16.76 10.07L6.83002 20ZM18.17 8.66002L15.34 5.83002L16.76 4.42002L19.58 7.24002L18.17 8.66002Z" fill="black"/>
                            </svg>
                            <svg v-on:click="deleteEvent(item.id)" class="mx-2 cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="fill-red-600 hover:fill-red-400" d="M20 6H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2H11C10.2044 2 9.44129 2.31607 8.87868 2.87868C8.31607 3.44129 8 4.20435 8 5V6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7C3 7.26522 3.10536 7.51957 3.29289 7.70711C3.48043 7.89464 3.73478 8 4 8H5V19C5 19.7956 5.31607 20.5587 5.87868 21.1213C6.44129 21.6839 7.20435 22 8 22H16C16.7956 22 17.5587 21.6839 18.1213 21.1213C18.6839 20.5587 19 19.7956 19 19V8H20C20.2652 8 20.5196 7.89464 20.7071 7.70711C20.8946 7.51957 21 7.26522 21 7C21 6.73478 20.8946 6.48043 20.7071 6.29289C20.5196 6.10536 20.2652 6 20 6ZM10 5C10 4.73478 10.1054 4.48043 10.2929 4.29289C10.4804 4.10536 10.7348 4 11 4H13C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V6H10V5ZM17 19C17 19.2652 16.8946 19.5196 16.7071 19.7071C16.5196 19.8946 16.2652 20 16 20H8C7.73478 20 7.48043 19.8946 7.29289 19.7071C7.10536 19.5196 7 19.2652 7 19V8H17V19Z" fill="black"/>
                            </svg>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: 'PageHome',
    data: () => {
        return {
            items: []
        }
    },
    async mounted() {
        const response = await this.axios.post('/cron-manager/api/event/select');
        this.items = response.data;
    },
    methods: {
        async deleteEvent(id){
            await this.axios.post('/cron-manager/api/event/delete/'+id)
            const response = await this.axios.post('/cron-manager/api/event/select');
            this.items = response.data;
        },
        async editEvent(id){
            await this.$router.push('/event/update/' + id)
        }
    }
};
</script>

<style>

</style>
