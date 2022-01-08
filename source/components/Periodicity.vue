<template>
    <div class="mt-3 flex flex-wrap">
        <template v-for="(type, id) in fieldsType" :key="id">
            <template v-if="type.template === 'text_cron'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">Тайминг cron <span class="text-red-600">*</span></span>
                    <input v-model="value[id]" placeholder="* * * * *" type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="text-sm text-red-500" v-if="v.value[id].$error">
                        Тайминг cron обязательно для заполнения
                    </span>
                </label>
            </template>
            <template v-if="type.template === 'text_time'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">Время <span class="text-red-600">*</span></span>
                    <input v-model="value[id]" placeholder="Введите время" type="time" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="text-sm text-red-500" v-if="v.value[id].$error">
                        Время обязательно для заполнения
                    </span>
                </label>
            </template>
            <template v-if="type.template === 'number_minute'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">Минута часа <span class="text-red-600">*</span></span>
                    <input v-model="value[id]" placeholder="Введите минуту" type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <div class="text-sm text-red-500" v-for="error of v.value[id].$errors" :key="error.$uid">
                        <template v-if="error.$validator === 'required'">
                            Минута обязательно для заполнения
                        </template>
                        <template v-if="error.$validator === 'maxValue'">
                            Максимальная минута в часе {{error.$params.max}}
                        </template>
                        <template v-if="error.$validator === 'minValue'">
                            Минимальная минута в часе {{error.$params.min}}
                        </template>
                    </div>
                </label>
            </template>
            <template v-if="type.template === 'number_day'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">День месяца <span class="text-red-600">*</span></span>
                    <input v-model="value[id]" placeholder="Введите день" type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <div class="text-sm text-red-500" v-for="error of v.value[id].$errors" :key="error.$uid">
                        <template v-if="error.$validator === 'required'">
                            День месяца обязательно для заполнения
                        </template>
                        <template v-if="error.$validator === 'maxValue'">
                            Максимальный день месяца {{error.$params.max}}
                        </template>
                        <template v-if="error.$validator === 'minValue'">
                            Минимальный день месяца {{error.$params.min}}
                        </template>
                    </div>
                </label>
            </template>
            <template v-if="type.template === 'number_hour'">
                <label class="pr-4 w-4/12">
                    <span class="text-gray-800 font-bold">Час <span class="text-red-600">*</span></span>
                    <input v-model="value[id]" placeholder="Введите час" type="number" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <div class="text-sm text-red-500" v-for="error of v.value[id].$errors" :key="error.$uid">
                        <template v-if="error.$validator === 'required'">
                            Час обязательно для заполнения
                        </template>
                        <template v-if="error.$validator === 'maxValue'">
                            Максимальный час {{error.$params.max}}
                        </template>
                        <template v-if="error.$validator === 'minValue'">
                            Минимальный час {{error.$params.min}}
                        </template>
                    </div>
                </label>
            </template>
        </template>
    </div>
</template>

<script>
import {maxValue, minValue, required} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";

export default {
    name: 'Periodicity',
    setup () {
        return { v: useVuelidate() }
    },
    props: {
        fields: {
            type: Array,
            required: true
        }
    },
    validations () {
        let validate = [];
        this.fields.forEach((v, i) => {
            let valid = {}
            valid.required = required
            switch (v.template){
                case 'text_cron':
                    break;
                case 'text_time':
                    break;
                case 'number_minute':
                    valid.maxValue = maxValue(59)
                    valid.minValue = minValue(1)
                    break;
                case 'number_day':
                    valid.maxValue = maxValue(30)
                    valid.minValue = minValue(1)
                    break;
                case 'number_hour':
                    valid.maxValue = maxValue(24)
                    valid.minValue = minValue(1)
                    break;
            }
            validate[i] = valid;
        })
        return {
            value: validate
        }
    },
    data: () => {
        return {
            value: [],
        }
    },
    computed: {
        fieldsType(){
            return this.fields.map(item => {
                item.template = item.type + '_' + item.view
                return item;
            })
        }
    },
    watch: {
        // v: (e) => {
        //     console.log(e)
        // }
    }
};
</script>
