<template>
    <div>
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3">
                <h2 class="text-2xl">Задачи cron</h2>
            </div>
            <div class="mb-3">
                <button class="px-4 py-2 font-semibold bg-indigo-500 text-sm text-white rounded-full shadow-sm">Добавить задание</button>
            </div>
        </div>

        <table class="border-collapse border table-fixed w-full text-sm">
            <thead>
            <tr>
                <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-left">ID</th>
                <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-left">Название</th>
                <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-left">Event файл</th>
                <th class="border-b dark:border-gray-600 font-medium p-4 text-gray-400 dark:text-gray-200 text-right">Опции</th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
            <tr>
                <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400">1</td>
                <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400">Malcolm Lockyer</td>
                <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400">1961</td>
                <td class="border-b border-gray-100 dark:border-gray-700 p-4 text-gray-500 dark:text-gray-400 text-right">

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
    mounted() {
        this.axios.get('/cron-manager/api/list').then(response => {
            console.log(response)
        })
    }
};
</script>

<style>

</style>
