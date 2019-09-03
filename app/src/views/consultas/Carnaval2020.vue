<template>
	<div class="carnaval2020">
		<header>
			<main>
				<h1>{{ this.$route.name }}</h1>
				<p>Você entrou como <span>{{ $route.params.email }}</span></p>
			</main>
		</header>

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
		},
		nomeDoBloco () {
			return this.$route.query.id === 0 ? 'Novo bloco' : 'Inserir nome do bloco aqui, de /desfiles'
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
<style lang="scss" scoped>
@import '@/assets/_variables.scss';
.carnaval2020 {
	header {
		display: flex;
		align-items: stretch;
		justify-content: space-between;
		background-color: $sombra-1;
		text-align: left;
		color: #FFF;
		position: -webkit-sticky;
		position: sticky;
		top: 0;
		width: 100%;
		z-index: 1;
		main {
			padding: 1.75rem 0 1.75rem 2rem;
			h1 {
				font-size: 1rem;
				margin: 0 0 0.5rem;
			}
			p {
				font-size: small;
				color: $cinza-1;
				margin: 0;
				& > span { color: $cinza-2; }
			}
		}
		@media (max-width: 600px) {
			main {
				padding: 0.85rem 1rem;
			}
		}
	}
}
</style>
