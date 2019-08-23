import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VeeValidate, { Validator } from 'vee-validate'
import ptbr from 'vee-validate/dist/locale/pt_BR'

Vue.config.productionTip = false

Vue.use(VeeValidate, { inject: false }) // para não injetar em todos os componentes
Validator.localize('pt_br', ptbr)

new Vue({
	router,
	store,
	render: h => h(App)
}).$mount('#app')
