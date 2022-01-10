<template>
    <div class="flex flex-wrap">
        <label class="pr-4 w-4/12">
            <span class="text-gray-800 font-bold">День месяца <span class="text-red-600">*</span></span>
            <Field placeholder="Введите день" name="params[0]" type="number" :rules="roles"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <ErrorMessage class="text-sm text-red-500" name="params[0]" />
        </label>
        <label class="pr-4 w-4/12">
            <span class="text-gray-800 font-bold">Время <span class="text-red-600">*</span></span>
            <Field placeholder="Введите время" name="params[1]" type="time" :rules="roles2"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <ErrorMessage class="text-sm text-red-500" name="params[1]" />
        </label>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
export default {
    name: 'PeriodicityTwiceDaily',
    components: {Form, Field, ErrorMessage},
    methods: {
        roles(value) {
            if(!value){
                return 'День месяца обязателен для заполнения';
            }
            if(value < 0){
                return 'Минимальная день месяца 0';
            }
            if(value > 29){
                return 'Максимальная день месяца 29';
            }
            return true;
        },
        roles2(value) {
            if(!value){
                return 'Время обязательно для заполнения';
            }
            return true;
        }
    }
};
</script>
