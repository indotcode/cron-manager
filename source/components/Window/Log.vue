<template>
    <div v-if="getLogActive" class="log absolute z-50 border dark:border-gray-600 border-solid rounded-md bg-white">
        <div class="flex flex-wrap justify-between">
            <div class="text-xl text-gray-800 font-bold">Журнал</div>
            <div class="flex flex-wrap">
                <svg @click="deleteLogAllAction(getLogIdEvent)" class="ml-2 cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-red-600 hover:fill-red-400" d="M20 6H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2H11C10.2044 2 9.44129 2.31607 8.87868 2.87868C8.31607 3.44129 8 4.20435 8 5V6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7C3 7.26522 3.10536 7.51957 3.29289 7.70711C3.48043 7.89464 3.73478 8 4 8H5V19C5 19.7956 5.31607 20.5587 5.87868 21.1213C6.44129 21.6839 7.20435 22 8 22H16C16.7956 22 17.5587 21.6839 18.1213 21.1213C18.6839 20.5587 19 19.7956 19 19V8H20C20.2652 8 20.5196 7.89464 20.7071 7.70711C20.8946 7.51957 21 7.26522 21 7C21 6.73478 20.8946 6.48043 20.7071 6.29289C20.5196 6.10536 20.2652 6 20 6ZM10 5C10 4.73478 10.1054 4.48043 10.2929 4.29289C10.4804 4.10536 10.7348 4 11 4H13C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V6H10V5ZM17 19C17 19.2652 16.8946 19.5196 16.7071 19.7071C16.5196 19.8946 16.2652 20 16 20H8C7.73478 20 7.48043 19.8946 7.29289 19.7071C7.10536 19.5196 7 19.2652 7 19V8H17V19Z" fill="black"/>
                </svg>
                <svg class="ml-2 cursor-pointer" @click="windowLogCloseAction()" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="hover:fill-black-500" d="M13.4099 12.0002L19.7099 5.71019C19.8982 5.52188 20.004 5.26649 20.004 5.00019C20.004 4.73388 19.8982 4.47849 19.7099 4.29019C19.5216 4.10188 19.2662 3.99609 18.9999 3.99609C18.7336 3.99609 18.4782 4.10188 18.2899 4.29019L11.9999 10.5902L5.70994 4.29019C5.52164 4.10188 5.26624 3.99609 4.99994 3.99609C4.73364 3.99609 4.47824 4.10188 4.28994 4.29019C4.10164 4.47849 3.99585 4.73388 3.99585 5.00019C3.99585 5.26649 4.10164 5.52188 4.28994 5.71019L10.5899 12.0002L4.28994 18.2902C4.19621 18.3831 4.12182 18.4937 4.07105 18.6156C4.02028 18.7375 3.99414 18.8682 3.99414 19.0002C3.99414 19.1322 4.02028 19.2629 4.07105 19.3848C4.12182 19.5066 4.19621 19.6172 4.28994 19.7102C4.3829 19.8039 4.4935 19.8783 4.61536 19.9291C4.73722 19.9798 4.86793 20.006 4.99994 20.006C5.13195 20.006 5.26266 19.9798 5.38452 19.9291C5.50638 19.8783 5.61698 19.8039 5.70994 19.7102L11.9999 13.4102L18.2899 19.7102C18.3829 19.8039 18.4935 19.8783 18.6154 19.9291C18.7372 19.9798 18.8679 20.006 18.9999 20.006C19.132 20.006 19.2627 19.9798 19.3845 19.9291C19.5064 19.8783 19.617 19.8039 19.7099 19.7102C19.8037 19.6172 19.8781 19.5066 19.9288 19.3848C19.9796 19.2629 20.0057 19.1322 20.0057 19.0002C20.0057 18.8682 19.9796 18.7375 19.9288 18.6156C19.8781 18.4937 19.8037 18.3831 19.7099 18.2902L13.4099 12.0002Z" fill="black"/>
                </svg>
            </div>
        </div>
        <div class="log__messages bg-slate-100 rounded-md border dark:border-gray-600 border-solid p-2 h-full overflow-y-auto">
            <div v-for="item in getLog" :key="item.id" class="mb-2">
                <div class="text-sm text-slate-400">{{item.date}}</div>
                <div class="text-sm">{{item.message}}</div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

export default {
    name: 'DialogLog',
    computed: {
        ...mapGetters(['getLog', 'getLogActive', 'getLogIdEvent'])
    },
    methods: {
        ...mapActions(['windowLogCloseAction', 'deleteLogAllAction']),
    }
};
</script>

<style lang="scss">
    .log{
        padding: 20px;
        max-width: 600px;
        height: 500px;
        margin: 0 auto;
        top: 100px;
        left: 0;
        right: 0;
        &__messages{
            margin-top: 15px;
            height: calc(100% - 45px);
        }
    }
</style>
