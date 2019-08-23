<template>
	<div class="carnaval2020">
		<h1>Carnaval de Rua 2020</h1>
		<p>Você entrou como {{$route.params.email}}</p>
	</div>
</template>
<script>
export default {
	name: 'Carnaval2020',
	watch: {
		'$route' (to, from) {
			if (to.query.id) {
				this.getBloco(to.query.id)
			} else this.criarNovoBloco()
		}
	},
	methods: {
		fakeFetch (delay) {
			return new Promise(resolve => {
				setTimeout(resolve, delay)
			})
		},

		getBloco (id) {
			this.fetching = true

			this.fakeFetch(500)
				.then(() => {
					console.log('fetching id: ' + id)
				})
				.finally(() => this.fetching = false)
		},

		criarNovoBloco () {
			console.log('novoBloco')
		}
	}
}
</script>
