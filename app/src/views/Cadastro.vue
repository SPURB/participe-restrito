<template>
	<div class="cadastro">
		<form v-if="!enviandoEmail" class="login__form" action="login" @submit.prevent="cadastro(consulta)">
			<p v-if="!createUserError.status">Insira seu nome e endereço de e-mail para continuar o cadastro:</p>
			<fieldset>
				<input
					placeholder="Nome"
					@blur="checkForm"
					id="name"
					class="login__input"
					type="text"
					name="name"
					v-validate="'required: true'"
					:class="{ inputErro: errors.has('name') }"
					v-model='name'
				>
			</fieldset>
			<fieldset>
				<input
					placeholder="E-mail válido"
					@keyup="checkForm"
					@blur="checkForm"
					id="email"
					class="login__input"
					name="email"
					v-validate="'required|email'"
					:class="{ inputErro: errors.has('email') }"
					type="email"
					v-model='email'
				>
			</fieldset>
			<button class="login__button" type="submit" :disabled='btnDisabled'>
				<i class="icon-seta_direita icon"><span>seta_direita</span></i>
			</button>
		</form>

		<div v-else class="fetching">
			<p>Enviando e-mail para <span>{{ email }}</span>...</p>
			<i class="icon-novamente icon"><span>novamente</span></i>
		</div>

		<ul class="errors">
			<li v-for="(error, index) in errors.items" :key="index">
				<span>!</span>
				<div>{{ error.msg }}</div>
			</li>
		</ul>

		<LoginError :log="createUserError.log" v-if="createUserError.status"></LoginError>

		<p class="login__status" v-if="user.message !== ''">{{user.message}}</p>

		<div id="dev">
			<hr>
			<p>para desenvolvimento:</p>
			<router-link tag='a' to="/user/?usr=foo@bar.com&consulta=carnaval2020">user/signin</router-link>
			<p>f3ada405ce890b6f8204094deb12d8a8</p>
			<router-link tag='a' to="/user/foo@bar.com/carnaval2020">user/logged</router-link>
			<p>src/store.js (alterar):</p>
			<p><code>state.user.logged: process.env.NODE_ENV !== 'production' </code></p>
		</div>

	</div>
</template>

<script>
import { mapState } from 'vuex'
import apiEmail from '../utils/api.email'
import apiconfig from '../utils/api.config.json'
import tkn from 'js-md5'
import LoginError from '@/components/LoginError'

export default {
	$_veeValidate: {
		validator: 'new' // instância de validator isolado neste componente
	},
	name: 'cadastro',
	data () {
		return {
			name: '',
			email: '',
			createUserError: {
				status: false,
				log: ''
			},
			enviandoEmail: false,
			btnDisabled: true
		}
	},
	components: {
		LoginError
	},
	computed: {
		...mapState(['user']),
		consulta () { return this.$route.query.consulta },
		showForm () {
			if (this.consulta && !this.enviandoEmail) return true
			else return false
		},
		userUrl () {
			return `${apiconfig.appUrl}/#/user/?usr=${this.email}&consulta=${this.consulta}&tkn=${tkn(this.name)}`
		}
	},
	methods: {
		checkForm () {
			const errorSum = this.fields.email.valid + this.fields.name.valid // true + true === 2
			if (errorSum === 2) { this.btnDisabled = false } else this.btnDisabled = true
		},
		cadastro (consulta) {
			if (!consulta) { this.$router.push('/404') }

			let emailMessage = new URLSearchParams({
				Assunto: 'Carnaval 2020! Cadastre seu bloco!',
				Mensagem: `
					<h2>Olá ${this.name}!</h2>
					<p>Finalize o cadastro do seu bloco na url abaixo:</p>
					<a href="${this.userUrl}">Cadastre seu Bloco para o carnaval 2020!</a>
					<p>A sua chave de acesso é:</p>
					<h3>${tkn(this.email)}</h3>
					<img src="https://participe.gestaourbana.prefeitura.sp.gov.br/arquivos/img/PMSP_horizontal_cor_pos.png" width="283" height="97" alt="Prefeitura de São Paulo">
					`,
				Para: this.email
			})

			const mail = emailMessage.toString()

			this.enviandoEmail = true

			apiEmail.post('/mail/api/send', mail)
				.then(res => {
					this.createUserError.status = false
					this.createUserError.log = ''
				})
				.catch(err => {
					this.createUserError.status = true
					this.createUserError.log = err
				})
				.finally(() => { this.enviandoEmail = false })
		},

		goToEditor (logged, userPath) {
			if (logged) this.$router.push(userPath)
			else if (this.consulta) this.$router.push(`/?consulta=${this.consulta}`)
			else this.$router.push('/404')
		}
	}
}
</script>
<style lang="scss" scoped>
@import '../assets/FORM';
@import '../assets/_variables.scss';

.cadastro {
	font-family: $grotesca;
	color: $preto;
	display: flex;
	flex-flow: column nowrap;
	justify-content: center;
	min-height: inherit;
	text-align: center;
	form {
		p {
			line-height: 1.2;
			margin: 0 0 2rem;
		}
	}
	div.fetching {
		p {
			margin: 0 0 1rem;
			color: $cinza-2;
			span { color: $cinza-1; }
		}
		.icon-novamente::before {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-size: 1.5rem;
			color: #FFF;
			background-color: $cinza-1;
			border-radius: 100%;
			animation: roda linear 1s infinite reverse;
			@keyframes roda {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
		}
	}
	ul.errors {
		list-style-type: none;
		margin: 0;
		padding: 0;
		li {
			display: flex;
			align-items: center;
			margin: 1rem 0;
			background-color: $cinza-3;
			text-align: left;
			font-size: small;
			line-height: 1.2;
			padding: 0.75rem 1rem;
			animation: surge ease-in .4s;
			border-radius: 0.25rem;
			@keyframes surge {
				from { opacity: 0; }
				to { opacity: 1; }
			}
			& > span {
				display: inline-block;
				font-weight: 700;
				line-height: 1rem;
				width: 1rem;
				text-align: center;
				background-color: $vermelho;
				color: #FFF;
				border-radius: 1rem;
				margin-right: 0.5rem;
			}
		}
	}
	div#dev {
		position: absolute;
		top: 1rem;
		left: 1rem;
		opacity: 0.1;
	}
}
</style>
