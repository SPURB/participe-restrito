<template>
	<div class="user login">
		<form class="login__form" action="login" @submit.prevent="checkUser(consulta)" v-if='!user.logged'>
			<fieldset>
				<label class="login__label" for="password">Insira abaixo a chave recebida no seu e-mail.</label>
				<input class="login__input" type="password" id="password" name="password" v-model='password'>
			</fieldset>
			<button class="login__button" type="submit"><i class="icon-seta_direita icon"><span>seta_direita</span></i></button>
		</form>
		<p class="login__status" v-if="user.message !== ''">{{ user.message }}</p>

		<router-view></router-view>
	</div>
</template>

<script>
import apiLogin from '../utils/api.login'
import { mapState, mapMutations } from 'vuex'
import fechadura from '@spurb/fechadura'
import apiconfig from '../utils/api.config.json'
// import tkn from 'js-md5'

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
		// temp () { return tkn('lofus@mailinator.net') }
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
@import '../assets/_variables.scss';

div.login {
	min-height: calc(100vh - 140px);
	width: 100%;
	height: 100%;
	font-family: $grotesca;
	color: $preto;	
	display: flex;
	flex-flow: column nowrap;
	justify-content: center;
	text-align: center;
	z-index: 0;
	& > form {
		max-width: 700px;
		width: 100%;
		margin: 0 auto;
		padding: 0 1rem;
	}
	p.login__status {
		position: fixed;
		bottom: 2rem;
		left: 2rem;
		transform: translateY(1rem);
		opacity: 0;
		text-transform: uppercase;
		font-size: small;
		background-color: $cinza-3;
		padding: 0.75rem 1rem;
		border-radius: 4px;
		border: 4px solid $sombra-4;
		@keyframes surge {
			0% {
				transform: translateY(1rem);
				opacity: 0;
			}
			2% {
				transform: translateY(0);
				opacity: 1;
			}
			98% {
				transform: translateY(0);
				opacity: 2;
			}
			100% {
				transform: translateY(1rem);
				opacity: 0;
			}
		}
		animation: surge ease-in 8s 1s;
	}
}
</style>
