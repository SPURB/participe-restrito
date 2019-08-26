<template>
	<div class="carnaval2020">
		<h1>{{this.$route.name}}</h1>
		<p>Você entrou como {{$route.params.email}}</p>

		<FormUpdate :formFields="formFields" v-if="userCanUpdateThisRoute"></FormUpdate>
		<FormCreate v-if="create" :id_contato="0"></FormCreate>

	</div>
</template>
<script>
import FormCreate from '@/components/FormCreate'
import FormUpdate from '@/components/FormUpdate'
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
import fechadura from '@spurb/fechadura'
import apiconfig from '../../utils/api.config.json'

export default {
	name: 'Carnaval2020',
	data () {
		return {
			create: false, // process.env.NODE_ENV !== 'production',
			update: {
				status: false,
				id: 0
			},
			formFields: {}
		}
	},
	components: {
		FormUpdate,
		FormCreate
	},
	watch: {
		'$route' (to, from) {
			if (to.query.id) {
				this.getBloco(to.query.id)
			} else if (to.query.id === 0) this.criarNovoBloco()
		}
	},
	computed: {
		...mapState(['geo', 'user']),
		userValidRoutes () { return this.user.desfiles.map(desfile => desfile.id) },
		userCanUpdateThisRoute () {
			return !!(this.userValidRoutes.find(id => this.update.id === id) && this.update.status)
		}
	},
	methods: {
		...mapMutations([
			'FORM_STATUS',
			'GEO_STATUS',
			'GEO_DATA'
		]),

		getBloco (id) {
			/*
			 * 1. Fetch de dados geográficos id_percurso em /geo/?geo=percursos
			 * 2. Fetch de contato
			 * 3. Fetch dados de desfile de id x em /desfile/?id_desfile=:id
			*/

			this.fetching = true
			this.create = false
			this.update.status = true
			this.update.id = id

			// 1. Fetch de dados geográficos id_percurso em /geo/?geo=percursos
			this.fetchGeo()

			// 3. Fetch dados de desfile de id x em /desfile/?id_desfile=:id
			axios.get(`${apiconfig.base}/desfile/?id=${id}`)
				.then(res => this.formFields = res.data[0])
				.catch(err => console.error)
				.finally(() => this.fetching = false)
		},

		criarNovoBloco () {
			this.FORM_STATUS(true)
			this.create = true
			this.update.status = false
			this.update.id = 0
		},

		fetchGeo () {
			if (this.geo.fetched) return
			else {
				axios.get(apiconfig.geo + '/?geo=percursos')
					.then(res => {
						this.GEO_STATUS(true)
						this.GEO_DATA(res.data)
					})
					.catch(err => {
						this.GEO_STATUS(false)
						this.GEO_DATA(err)
					})
			}
		}
	}
}
</script>
