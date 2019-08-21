<template>
	<div class="home cadastro login">
		<div v-if="!consulta">
			<h3>Selecione uma consulta:</h3>
			<ul>
				<li>
					<router-link to='cadastro/?consulta=carnaval2020' tag='a'>
						<h4>Carnaval 2020</h4>
						<p>Cadastre o seu bloco de carnaval</p>
					</router-link>
				</li>
			</ul>
		</div>
		<router-view v-else></router-view>

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
</style>
