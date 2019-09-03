<template>
	<div class="user--logged">
		<router-view></router-view>

		<!-- <p v-if="!form.active" class="intro">Selecione um desfile para editar seus dados ou inclua um novo desfile</p> -->

		<ul v-if="!form.active" class="update">
			<!-- <li v-for="(desfile, index) in user.desfiles" :key='index' @click="startForm">
				<router-link :to="{query:{ id:desfile.id }}">
					<span>{{ desfile.nome_do_bloco }}</span>
					<i class="icon-seta_direita icon"><span>seta_direita</span></i>
				</router-link>
			</li> -->
			<li @click="startForm">
				<router-link tag='a' :to="{query:{ id: 0 }}" v-if="!form.active" class="create" @click="startForm">
					<span>Novo bloco</span>
					<i class="icon-adicionar icon"><span>adicionar</span></i>
				</router-link>
			</li>
		</ul>
	</div>
</template>
<script>
import { mapState } from 'vuex'

export default {
	name: 'userLogged',
	data () {
		return {
			fetching: false
		}
	},
	computed: {
		...mapState([
			'form',
			'user'
		]),
		userEmail () { return this.$route.params.email },
		blocoId () { return this.$route.query.id }
	},
	methods: {
		startForm () {
			this.$store.commit('FORM_STATUS', true)
		}
	}
}
</script>
<style lang="scss">
@import '../assets/_variables.scss';

.user--logged {
	min-height: calc(100vh - 140px);
	p.intro {
		margin: 2rem auto;
		padding: 0 1rem;
		max-width: 700px;
		width: 100%;
		color: $preto;
	}
	ul.update {
		list-style-type: none;
		margin: 0 auto;
		padding: 0 1rem;
		max-width: 700px;
		width: 100%;
		& > li a {
			display: block;
			color: #FFF;
			text-decoration: none;
			padding: 1.75rem 2rem;
			margin: 1rem 0;
			background-color: $preto;
			border: 0.25rem solid $branco-clique;
			border-radius: 4px;
			position: relative;
			&.create {
				background-color: $vermelho;
			}
			span {
				display: block;
				text-align: left;
				font-size: 1.25rem;
			}
			.icon {
				position: absolute;
				right: 2rem;
				top: 50%;
				transform: translateY(-50%);
			}
			&:hover {
				background-color: $cinza-1;
				&.create {
					background-color: $vermelho-tr;
				}
				.icon-seta_direita {
					animation: oscila ease-in-out .8s infinite;
				}
			}
		}
		@media (max-width: 600px) {
			& > li a {
				padding: 0.75rem 1rem;
				span { font-size: 1rem; }
				.icon { right: 1rem; }
			}
		}
	}
}
</style>
