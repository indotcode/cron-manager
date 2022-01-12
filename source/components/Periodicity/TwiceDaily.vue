<template>
    <div class="flex flex-wrap">
        <label class="pr-4 mb-3 w-4/12">
            <span class="text-gray-800 font-bold">Час <span class="text-red-600">*</span></span>
            <Field placeholder="Введите час" v-model="params[0]" name="params[0]" type="number" :rules="rules"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <ErrorMessage class="text-sm text-red-500" name="params[0]" />
        </label>
        <label class="pr-4 mb-3 w-4/12">
            <span class="text-gray-800 font-bold">Час <span class="text-red-600">*</span></span>
            <Field placeholder="Введите час" v-model="params[1]" name="params[1]" type="number" :rules="rules"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <ErrorMessage class="text-sm text-red-500" name="params[1]" />
        </label>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
export default {
    name: 'PeriodicityTwiceDaily',
    components: {Form, Field, ErrorMessage},
    props: {
        value: {
            type: String
        }
    },
    data(){
        return {
            params: [
                '',
                ''
            ]
        }
    },
    mounted() {
        if(this.value){
            const arr = JSON.parse(this.value)
            if(arr.length !== 0){
                this.params = arr
            }
        }
    },
    methods: {
        rules(value) {
            if(!value){
                return 'Час суток обязателен для заполнения';
            }
            if(value < 0){
                return 'Минимальная час в сутках 0';
            }
            if(value > 29){
                return 'Максимальная час в сутках 23';
            }
            return true;
        }
    }
};
</script>
