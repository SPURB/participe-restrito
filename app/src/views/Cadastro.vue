<template>
	<div class="cadastro">
		<form v-if="!enviandoEmail" class="login__form" action="login" @submit.prevent="cadastro(consulta)">
			<label class="login__label" for="name">Nome do responsável</label>
			<input
				@focus="checkForm"
				id="name"
				class="login__input"
				type="text"
				name="name"
				v-validate="'required: true'"
				:class="{ inputErro: errors.has('name') }"
				v-model='name'
			>

			<label class="login__label" for="email">Email</label>
			<input
				@focus="checkForm"
				id="email"
				class="login__input"
				name="email"
				v-validate="'required|email'"
				:class="{ inputErro: errors.has('email') }"
				type="email"
				v-model='email'
			>
			<button class="login__button" type="submit" :disabled='btnDisabled'>Cadastrar</button>
		</form>

		<p v-else>Enviando email para {{email}}</p>

		<ul class="errors">
			<li v-for="(error, index) in errors.items" :key="index">{{ error.msg }}</li>
		</ul>

		<p class="login__status" v-if="user.message !== ''">{{user.message}}</p>

		<!-- <code>
			para desenvolvimento:
			<router-link to="/user/?usr=yubathom@gmail.com&consulta=carnaval2020">user/</router-link>
		</code> -->
	</div>
</template>

<script>
import { mapState } from 'vuex'
import apiEmail from '../utils/api.email'
import apiconfig from '../utils/api.config.json'
import tkn from 'js-md5'
import { mapFields } from 'vee-validate'

export default {
	$_veeValidate: {
		validator: 'new' // instância de validator isolado neste componente
	},
	name: 'cadastro',
	data () {
		return {
			name: '',
			email: '',
			enviandoEmail: false,
			btnDisabled: true
		}
	},
	computed: {
		...mapState(['user']),
		consulta () { return this.$route.query.consulta },
		showForm () {
			if (this.consulta && !this.enviandoEmail) return true
			else return false
		},
		userUrl () {
			return `${apiconfig.appUrl}/#/user/?usr=${this.email}&consulta=${this.consulta}&desfile=${this.desfile}`
		}
	},
	methods: {
		checkForm (event) {
			console.log(this.fields) // habilitar / desabilitar botão
		},
		cadastro (consulta) {
			if (!consulta) { this.$router.push('/404') }

			let emailMessage = new URLSearchParams({
				Assunto: 'Carnaval 2020! Cadastre seu bloco!',
				Mensagem: `
					<h2>Olá ${this.nome}!</h2>
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
					console.log(res)
				})
				.catch(err => {
					console.log(err)
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
<style lang="scss">
.cadastro{
	min-width: 50%
}
</style>
