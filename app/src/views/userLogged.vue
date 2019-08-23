<template>
	<div class="user--logged">
		<router-view></router-view>

		<ul v-if="!form.active">
			<li v-for="(bloco, index) in blocos" :key='index'>
					<router-link :to="{query:{ id:bloco.id }}">
						<h4>{{ bloco.nome }}</h4>
						<p>{{ bloco.rua }}</p>
					</router-link>
			</li>
		</ul>

		<router-link :to="{query:{ id: 0 }}" v-if="!form.active">
			<h4>Criar um novo bloco de carnaval</h4>
		</router-link>

	</div>
</template>
<script>
import { mapState, mapMutations } from 'vuex'

export default {
	name: 'userLogged',
	data () {
		return {
			fetching: false,
			blocos: []
		}
	},
	computed: {
		...mapState(['form']),
		userEmail () { return this.$route.params.email },
		blocoId () { return this.$route.querys.id }
	},

	created() {
		this.FORM_STATUS(true)
	},

	methods: {
		...mapMutations(['FORM_STATUS']),
		fakeFetch (delay) {
			return new Promise(resolve => {
				setTimeout(resolve, delay)
			})
		},
		listConsultas (email) {
			this.fetching = true
			/*
			 1. A partir do email a api de login deve retornar um objeto com: id, nome do bloco e logradouro
			 2. Se não a API não encontrar nenhum bloco para este email devemos abrir um formulário para criarmos um novo bloco
			*/
			this.fakeFetch(300)
				.then(() => {
					this.blocos = [
						// {
						// 	id: 1,
						// 	nome: 'Bloco Falso',
						// 	rua: 'Logradouro da Mentira'
						// },
						// {
						// 	id: 2,
						// 	nome: 'Bloco Fake',
						// 	rua: 'Rua Zica'
						// }
					]
				})
				.catch(() => console.error('Err'))
				.finally(() => this.fetching = false)
		}
	},
	created () {
		this.listConsultas(this.userEmail)
	}
}
</script>
<style lang="scss">
.user--logged{
	min-width: 50%;
}
</style>