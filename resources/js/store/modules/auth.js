const state = {
    isAuthenticated: false,
    user           : null,
  };
  
  const mutations = {
    SET_AUTH(state, status) {
      state.isAuthenticated = status;
    },
      
    SET_USER(state, user) {
      state.user = user;
    },
  };
  
  const actions = {
    login({ commit }, userData) {
      commit('SET_AUTH', true);
      commit('SET_USER', userData);
    },
    logout({ commit }) {
      commit('SET_AUTH', false);
      commit('SET_USER', null);
    },
  };
  
  const getters = {
    isAuthenticated: state => state.isAuthenticated,
    user           : state => state.user,
  };
  
  export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
  };
  