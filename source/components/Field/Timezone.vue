<template>
    <div>
        <label class="block py-2 mb-2 items-center">
            <input type="checkbox" v-model="timezone_checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 " checked="">
            <span class="ml-2">Установить часовой пояс для задачи</span>
        </label>
        <label class="block mb-3" v-if="timezone_checkbox">
            <span class="text-gray-800 font-bold">Часовой пояс <span class="text-red-600">*</span></span>
            <Field placeholder="America/New_York" name="timezone" v-model="timezone" type="text" :rules="roles"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <ErrorMessage class="text-sm text-red-500" name="timezone" />
        </label>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
export default {
    name: 'FieldTimezone',
    components: {Form, Field, ErrorMessage},
    data(){
        return {
            timezone: '',
            timezone_checkbox: false
        }
    },
    methods: {
        roles(value) {
            if(!value){
                return 'Часовой пояс обязателен для заполнения';
            }
            return true;
        }
    }
};
</script>
