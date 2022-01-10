<template>
    <div>
        <label class="block mb-3">
            <span class="text-gray-800 font-bold">Часовой пояс</span>
            <Field placeholder="America/New_York" name="timezone" v-model="timezone" type="text"  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
        </label>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage} from 'vee-validate';
export default {
    name: 'FieldTimezone',
    components: {Form, Field, ErrorMessage},
    props: {
        value: {
            type: String
        }
    },
    data(){
        return {
            timezone: ''
        }
    },
    mounted() {
        if(this.value){
            if(this.value.length !== 0){
                this.timezone = this.value
            }
        }
    }
};
</script>
