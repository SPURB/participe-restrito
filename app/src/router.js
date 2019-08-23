import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/views/Home'
import store from './store.js'

Vue.use(Router)

const router = new Router({
	routes: [
		{
			path: '/',
			name: 'Home',
			component: Home,
			children: [
				{
					path: 'cadastro',
					name: 'cadastro',
					component: () => import(/* webpackChunkName: "cadastro" */ './views/Cadastro.vue')
				}
			]
		},
		{
			path: '/user',
			name: 'user',
			component: () => import(/* webpackChunkName: "user" */ './views/User.vue'),
			children: [
				{
					path: ':email',
					name: 'userLogged',
					component: () => import(/* webpackChunkName: "userLogged" */ './views/userLogged.vue'),
					meta: { requiresAuth: true },
					children: [
						{
							path: 'carnaval2020',
							name: 'Carnaval 2020',
							component: () => import(/* webpackChunkName: "carnaval2020" */ './views/consultas/Carnaval2020.vue')
						}
					]
				}
			]
		},

		{
			name: '404',
			path: '/404',
			component: () => import(/* webpackChunkName: "404" */ './views/404.vue')
		}
	]
})

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth)) {
		if (!store.state.user.logged) {
			next({ path: '/404' })
		} else {
			next()
		}
	} else {
		next()
	}
})

export default router
