<template>
    <div class="mt-3 flex flex-wrap">
        <template v-for="(type, id) in fieldsType" :key="id">
            <template v-if="type.template === 'text.cron'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">Тайминг cron <span class="text-red-600">*</span></span>
                    <input placeholder="* * * * *" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </label>
            </template>
            <template v-if="type.template === 'text.time'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">Время <span class="text-red-600">*</span></span>
                    <input placeholder="Введите время" type="time" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </label>
            </template>
            <template v-if="type.template === 'number.minute'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">Минута часа <span class="text-red-600">*</span></span>
                    <input placeholder="Введите минуту" type="number" max="60" min="1" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </label>
            </template>
            <template v-if="type.template === 'number.hour'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">Час <span class="text-red-600">*</span></span>
                    <input placeholder="Введите час" type="number" max="24" min="1" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </label>
            </template>
        </template>
    </div>
</template>

<script>
export default {
    name: 'Periodicity',
    props: {
        fields: {
            type: Array,
            require: true
        }
    },
    mounted() {

    },
    computed: {
        fieldsType(){
            return this.fields.map(item => {
                item.template = item.type + '.' + item.view
                return item;
            })
        }
    },
    watch: {

    }
};
</script>
