<template>
    <div>
        <label class="block mb-3">
            <span class="text-gray-800 font-bold">Число попыток </span>
            <div class="text-sm text-slate-400">При привышении количества неудачных попыток срабатывает отключения задача (0 бесконечно)</div>
            <Field name="de_active_attempts" v-model="de_active_attempts" type="number" :rules="rules" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <ErrorMessage class="text-sm text-red-500" name="de_active_attempts" />
        </label>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
export default {
    name: 'FieldActiveAttempts',
    components: {Form, Field, ErrorMessage},
    props: {
        value: {
            type: Number
        }
    },
    data(){
        return {
            de_active_attempts: 0
        }
    },
    mounted() {
        if(this.value){
            this.de_active_attempts = this.value
        }
    },
    methods: {
        rules(value) {
            if(!value){
                return 'Значение должно быть 0 или больше.';
            }
            if(value < 0){
                return 'Не допустимое значения.';
            }
            if(value > 10){
                return 'Максимальное количество попыток 10';
            }
            return true;
        }
    }
};
</script>
