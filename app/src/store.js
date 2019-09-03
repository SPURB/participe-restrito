import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		user: {
			logged: true, // process.env.NODE_ENV !== 'production', // true just for development. Go to http://localhost:8080/#/user/foo@bar.com/carnaval2020
			error: false,
			message: '',
			desfiles: []
		},
		form: {
			active: false
		},
		geo: {
			fetched: false,
			percursos: []
		}
	},

	mutations: {
		LOGIN_STATUS: (state, response) => {
			state.user.error = false
			state.user.logged = response.status
			state.user.message = response.message
			state.user.desfiles = response.desfiles
		},
		LOGIN_ERROR: (state, error) => {
			state.user.error = true
			state.user.logged = false
			state.user.message = error
		},
		FORM_STATUS: (state, status) => { state.form.active = status },
		GEO_STATUS: (state, status) => {
			state.geo.fetched = status
		},
		GEO_DATA: (state, percursos) => {
			state.geo.percursos = percursos
		}
	}
})
