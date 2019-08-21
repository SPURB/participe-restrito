<template>
	<div class="cadastro">
		<form v-if="!enviandoEmail" class="login__form" action="login" @submit.prevent="cadastro(consulta)">
			<label class="login__label" for="nome">Nome</label>
			<input class="login__input" type="nome" id="nome" name="nome" v-model='nome'>

			<label class="login__label" for="email">Email</label>
			<input class="login__input" type="email" id="email" name="email" v-model='email'>

			<label class="login__label" for="desfile">Nome do Bloco</label>
			<input calss="login__input" type="text" id="desfile" name="desfile" v-model='desfile'>
			<label class="login__label" for="cep">CEP do ponto de partida</label>
			<input calss="login__input" type="text" id="cep" name="cep" v-model='cep'>
			<button class="login__button" type="submit">Cadastrar</button>
		</form>
		<p v-else>Enviando email para {{email}}</p>
		<p>
		<p class="login__status" v-if="user.message !== ''">{{user.message}}</p>

		<code>
			para desenvolvimento:
			<router-link to="/user/?usr=yubathom@gmail.com&consulta=carnaval2020">user/</router-link>
		</code>
	</div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'
import apiconfig from '../utils/api.config.json'
import axios from 'axios'

export default {
	name: 'cadastro',
	data () {
		return {
			nome: '',
			email: '',
			desfile: '',
			cep: '',
			enviandoEmail: false
		}
	},
	computed: {
		...mapState(['user']),

		consulta () { return this.$route.query.consulta },
		showForm () {
			if (this.consulta && !this.enviandoEmail) return true
			else return false
		}
	},
	methods: {
		cadastro (consulta) {
			if (!consulta) { this.$router.push('/404') }

			this.enviandoEmail = true
			
			axios.post('http://servicos.spurbanismo.sp.gov.br/mail/api/send', {
				headers: {
					'Content-type': 'application/x-www-form-urlencoded',
					'Authorization': 'NTLM =token'
				},
				withCredentials: true,
				data: {
					'Cc': '',
					'Cco': '',
					'Assunto': 'Teste',
					'Mensagem': `<p>Contém Tags <b>HTML</b></p>`,
					'Para': 'tlyuba@spurbanismo.sp.gov.br'
				},
			})
				.then(res => console.log(res))
				.catch(err => console.error(err)) 
				.finally(() => this.enviandoEmail = false)

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
