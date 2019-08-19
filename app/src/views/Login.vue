<template>
	<div class="login">
		<div v-if="!consulta">
			<h3>Selecione uma consulta:</h3>
			<ul>
				<li>
					<router-link to='?consulta=carnaval2020' tag='a'>
						<h4>Carnaval 2020</h4>
						<p>Confirme o trajeto do seu bloco de carnaval</p>
					</router-link>
				</li>
			</ul>
		</div>

		<form v-else-if="consulta" class="login__form" action="login" @submit.prevent="checkUser(consulta)">
			<label class="login__label" for="email" type="email">Email</label>
			<input class="login__input" type="email" id="email" name="email" v-model='email'>

			<label class="login__label" for="password">Senha</label>
			<input class="login__input" type="password" id="password" name="password" v-model='password'>
			<button class="login__button" type="submit">login</button>
		</form>
		<p class="login__status" v-if="user.message !== ''">{{user.message}}</p>

		<code>
			para desenvolvimento:
			<router-link to="/user/?usr=yubathom@gmail.com&consulta=carnaval2020">user/</router-link>
		</code>

	</div>
</template>

<script>
import api from '../utils/api.js'
// import md5 from 'js-md5'
import { mapState, mapMutations } from 'vuex'
import fechadura from '@spurb/fechadura'
import apiconfig from '../utils/api.config.json'

export default {
	name: 'Login',
	data () {
		return {
			email: '',
			password: ''
		}
	},
	computed: {
		...mapState(['user']),

		// pass () { // para testes
		// 	return md5(this.email)
		// },

		consulta () { return this.$route.query.consulta }
	},
	methods: {
		...mapMutations([
			'LOGIN_STATUS',
			'LOGIN_ERROR'
		]),

		checkUser (consulta) {
			if (!consulta) { this.$router.push('/') }

			let body = new FormData()
			body.set('usr', this.email)
			body.set('usrk', this.password)

			const config = {
				headers: {
					Current: fechadura(apiconfig.chave, 'bicho').encript
				}
			}

			api.post('/', body, config)
				.then(res => this.LOGIN_STATUS(res.data))
				.catch(err => this.LOGIN_ERROR(err))
				.finally(() => this.goToEditor(this.user.logged, `/user/${this.email}/${this.consulta}`))
		},

		goToEditor (logged, userPath) {
			if (logged) this.$router.push(userPath)
			else if (this.consulta) this.$router.push(`/?consulta=${this.consulta}`)
			else this.$router.push('/')
		}
	}
}

</script>

<style lang="scss" scoped>
@import '../assets/FORM';
</style>
