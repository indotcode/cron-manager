import { createApp } from 'vue';
import App from './components/App.vue';

const app = createApp(App);
app.config.performance = true;
app.config.devtools = true
app.mount('#cronManager');
