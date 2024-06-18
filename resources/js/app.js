require('./bootstrap');

// Import JS
import './material-dashboard.min';
import './core/bootstrap.bundle.min';
import './core/bootstrap.min';
import './core/popper.min';
import './core/popper.min.js';
import './core/bootstrap.min.js';
import './plugins/perfect-scrollbar.min.js';
import './plugins/smooth-scrollbar.min.js';

// Import Css
import '../css/nucleo-icons.css';
import '../css/nucleo-svg.css';
import '../css/material-dashboard.css';

// Import Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'bootstrap/dist/css/bootstrap.css';

import { createApp } from 'vue';
import App from "./App.vue";
import router from "./routes";

const app = createApp(App);

app.use(router);

app.mount('#app');
