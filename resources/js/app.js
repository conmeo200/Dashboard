//require('./bootstrap');

import { createApp } from 'vue';
import App from "./App.vue";
import router from "./routes";
import ViewUIPlus from 'view-ui-plus'
import 'view-ui-plus/dist/styles/viewuiplus.css'


// Add Mixins
import axios from 'axios';
import { requestInterceptor, responseInterceptor, errorInterceptor } from './interceptors';

import ApiMixin from './mixins/apiMixin.js';
import NoticeMixin from './mixins/noticeMixin.js';
import ValidateMixin from './mixins/validateMixin.js';

// Import Vuex Store
import store from './store';

const app = createApp(App);

app.use(router);
app.use(ViewUIPlus);
app.use(store); // Sử dụng Vuex Store

axios.interceptors.request.use(requestInterceptor);
axios.interceptors.response.use(responseInterceptor, errorInterceptor);

app.mixin(ApiMixin);
app.mixin(NoticeMixin);
app.mixin(ValidateMixin);
app.mount('#app');
