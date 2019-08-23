<template>
	<div class="form--create">

			<form action="update" @submit.prevent="update">

				<section ref="desfile">
					<h3>Desfile</h3>
					<label for="nome_do_bloco">Nome do bloco (até 100 caracteres)</label>
					<input
						id="nome_do_bloco"
						type="text"
						name="nome_do_bloco"
						v-validate="'required|between:1,100'"
						:class="{ erro: errors.has('nome_do_bloco') }"
						v-model="desfile.nome_do_bloco"
					>

					<!-- concentração -->
					<label for="endereco_concentracao">Endereço da concentração (até 100 caracteres)</label>
					<input
						id="endereco_concentracao"
						type="text"
						name="endereco_concentracao"
						v-validate="'required:false|between:3,100'"
						:class="{ erro: errors.has('endereco_concentracao') }"
						v-model="desfile.endereco_concentracao"
					>

					<label for="complemento_concentracao">Complemento (até 100 caracteres)</label>
					<input
						id="complemento_concentracao"
						type="text"
						name="complemento_concentracao"
						v-validate="'required|between:3,100'"
						:class="{ erro: errors.has('complemento_concentracao') }"
						v-model="desfile.complemento_concentracao"
					>

					<label for="cep_concentracao">CEP</label>
					<input
						id="cep_concentracao"
						type="text"
						name="cep_concentracao"
						v-validate="'required|between:3,100'"
						:class="{ erro: errors.has('cep_concentracao') }"
						v-model="desfile.cep_concentracao"
					>

					<label for="bairro_concentracao">Bairro</label>
					<input
						id="bairro_concentracao"
						type="text"
						name="bairro_concentracao"
						v-validate="'required|between:3,100'"
						:class="{ erro: errors.has('bairro_concentracao') }"
						v-model="desfile.bairro_concentracao"
					>

					<label for="itinerario">Itinerário (até 1000 caracteres)</label>
					<textarea
						id="itinerario"
						type="text"
						name="itinerario"
						v-validate="'required:false|between:3,1000'"
						:class="{ erro: errors.has('itinerario') }"
						v-model="desfile.itinerario"
					></textarea>

				<!-- disperção -->
					<label for="endereco_dispersao">Endereço da disperção (até 100 caracteres)</label>
					<input
						id="endereco_dispersao"
						type="text"
						name="endereco_dispersao"
						v-validate="'required:false|between:3,100'"
						:class="{ erro: errors.has('endereco_dispersao') }"
						v-model="desfile.endereco_dispersao"
					>

					<label for="complemento_dispersao">Complemento (até 100 caracteres)</label>
					<input
						id="complemento_dispersao"
						type="text"
						name="complemento_dispersao"
						v-validate="'required:false|between:3,100'"
						:class="{ erro: errors.has('complemento_dispersao') }"
						v-model="desfile.complemento_dispersao"
					>

					<label for="cep_dispersao">CEP</label>
					<input
						id="cep_dispersao"
						type="text"
						name="cep_dispersao"
						v-validate="'required:false|between:3,100'"
						:class="{ erro: errors.has('cep_dispersao') }"
						v-model="desfile.cep_dispersao"
					>

					<!-- ************************************************************** -->
					<!-- Não consta nem em api/model/desfiles.php nem no bando de dados -->
					<!-- ************************************************************** -->

					<!-- <label for="bairro_dispersao">Bairro</label>
					<input
						id="bairro_dispersao"
						type="text"
						name="bairro_dispersao"
						v-validate="'required:false|between:3,100'"
						:class="{ erro: errors.has('bairro_dispersao') }"
						v-model="desfile.bairro_dispersao"
					> -->


					<!-- ******************* -->
					<!-- ***** datas ******* -->
					<!-- ******************* -->
					 <label for="data_do_desfile_2019">Data (2019)</label>
					 <input 
					 	id="data_do_desfile_2019"
						type="date"
						v-validate="'required:false'"
						v-model="desfile.data_do_desfile_2019"
					/>

					 <label for="data_do_desfile_2020">Data (2020)</label>
					 <input 
					 	id="data_do_desfile_2020"
						type="date"
						v-validate="'required:true'"
						v-model="desfile.data_do_desfile_2020"
					/> 

					

				</section>

				<section ref="contato">
					<h3>Responsável</h3>
					<label for="name">Nome</label>
					<input
						id="nome_responsavel"
						type="text"
						name="nome_responsavel"
						v-validate="'required: true'"
						:class="{ erro: errors.has('nome_responsavel') }"
						v-model="contato.nome_responsavel"
					>
		
					<label for="cpf_cnpj_responsavel">CPF/CNPJ</label>
					<input
						id="cpf_cnpj_responsavel"
						type="text"
						name="cpf_cnpj_responsavel"
						v-validate="'required: true'"
						:class="{ erro: errors.has('cpf_cnpj_responsavel') }"
						v-model="contato.cpf_cnpj_responsavel"
					>

					<label for="email_responsavel">Email</label>
					<input
						id="email_responsavel"
						name="email_responsavel"
						v-validate="'required|email'" 
						:class="{ erro: errors.has('email') }"
						type="email"
						v-model="contato.email_responsavel"
					>

					<label for="telefone_responsavel">Telefone</label>
					<input
						id="telefone_responsavel"
						name="telefone_responsavel"
						v-validate="'required|email'" 
						:class="{ erro: errors.has('telefone_responsavel') }"
						type="text"
						v-model="contato.telefone_responsavel"
					>

					<!-- co-responsável -->
					<a href="" @click.prevent="displayToggle('showCorresponsavel')">
						<span v-if="!ui.showCorresponsavel">Incluir co-responsável</span>
						<span v-if="ui.showCorresponsavel" @click.prevent="resetSection('coResponsavel')">Remover co-responsável</span>
					</a>

					<template v-if="ui.showCorresponsavel">
						<h3>Co-responsável</h3>
						<label for="name">Nome</label>
						<input
							id="nome_coresponsavel"
							type="text"
							name="nome_coresponsavel"
							v-validate="'required: false'"
							:class="{ erro: errors.has('nome_coresponsavel') }"
							v-model="contato.nome_coresponsavel"
						>
			
						<label for="cpf_cnpj_coresponsavel">CPF/CNPJ</label>
						<input
							id="cpf_cnpj_coresponsavel"
							type="text"
							name="cpf_cnpj_coresponsavel"
							v-validate="'required: false'"
							:class="{ erro: errors.has('cpf_cnpj_coresponsavel') }"
							v-model="contato.cpf_cnpj_coresponsavel"
						>

						<label for="email_coresponsavel">Email</label>
						<input
							id="email_coresponsavel"
							name="email_coresponsavel"
							v-validate="'required: false'" 
							:class="{ erro: errors.has('email_coresponsavel') }"
							type="email"
							v-model="contato.email_coresponsavel"
						>

						<label for="telefone_coresponsavel">Telefone</label>
						<input
							id="telefone_coresponsavel"
							name="telefone_coresponsavel"
							v-validate="'required: false'" 
							:class="{ erro: errors.has('telefone_coresponsavel') }"
							type="text"
							v-model="contato.telefone_coresponsavel"
						>
					</template>
				</section>
			</form>

	</div>
