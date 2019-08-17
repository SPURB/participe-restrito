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
					path: ':id',
					name: 'userId',
					component: () => import(/* webpackChunkName: "UserId" */ './views/UserId.vue'),
					meta: { requiresAuth: true },
					children: [
						{
							path: 'carnaval2020',
							name: 'carnaval2020',
							component: () => import(/* webpackChunkName: "carnaval2020" */ './views/consultas/Carnaval2020.vue'),
							meta: { id: 100 }
						},
						{
							path: 'outra',
							name: 'Outra',
							component: () => import(/* webpackChunkName: "outra" */ './views/consultas/Outra.vue'),
							meta: { id: 101 }
						}
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
		if (!store.state.logged) {
			next({
				path: '/'
			})
		} else {
			next()
		}
	} else {
		next()
	}
})

export default router
