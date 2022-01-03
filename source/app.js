import { createApp } from 'vue'
import App from './App.vue'
import store from './store/index'
import router from "./router/index";
import axios from './axios'
import VueAxios from 'vue-axios'

const app = createApp(App)
app.config.devtools = true
app.use(VueAxios, axios)
app.use(store)
app.use(router)
app.mount('#cronManager')
