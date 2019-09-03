<template>
	<div class="home cadastro login">
		<div v-if="!consulta">
			<router-link to='cadastro/?consulta=carnaval2020' tag='a'>
				<img src="http://spurbsp163:7080/participe/carnaval/img/carnaval-fim.png" alt="Carnaval de Rua 2020 - Inscreva seu bloco!">
				<h1>Carnaval de Rua 2020</h1>
				<p>Inscreva seu bloco!</p>
			</router-link>
		</div>
		<router-view v-else></router-view>
		<div v-if="!consulta" class="regua">
			<img src="http://spurbsp163:7080/participe/carnaval/img/logo-cidade.png" alt="Prefeitura de São Paulo">
			<img src="http://spurbsp163:7080/participe/carnaval/img/capital-cultura.png" alt="São Paulo, capital da Cultura">
		</div>
	</div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'

export default {
	name: 'Home',
	data () {
		return {
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
		...mapMutations([
			'LOGIN_STATUS',
			'LOGIN_ERROR'
		])
	}
}
</script>

<style lang="scss">
@import '../assets/FORM';
@import '../assets/_variables.scss';

.home {
	min-height: calc(100vh - 140px);
	max-width: 700px;
	width: 100%;
	height: 100%;
	padding: 0 1rem;
	margin: 0 auto;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	& > div:not([class]) {
		width: 100%;
		height: auto;
		text-align: center;
		font-family: $grotesca;
		a {
			transition: all ease-in-out .1s;
			h1 {
				font-size: 1.25rem;
				color: $preto;
				margin: 1rem 0;
			}
			p {
				color: $cinza-1;
				margin: 0;
			}
			&:hover { opacity: 0.5; }
			&:active { background-color: transparent; }
		}
	}
	& > div.regua {
		display: block;
		margin: 2rem 0 0;
		img {
			width: 4rem;
			vertical-align: middle;
			margin: 0 1rem;
		}
	}
	@media (max-width: 600px) {
		& > div:not([class]) a img { width: 60vw; }
	}
}
</style>
