import { createStore } from 'vuex';
import auth from './modules/auth';  // Import module auth

const store = createStore({
  modules: {
    auth  // Thêm module auth vào Vuex store
  },
});

export default store;
