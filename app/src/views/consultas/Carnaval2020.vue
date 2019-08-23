<template>
	<div class="carnaval2020">
		<h1>{{this.$route.name}}</h1>
		<p>Você entrou como {{$route.params.email}}</p>

		<FormUpdate v-if="update.status"></FormUpdate>
		<FormCreate v-if="create" :formFields="formFields" :id_contato="0"></FormCreate>

	</div>
</template>
<script>
import FormCreate from '@/components/FormCreate'
import FormUpdate from '@/components/FormUpdate'
import { mapMutations } from 'vuex'

export default {
	name: 'Carnaval2020',
	data () {
		return {
			create: process.env.NODE_ENV !== 'production',
			update: {
				status: false, 
				id: 0
			},
			formFields: {},

		}
	},
	components:{
		FormUpdate,
		FormCreate
	},
	watch: {
		'$route' (to, from) {
			if (to.query.id) {
				this.getBloco(to.query.id)
			}
			else if (to.query.id === 0) this.criarNovoBloco()
		}
	},
	methods: {
		...mapMutations([
			'FORM_STATUS'
		]),
		fakeFetch (delay) {
			return new Promise(resolve => {
				setTimeout(resolve, delay)
			})
		},

		getBloco (id) {
			this.fetching = true

			this.create = false
			this.update.status = true
			this.update.id = id

			this.fakeFetch(500)
				.then(() => {
					this.FORM_STATUS(true)
					console.log('fetching id: ' + id)
				})
				.finally(() => { this.fetching = false })
		},

		criarNovoBloco () {
			this.FORM_STATUS(true)
			this.create = true
			this.update.status = false
			this.update.id = 0
			// console.log('novoBloco')
		}
	}
}
</script>
