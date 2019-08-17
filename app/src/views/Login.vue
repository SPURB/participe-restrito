<template>
	<div class="login">
		<form class="login__form" action="login" @submit.prevent="checkUser">
			<label class="login__label" for="email" type="email">Email</label>
			<input class="login__input" type="email" id="email" name="email" v-model='email'>

			<label class="login__label" for="password">Senha</label>
			<input class="login__input" type="password" id="password" name="password" v-model='password'>
			<button class="login__button" type="submit">login</button>
		</form>
		<p class="login__status" v-if="api.message !== ''">{{api.message}}</p>
		<code>
			para desenvolvimento:
		</code>
		<router-link to="/user/">user/</router-link>
		<router-link to="/user/1234">user/:id</router-link>
		<router-link to="/user/1234/carnaval2020">user/:id/consulta</router-link>

	</div>
</template>

<script>
import api from '../utils/api'
import md5 from 'js-md5'

export default {
	name: 'Login',
	data () {
		return {
			email: '',
			password: '',
			api: {
				status: false,
				message: ''
			}
		}
	},
	computed: {
		pass () { // para testes
			return md5(this.email)
		}
	},
	methods: {
		checkUser (event) {
			const body = new URLSearchParams({ // converte para x-www-form-urlencoded
				'usr': md5(this.email),
				'usrk': md5(this.password)
			})

			api.post('/', body)
				.then(res => {
					this.api.message = res.data.message
					this.api.status = res.data.status
				})
				.catch(err => console.error(err))
		}
	}
}

</script>

<style lang="scss" scoped>
@import '../assets/FORM';
</style>
