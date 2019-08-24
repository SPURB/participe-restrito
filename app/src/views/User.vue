<template>
	<div class="user login">
		<form class="login__form" action="login" @submit.prevent="checkUser(consulta)" v-if='!user.logged'>
			<label class="login__label" for="password">Insira abaixo a chave recebida no seu e-mail.</label>
			<input class="login__input" type="password" id="password" name="password" v-model='password'>
			<button class="login__button" type="submit">login</button>
		</form>

		<p class="login__status" v-if="user.message !== ''">{{user.message}}</p>

		<router-view></router-view>
	</div>
</template>

<script>
import apiLogin from '../utils/api.login'
import { mapState, mapMutations } from 'vuex'
import fechadura from '@spurb/fechadura'
import apiconfig from '../utils/api.config.json'

export default {
	name: 'user',
	data () {
		return {
			password: ''
		}
	},

	computed: {
		...mapState(['user']),
		usr () { return this.$route.query.usr },
		consulta () { return this.$route.query.consulta }
	},

	methods: {
		...mapMutations([
			'LOGIN_STATUS',
			'LOGIN_ERROR'
		]),
		checkUser (consulta) {
			if (!consulta) { this.$router.push('/404') }

			let body = new FormData()
			body.set('usr', this.usr)
			body.set('usrk', this.password)

			const config = {
				headers: {
					Current: fechadura(apiconfig.chave, 'bicho').encript
				}
			}

			apiLogin.post('/', body, config)
				.then(res => this.LOGIN_STATUS(res.data))
				.catch(err => this.LOGIN_ERROR(err))
				.finally(() => this.goToEditor(this.user.logged, `/user/${this.usr}/${this.consulta}`))
		},

		goToEditor (logged, userPath) {
			if (logged) this.$router.push(userPath)
			else this.$router.push('/404')
		}
	}
}
</script>

<style lang="scss" scoped>
@import '../assets/FORM';
</style>
