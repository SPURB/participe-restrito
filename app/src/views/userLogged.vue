<template>
	<div class="user--logged">
		<router-view></router-view>

		<ul v-if="!form.active">
			<li v-for="(desfile, index) in user.desfiles" :key='index'>
					<router-link :to="{query:{ id:desfile.id }}">
						<h4>{{ desfile.nome_do_bloco }}</h4>
						<p>{{ desfile.endereco_concentracao }}</p>
					</router-link>
			</li>
		</ul>

		<router-link tag='a' :to="{query:{ id: 0 }}" v-if="!form.active">
			<h4>Novo Bloco</h4>
		</router-link>

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
	}
}
</script>
<style lang="scss">
.user--logged{
	min-width: 50%;
}
</style>
