<template>
	<div class="form form--update">
		<form @submit.prevent="atualizar">
			<section ref="desfile">
				<h3>Desfile</h3>
				<label for="nome_do_bloco">Nome do bloco (até 100 caracteres)</label>
				<input
					type="text"
					name="nome_do_bloco"
					v-validate="'required|min:3'"
					:class="{ erro: errors.has('nome_do_bloco') }"
					v-model="desfile.nome_do_bloco"
				>
				<span>{{ errors.first('nome_do_bloco') }}</span>

				<!-- concentração -->
				<label for="endereco_concentracao">Endereço da concentração (até 100 caracteres)</label>
				<input
					type="text"
					name="endereco_concentracao"
					v-validate="'required'"
					:class="{ erro: errors.has('endereco_concentracao') }"
					v-model="desfile.endereco_concentracao"
				>
			</section>
			<button @click.prevent="atualizar">Atualizar</button>
		</form>
	</div>
</template>
<script>
import axios from 'axios'
import fechadura from '@spurb/fechadura'
import apiconfig from '../utils/api.config.json'
import { mapState } from 'vuex'

export default {
	name: 'FormUpdate',
	$_veeValidate: {
		validator: 'new' // instância de validator isolado neste componente
	},
	data () {
		return {
			desfile: {
				id: '',
				nome_do_bloco: '',
				sentido_ab: '',
				mapa_ok: '',
				endereco_concentracao: '',
				complemento_concentracao: ''
				// incluir o restante (copiar de FormCreate.vue, ver teste de PUT do postman)
			},
			percurso: {}
		}
	},
	mounted () {
		/*
		 * Copia valores de props para este componente para permitir a edição dos valores com v-model neste componente apenas.
		*/
		this.$watch(vm => vm.formFields, () => {
			this.desfile.id = this.formFields.id
			this.desfile.nome_do_bloco = this.formFields.nome_do_bloco
			this.desfile.sentido_ab = this.formFields.sentido_ab
			this.desfile.mapa_ok = this.formFields.mapa_ok
			this.desfile.endereco_concentracao = this.formFields.endereco_concentracao
			this.complemento_concentracao = this.formFields.complemento_concentracao
			// incluir o restante
		})
	},

	computed: {
		...mapState([
			'geo',
			'user'
		])

	},

	watch: {
		geo (geo) {
			if (geo.fetched) {
				this.percurso = geo.find(geoObj => parseInt(geoObj.properties.id) === parseInt(this.formFields.id_percurso))
			} else return false
		}
	},

	props: {
		formFields: {
			type: Object,
			required: true
		}
	},
	methods: {
		atualizar (event) {
			/*
			 * 0. Validar todos os items
			 * 1. Atualiza desfile em /desfile com id de contato criado (via PUT). O Backend estava falhando para PUTs. Caso continue falhando (ver teste do postman), falar com Hécio
			 * 3. Criar feedback para usuário (sucesso/fracasso)
			*/
			console.log(`
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
* 0. Validar todos os items do formulário
* 1. Atualizar desfile em /desfile/${this.desfile.id} com id de contato criado (via PUT) na body o objeto this.desfile
* 3. Criar feedback para usuário (sucesso/fracasso)
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			`)
		}
	}
}
</script>
