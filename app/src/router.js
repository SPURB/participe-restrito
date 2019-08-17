import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/views/Login'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/',
			name: 'login',
			component: Login
		},

		{
			name: 'Carnaval 2020',
			path: '/carnaval2020',
			component: () => import(/* webpackChunkName: "carnaval2020" */ './views/Carnaval2020.vue'),
			meta: {
				id: 100
			},
			children: [
				{
					path: ':idUser',
					component: () => import(/* webpackChunkName: "user" */ './views/User.vue'),
					meta: {
						requiresAuth: true
					},
					beforeEach: (to, from, next) => {
						console.log(to)
					}
				}
			]
		}
	]
})
