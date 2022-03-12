import Vuex from 'vuex';
import VuexPersistence from 'vuex-persist'

const vuexLocal = new VuexPersistence({
  storage: window.localStorage
})

const store = new Vuex.Store({
  plugins: [vuexLocal.plugin],
  state: {
    token: '',
    email: ''
  },
  mutations: {
    saveToken: (state, token: string) => {
      state.token = token;
    },
    saveEmail: (state, email: string) => {
      state.email = email;
    }
  },
  getters: {
    getToken: (state) => {
      return state.token;
    },
    getEmail: (state) => {
      return state.email;
    }
  }
});

export default store;