//require('./bootstrap');

import { createApp } from 'vue';
import App from "./App.vue";
import router from "./routes";
import ViewUIPlus from 'view-ui-plus'
import 'view-ui-plus/dist/styles/viewuiplus.css'


// Add Mixins
import ApiMixin from './mixins/apiMixin.js';
import NoticeMixin from './mixins/noticeMixin.js';
import ValidateMixin from './mixins/validateMixin.js';

const app = createApp(App);

app.use(router);
app.use(ViewUIPlus);
app.mixin(ApiMixin);
app.mixin(NoticeMixin);
app.mixin(ValidateMixin);
app.mount('#app');
