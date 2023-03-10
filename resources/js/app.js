import './bootstrap';

import { createApp } from 'vue';
import router from './app-config/router';
import store from './app-config/store';
import App from './App.vue';
const app = createApp(App);
app.use(router);
app.use(store);
app.mount('#app');
