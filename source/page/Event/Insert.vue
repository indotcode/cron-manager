<template>
    <div>
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3 flex flex-row content-center flex-wrap">
                <h2 class="text-2xl">Добавление cron задачи</h2>
                <Crumbs :items="[{to: '/', name: 'Список заданий'}, {name: 'Добавление задачи'}]"/>
            </div>
        </div>
        <div>
            <form action="">
                <label class="block mb-3">
                    <span class="text-gray-700">Название</span>
                    <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </label>
                <label class="block mb-3">
                    <span class="text-gray-700">Event файл</span>
                    <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </label>
                <label class="block mb-3">
                    <span class="text-gray-700">Время (сек)</span>
                    <input type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </label>
                <div>
                    <button type="submit" class="px-4 py-2 font-semibold bg-indigo-500 hover:bg-indigo-400 text-sm text-white rounded-full shadow-sm">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Crumbs from './../../components/Crumbs'
export default {
    name: 'PageEventInsert',
    components: {Crumbs},
    data: () => {
        return {

        }
    }
};
</script>

<style>

</style>
