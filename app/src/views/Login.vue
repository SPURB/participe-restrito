<template>
	<div class="login">
		<form class="login__form" action="login" @submit.prevent="checkUser">
			<label class="login__label" for="consulta">Selecionar consulta</label>
			<select class="login__select" name="consulta" v-for="(consulta, index) in consultas" :key="index">
				<option class="login__option" :value="consulta.path">{{consulta.name}}</option>
			</select>

			<label class="login__label" for="email" type="email">Email</label>
			<input class="login__input" type="email" id="email" name="email" v-model='email'>

			<label class="login__label" for="password">Senha</label>
			<input class="login__input" type="password" id="password" name="password" v-model='password'>
			<button class="login__button" type="submit">login</button>
		</form>
		<p class="login__status" v-if="api.message !== ''">{{api.message}}</p>
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
			consultaSelected: {
				name: '',
				path: ''
			},
			api: {
				status: false,
				message: ''
			}
		}
	},
	computed: {
		consultas () {
			return this.$router.options.routes
				.filter(route => route.path !== '/')
				.map(routeObj => {
					return {
						name: routeObj.name,
						path: routeObj.path
					}
				})
		}
		// pass () { //para testes
		// 	return md5(this.email)
		// },
	},
	methods: {
		checkUser (event) {
			const body = new URLSearchParams({ // converte para x-www-form-urlencoded
				'usr': md5(this.email),
				'usrk': md5(this.password)
			})

			api.post('/', body)
				.then(res => {
					// console.log(res.data)
					this.api.message = res.data.message
					this.api.status = res.data.status
				})
				.catch(err => console.error(err))
		}

	}
}
</script>
<style lang="scss">
/*
	Usando método BEM CSS. Ver:
	- http://getbem.com/introduction/
	- https://www.youtube.com/watch?v=SLjHSVwXYq4
*/
.login {
	display: flex;
	flex-direction: column;
	height: 100vh;
	align-items: center;
	justify-content: center;
	line-height: 2
}

.login__form {
	display: flex;
	flex-direction: column;
	min-width: 30vw;
}

.login__label {
	margin-top:1em
}

.login__button {
	margin-top: 1em;
	padding: 0.25rem
}

// .login__button-disabled {
// 	opacity: 0.5;
// }
</style>
