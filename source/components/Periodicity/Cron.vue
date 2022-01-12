<template>
    <div class="flex flex-wrap">
        <label class="pr-4 mb-3 w-4/12">
            <span class="text-gray-800 font-bold">Тайминг cron <span class="text-red-600">*</span></span>
            <Field placeholder="* * * * *" v-model="params[0]" name="params[0]" type="text" :rules="rules"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <ErrorMessage class="text-sm text-red-500" name="params[0]" />
        </label>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
export default {
    name: 'PeriodicityCron',
    components: {Form, Field, ErrorMessage},
    props: {
        value: {
            type: String
        }
    },
    data(){
        return {
            params: [
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
                return 'Тайминг cron обязателен для заполнения';
            }
            return true;
        }
    }
};
</script>
