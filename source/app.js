import { createApp } from 'vue'
import App from './App.vue'
import store from './store/index'
import router from "./router/index";
import axios from './axios'
import VueAxios from 'vue-axios'
import PeriodicityCron from './components/Periodicity/Cron'
import PeriodicityHourlyAt from './components/Periodicity/HourlyAt'
import PeriodicityTwiceDaily from './components/Periodicity/TwiceDaily'
import PeriodicityDailyAt from './components/Periodicity/DailyAt'
import PeriodicityMonthlyOn from './components/Periodicity/MonthlyOn'
import FieldTimezone from './components/Field/Timezone'
import FieldRestrictionsDay from './components/Field/RestrictionsDay'

const global_components = {
    PeriodicityCron,
    PeriodicityHourlyAt,
    PeriodicityTwiceDaily,
    PeriodicityDailyAt,
    PeriodicityMonthlyOn,
    FieldTimezone,
    FieldRestrictionsDay
}

const app = createApp(App)
app.config.devtools = true
Object.entries(global_components).forEach(([name, component]) => app.component(name, component))
app.use(VueAxios, axios)
app.use(store)
app.use(router)
app.mount('#cronManager')

