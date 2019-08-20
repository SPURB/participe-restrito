import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/views/Login'
import store from './store.js'

Vue.use(Router)

const router = new Router({
	routes: [
		{
			path: '/',
			name: 'login',
			component: Login
		},
		{
			path: '/user',
			name: 'user',
			component: () => import(/* webpackChunkName: "user" */ './views/User.vue'),
			children: [
				{
					path: ':email',
					name: 'userEmail',
					component: () => import(/* webpackChunkName: "UserEmail" */ './views/UserEmail.vue'),
					meta: { requiresAuth: true },
					children: [
						{
							path: 'carnaval2020',
							name: 'Carnaval 2020',
							component: () => import(/* webpackChunkName: "carnaval2020" */ './views/consultas/Carnaval2020.vue')
						}
						// ,{
						// 	path: 'outra',
						// 	name: 'Outra',
						// 	component: () => import(/* webpackChunkName: "outra" */ './views/consultas/Outra.vue'),
						// }
					]
				}
			]
		},

		{
			name: '404',
			path: '*',
			redirect: '/'
		}
	]
})

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth)) {
		if (!store.state.user.logged) {
			next({ path: '/' })
		} else {
			next()
		}
	} else {
		next()
	}
})

export default router
