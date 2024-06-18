require('./bootstrap');

import { createApp } from 'vue';
import App from './App.vue';
import User from './components/User/ListUser.vue';

const app = createApp(User);

app.mount("#app");
