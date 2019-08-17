import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		logged: false
	},
	mutations: {
		LOGIN_STATUS (state, status) { state.logged = status }
	},
	actions: {
	}
})