</template>
<script>
export default {
	$_veeValidate: {
		validator: 'new' // instância de validator isolado neste componente
	},
	name: 'FormCreate',
	created () {
		/* 
		* Preenche campos conhecidos
		*/
		this.email_responsavel = this.$route.params.email
	},
	
	data() {
		return {
			ui: {
				showCorresponsavel: false
			},
			contato: {
				nome_responsavel: '',
				cpf_cnpj_responsavel: '',
				email_responsavel: '',
				telefone_responsavel: '',
				nome_coresponsavel: '',
				cpf_cnpj_coresponsavel: '',
				email_coresponsavel: '',
				telefone_coresponsavel: ''
			},

			desfile: {
				nome_do_bloco: '',
				//nao se aplicam a este form mas precisa constar no body do post
				sentido_ab: 1,
				mapa_ok: '',
				//nao se aplicam a este form mas precisa constar no body do post
				endereco_concentracao: '',
				complemento_concentracao: '',
				cep_concentracao: '',
				bairro_concentracao: '',
				itinerario: '',
				endereco_dispersao: '',
				complemento_dispersao: '',
				cep_dispersao: '',
				// faltou bairro
				data_do_desfile_2019: '',
				data_do_desfile_2020: '',
				hr_concentracao: '',
				hr_desfile: '',
				hr_encerramento: '',
				subprefeitura: '',
				publico_2019: '',
				publico_estimado: '',

				aceite_das_regras: '',
				ano_fundacao: '',
				apoiadores: '',
				artistas: '',
				autoriza_divulgacao: '',
				banda_em_trio_ou_solo: '',
				bateria: '',
				bloco_comunitario: '',
				estilo_musical_predominante: '',
				id: '',
				id_contato: '',
				id_percurso: '',
				interesse_cadastrar_ambulantes: '',
				interesse_contato_empresas: '',
				n_ambulancias: '',
				n_banheiros_quimicos: '',
				n_brigadistas: '',
				n_catadores_de_residuos: '',
				n_cordeiros: '',
				n_segurancas_habilitados: '',
				participar_campanhas: '',
				patrocinio: '',
				perfil_bloco: '',
				plano_de_operacao: '',
				resenha: '',
				trio_eletrico: ''
			}
		}
	},
	methods: {
		update (event) {
			console.log(event)
		},
		displayToggle (el) {
			this.ui[el] = !this.ui[el]
		},
		resetSection (section) {
			switch (section) {
				case 'coresponsavel':
					this.contato.nome_coresponsavel= ''
					this.contato.cpf_cnpj_coresponsavel = ''
					this.contato.email_coresponsavel = ''
					this.contato.telefone_coresponsavel = ''
				}
		}
	}
}
</script>
<style lang="scss" scoped>
.form--create, section, form {
	display: flex;
	flex-direction: column;
	line-height: 2
}
</style>
