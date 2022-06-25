import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersistence from 'vuex-persist';

Vue.use(Vuex);

const vuexLocal = new VuexPersistence({
	storage: window.localStorage,
});

export default new Vuex.Store({
	state: {
		auth: {
			id: '',
			email: '',
			token: '',
			isLogin: false,
            name: ''
		},

	},
	mutations: {
		setLogin(state, payload = state.auth) {
			state.auth.id = payload.id;
			state.auth.email = payload.email;
			state.auth.token = payload.token;
			state.auth.isLogin = payload.isLogin;
            state.auth.name = payload.name;
		},
		logoutUser(state, payload = {
			id: '',
			email: '',
			token: '',
			isLogin: false,
            name: ''
		}) {
			state.auth = payload;
		}
	},
	actions: {
		setLogin(state, payload) {
			state.commit('setLogin', payload);
		},
        logout(state){
            state.commit('logoutUser');
        }
	},
	getters: {
		getAuth: (state) => state.auth,
		getEmail: (state) => state.auth.email,
		getRole: (state) => state.auth.role,
	},
	plugins: [vuexLocal.plugin],
});
