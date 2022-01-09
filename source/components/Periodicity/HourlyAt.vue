<template>
    <div class="flex flex-wrap">
        <label class="pr-4 w-4/12">
            <span class="text-gray-800 font-bold">Минута часа <span class="text-red-600">*</span></span>
            <Field placeholder="Введите минуту" name="params[0]" type="number" :rules="roles"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <ErrorMessage class="text-sm text-red-500" name="params[0]" />
        </label>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
export default {
    name: 'PeriodicityHourlyAt',
    components: {Form, Field, ErrorMessage},
    methods: {
        roles(value) {
            if(!value){
                return 'Минута часа обязательна для заполнения';
            }
            if(value < 1){
                return 'Минимальная минута часа 1';
            }
            if(value > 59){
                return 'Максимальная минута часа 59';
            }
            return true;
        }
    }
};
</script>
