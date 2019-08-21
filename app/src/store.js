import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		user: {
			logged: false, // set true to development and go to http://localhost:8080/#/user/foo@bar.com/carnaval2020
			error: false,
			message: ''
		}
	},
	mutations: {
		LOGIN_STATUS: (state, response) => {
			state.user.error = false
			state.user.logged = response.status
			state.user.message = response.message
		},
		LOGIN_ERROR: (state, error) => {
			state.user.error = true
			state.user.logged = false
			state.user.message = error
		}
	}
})
