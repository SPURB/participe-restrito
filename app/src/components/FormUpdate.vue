<template>
	<div class="form form--update">
		<form @submit.prevent="atualizar">
			<section ref="desfile">
				<h3>Desfile</h3>
				<fieldset>
					<label for="nome_do_bloco" class="update__label">Nome do bloco (até 100 caracteres)</label>
					<input
						id="nome_do_bloco"
						type="text"
						name="nome_do_bloco"
						v-validate="'required|min:3'"
						:class="{ erro: errors.has('nome_do_bloco') }"
						class="update__input"
						v-model="desfile.nome_do_bloco"
					>
					<span>{{ errors.first('nome_do_bloco') }}</span>
				</fieldset>

				<!-- INSERIR OPENLAYERS AQUI -->
				<!-- INSERIR PARAMETROS TRAJETO OK + SENTIDO TRAJETO -->
				<!-- DESABILITAR CAMPOS DE ENDEREÇO DE CONCENTRAÇAO OU DISPERSAO CASO TRAJEO OK = TRUE -->

				<!-- concentração -->
				<fieldset>
					<label for="endereco_concentracao" class="update__label">Endereço da concentração (até 100 caracteres)</label>
					<input
						id="endereco_concentracao"
						type="text"
						name="endereco_concentracao"
						v-validate="'required'"
						:class="{ erro: errors.has('endereco_concentracao') }"
						class="update__input"
						v-model="desfile.endereco_concentracao"
					>
				</fieldset>

				<fieldset>
					<label class="update__label" for="complemento_concentracao">Complemento (até 100 caracteres)*</label>
					<input
						id="complemento_concentracao"
						type="text"
						name="complemento_concentracao"
						v-validate="'required'"
						:class="{ erro: errors.has('complemento_concentracao') }"
						class="update__input"
						v-model="desfile.complemento_concentracao"
					>
				</fieldset>

				<fieldset>
					<label class="update__label" for="cep_concentracao">CEP*</label>
					<input
						id="cep_concentracao"
						type="text"
						name="cep_concentracao"
						v-validate="'required'"
						:class="{ erro: errors.has('cep_concentracao') }"
						class="update__input"
						v-model="desfile.cep_concentracao"
					>
					<a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank"><i class="icon-buscar icon"><span>buscar</span></i></a>
					<!-- consulta correios -> http://www.buscacep.correios.com.br/sistemas/buscacep/ -->
				</fieldset>

				<fieldset>
					<label class="update__label" for="bairro_concentracao">Bairro*</label>
					<input
						id="bairro_concentracao"
						type="text"
						name="bairro_concentracao"
						v-validate="'required'"
						:class="{ erro: errors.has('bairro_concentracao') }"
						class="update__input"
						v-model="desfile.bairro_concentracao"
					>
				</fieldset>

				<fieldset>
					<label class="update__label" for="itinerario">Itinerário (até 1000 caracteres)*</label>
					<textarea
						id="itinerario"
						type="text"
						name="itinerario"
						v-validate="'required'"
						:class="{ erro: errors.has('itinerario') }"
						class="update__input"
						v-model="desfile.itinerario"
					></textarea>
				</fieldset>

				<!-- dispersão -->
				<fieldset>
					<label class="update__label" for="endereco_dispersao">Endereço da dispersão (até 100 caracteres)*</label>
					<input
						id="endereco_dispersao"
						type="text"
						name="endereco_dispersao"
						v-validate="'required'"
						:class="{ erro: errors.has('endereco_dispersao') }"
						class="update__input"
						v-model="desfile.endereco_dispersao"
					>
				</fieldset>

				<fieldset>
					<label class="update__label" for="complemento_dispersao">Complemento (até 100 caracteres)*</label>
					<input
						id="complemento_dispersao"
						type="text"
						name="complemento_dispersao"
						v-validate="'required'"
						:class="{ erro: errors.has('complemento_dispersao') }"
						class="update__input"
						v-model="desfile.complemento_dispersao"
					>
				</fieldset>

				<fieldset>
					<label class="update__label" for="cep_dispersao">CEP*</label>
					<input
						id="cep_dispersao"
						type="text"
						name="cep_dispersao"
						v-validate="'required'"
						:class="{ erro: errors.has('cep_dispersao') }"
						class="update__input"
						v-model="desfile.cep_dispersao"
					>
					<a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank"><i class="icon-buscar icon"><span>buscar</span></i></a>
					<!-- consulta correios -> http://www.buscacep.correios.com.br/sistemas/buscacep/ -->
				</fieldset>

				<!-- **************** NON ECXISTE: bairro_dispersao ************** -->
				<!-- api/model/desfiles.php (branch backend) nem no banco de dados -->
				<!-- ************************************************************** -->
				<fieldset>
					<label class="update__label" for="bairro_dispersao">Bairro*</label>
					<input
						id="bairro_dispersao"
						type="text"
						name="bairro_dispersao"
						v-validate="'required:false|between:3,100'"
						:class="{ erro: errors.has('bairro_dispersao') }"
						class="update__input"
						v-model="desfile.bairro_dispersao"
					>
				</fieldset>
				<!-- **************** NON ECXISTE: bairro_dispersao ************** -->

				<!-- ***** datas ******* -->
				<!-- Data (2019) -->
				<fieldset>
					<label class="update__label" for="data_do_desfile_2019">Data (2019)*</label>
					<input
						id="data_do_desfile_2019"
						type="date"
						name="data_do_desfile_2019"
						v-validate="'required:false'"
						:class="{ erro: errors.has('data_do_desfile_2019') }"
						class="update__input"
						v-model="desfile.data_do_desfile_2019"
					/>
				</fieldset>

				<!--  ocorrências filtradas do ano passado (verificar se muda para select/option?)
				2019-02-23 00:00:00
				2019-02-24 00:00:00
				2019-03-03 00:00:00
				2019-03-04 00:00:00
				2019-03-05 00:00:00
				2019-03-09 00:00:00
				2019-03-10 00:00:00
				-->
				<!-- FIM Data (2019) -->

				<!-- Data (2020) -->
				<fieldset>
					<label class="update__label" for="data_do_desfile_2020">Data (2020)*</label>
					<select
						id="data_do_desfile_2020"
						type="text"
						name="data_do_desfile_2020"
						:class="{ erro: errors.has('data_do_desfile_2020') }"
						class="update__input"
						v-validate="'required'"
						@change="setOption('desfile','data_do_desfile_2020', $event, 'Especifique outra data e horário, conforme desfiles de anos anteriores')">
							<option value="" disabled selected>Selecione uma data</option>
							<option value="Pre:2020-02-15__2020-02-16">Pré (15/02 - 16/02)</option>
							<option value="2020-02-17 00:00:00">17/02 - segunda-feira</option>
							<option value="2020-02-18 00:00:00">18/02 - terça-feira</option>
							<option value="2020-02-19 00:00:00">19/02 - quarta-feira</option>
							<option value="2020-02-20 00:00:00">20/02 - quinta-feira</option>
							<option value="2020-02-21 00:00:00">21/02 - sexta-feira</option>
							<option value="2020-02-22 00:00:00">22/02 - sábado</option>
							<option value="2020-02-23 00:00:00">23/02 - domingo</option>
							<option value="2020-02-24 00:00:00">24/02 - segunda-feira</option>
							<option value="2020-02-25 00:00:00">25/02 - terça-feira</option>
							<option value="2020-02-26 00:00:00">26/02 - quarta-feira</option>
							<option value="2020-02-27 00:00:00">27/02 - quinta-feira</option>
							<option value="opcional">Opcional (blocos tradicionais ou com histórico)</option>
					</select>
					<textarea
						v-if="ui.opcional.data_do_desfile_2020"
						name="data_do_desfile_2020--opcional"
						id="data_do_desfile_2020--opcional"
						:class="{ erro: errors.has('data_do_desfile_2020') }"
						cols="30" rows="10"
						v-model="desfile.data_do_desfile_2020">
					</textarea>
					<p v-else class="obs">Caso seja bloco tradicional com histórico, selecione <strong>Opcional</strong> para especificar outra data e horário nas observações conforme desfiles de anos anteriores.</p>
				</fieldset>
				<!-- FIM Data (2020) -->

				<!-- Horário da concentração -->
				<fieldset>
					<label class="update__label" for="hr_concentracao">Horário da concentração*</label>
					<select
						id="hr_concentracao"
						:class="{ erro: errors.has('hr_concentracao') }"
						class="update__input"
						type="text"
						name="hr_concentracao"
						v-validate="'required'"
						@change="setOption('desfile','hr_concentracao', $event)">
							<option value="" disabled selected>Selecione um horário</option>
							<option value="08:00">8h</option>
							<option value="08:30">8h30</option>
							<option value="09:00">9h</option>
							<option value="09:30">9h30</option>
							<option value="10:00">10h</option>
							<option value="10:30">10h30</option>
							<option value="11:00">11h</option>
							<option value="11:30">11h30</option>
							<option value="12:00">12h</option>
							<option value="12:30">12h30</option>
							<option value="13:00">13h</option>
							<option value="13:30">13h30</option>
							<option value="14:00">14h</option>
							<option value="14:30">14h30</option>
							<option value="15:00">15h</option>
							<option value="15:30">15h30</option>
							<option value="16:00">16h</option>
							<option value="16:30">16h30</option>
							<option value="17:00">17h</option>
					</select>
				</fieldset>
				<!-- FIM Horário da concentração -->

				<!-- Horário da desfile -->
				<fieldset>
					<label class="update__label" for="hr_desfile">Horário do desfile*</label>
					<select
						id="hr_desfile"
						:class="{ erro: errors.has('hr_desfile') }"
						class="update__input"
						type="text"
						name="hr_desfile"
						v-validate="'required'"
						@change="setOption('desfile','hr_desfile', $event)">
							<option value="" disabled selected>Selecione um horário</option>
							<option value="08:00">8h</option>
							<option value="08:30">8h30</option>
							<option value="09:00">9h</option>
							<option value="09:30">9h30</option>
							<option value="10:00">10h</option>
							<option value="10:30">10h30</option>
							<option value="11:00">11h</option>
							<option value="11:30">11h30</option>
							<option value="12:00">12h</option>
							<option value="12:30">12h30</option>
							<option value="13:00">13h</option>
							<option value="13:30">13h30</option>
							<option value="14:00">14h</option>
							<option value="14:30">14h30</option>
							<option value="15:00">15h</option>
							<option value="15:30">15h30</option>
							<option value="16:00">16h</option>
							<option value="16:30">16h30</option>
							<option value="17:00">17h</option>
					</select>
				</fieldset>
				<!-- FIM Horário da desfile -->

				<!-- Horário da encerramento -->
				<fieldset>
					<label class="update__label" for="hr_encerramento">Horário de encerramento*</label>
					<select
						id="hr_encerramento"
						:class="{ erro: errors.has('hr_encerramento') }"
						class="update__input"
						type="text"
						name="hr_encerramento"
						v-validate="'required'"
						@change="setOption('desfile','hr_encerramento', $event)">
							<option value="" disabled selected>Selecione um horário</option>
							<option value="08:00">8h</option>
							<option value="08:30">8h30</option>
							<option value="09:00">9h</option>
							<option value="09:30">9h30</option>
							<option value="10:00">10h</option>
							<option value="10:30">10h30</option>
							<option value="11:00">11h</option>
							<option value="11:30">11h30</option>
							<option value="12:00">12h</option>
							<option value="12:30">12h30</option>
							<option value="13:00">13h</option>
							<option value="13:30">13h30</option>
							<option value="14:00">14h</option>
							<option value="14:30">14h30</option>
							<option value="15:00">15h</option>
							<option value="15:30">15h30</option>
							<option value="16:00">16h</option>
							<option value="16:30">16h30</option>
							<option value="17:00">17h</option>
							<option value="17:00">17h30</option>
							<option value="18:00">18h</option>
							<option value="18:00">18h30</option>
							<option value="19:00">19h*</option>
							<option value="19:00">19h30*</option>
							<option value="20:00">20h*</option>
							<option value="20:00">20h30*</option>
							<option value="21:00">21h*</option>
							<option value="21:00">21h30*</option>
							<option value="22:00">22h*</option>
					</select>
					<p class="obs">Conforme <a href="">Guia de Regras</a>, o som deverá ser desligado até 19h e as vias liberadas para trânsito até 20h.</p>
				</fieldset>
				<!-- FIM Horário da encerramento -->

				<!-- subprefeitura -->
				<fieldset>
					<label class="update__label" for="subprefeitura">Subprefeitura*</label>
					<select
						id="subprefeitura"
						:class="{ erro: errors.has('subprefeitura') }"
						class="update__input"
						type="text"
						name="subprefeitura"
						v-validate="'required'"
						@change="setOption('desfile','subprefeitura', $event)">
							<option value="" disabled selected>Selecione uma Subprefeitura</option>
							<option value="Aricanduva/Vila Formosa">Aricanduva/Vila Formosa</option>
							<option value="Butantã">Butantã</option>
							<option value="Campo Limpo">Campo Limpo</option>
							<option value="Capela do Socorro">Capela do Socorro</option>
							<option value="Casa Verde">Casa Verde</option>
							<option value="Cidade Ademar">Cidade Ademar</option>
							<option value="Cidade Tiradentes">Cidade Tiradentes</option>
							<option value="Ermelino Matarazzo">Ermelino Matarazzo</option>
							<option value="Freguesia do Ó/Brasilândia">Freguesia do Ó/Brasilândia</option>
							<option value="Guaianases">Guaianases</option>
							<option value="Ipiranga">Ipiranga</option>
							<option value="Itaim Paulista">Itaim Paulista</option>
							<option value="Itaquera">Itaquera</option>
							<option value="Jabaquara">Jabaquara</option>
							<option value="Jaçanã/Tremembé">Jaçanã/Tremembé</option>
							<option value="Lapa">Lapa</option>
							<option value="M'Boi Mirim">M'Boi Mirim</option>
							<option value="Mooca">Mooca</option>
							<option value="Parelheiros">Parelheiros</option>
							<option value="Penha">Penha</option>
							<option value="Perus">Perus</option>
							<option value="Pinheiros">Pinheiros</option>
							<option value="Pirituba/Jaraguá">Pirituba/Jaraguá</option>
							<option value="Santana/Tucuruvi">Santana/Tucuruvi</option>
							<option value="Santo Amaro">Santo Amaro</option>
							<option value="São Mateus">São Mateus</option>
							<option value="São Miguel Paulista">São Miguel Paulista</option>
							<option value="Sapopemba">Sapopemba</option>
							<option value="Sé">Sé</option>
							<option value="Vila Maria/Vila Guilherme">Vila Maria/Vila Guilherme</option>
							<option value="Vila Mariana">Vila Mariana</option>
							<option value="Vila Prudente">Vila Prudente</option>
					</select>
				</fieldset>
				<!-- FIM subprefeitura -->

				<!-- publico_2019 -->
				<fieldset>
					<label class="update__label" for="publico_2019">Público (2019)*</label>
					<select
						name="publico_2019"
						id="publico_2019"
						v-validate="'required'"
						:class="{ erro: errors.has('publico_2019') }"
						class="update__input"
						type="text"
						@change="setOption('desfile','publico_2019', $event)">
							<option value="" disabled selected>Selecione uma estimativa</option>
							<option value="0 a 100">0 a 100</option>
							<option value="100 a 500">100 a 500</option>
							<option value="500 a 1000">500 a 1000</option>
							<option value="500 a 2000">500 a 2.000</option>
							<option value="2000 a 5000">2.000 a 5.000</option>
							<option value="5000 a 10000">5.000 a 1.0000</option>
							<option value="10000 a 15000">10.000 a 15.000</option>
							<option value="20000 a 50000">20.000 a 50.000</option>
							<option value="15000 a 20000">15.000 a 20.000</option>
							<option value="50000 a 100000">50.000 a 100.000</option>
							<option value="Mais de 100000">Mais de 100.000</option>
					</select>
				</fieldset>
				<!-- FIM publico_2019 -->

				<!-- publico_estimado -->
				<fieldset>
					<label class="update__label" for="publico_estimado">Público estimado*</label>
					<input
						id="publico_estimado"
						name="publico_estimado"
						v-validate="'required'"
						:class="{ erro: errors.has('publico_estimado') }"
						class="update__input"
						type="number"
						step="100"
						v-model.number="desfile.publico_estimado">
				</fieldset>
				<!-- FIM publico_estimado -->
			</section>

			<section ref="contato">
				<h3>Contato</h3>
				<h4>Responsável</h4>
				<fieldset>
					<label class="create__label" for="name">Nome*</label>
					<input
						id="nome_responsavel"
						type="text"
						name="nome_responsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('nome_responsavel') }"
						class="create__input"
						v-model="contato.nome_responsavel"
					>
				</fieldset>
				<fieldset>
					<label class="create__label" for="cpf_cnpj_responsavel">CPF/CNPJ*</label>
					<input
						id="cpf_cnpj_responsavel"
						type="text"
						name="cpf_cnpj_responsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('cpf_cnpj_responsavel') }"
						class="create__input"
						v-model="contato.cpf_cnpj_responsavel"
					>
				</fieldset>
				<fieldset>
					<label class="create__label" for="email_responsavel">E-mail*</label>
					<input
						id="email_responsavel"
						name="email_responsavel"
						v-validate="'required|email'"
						:class="{ erro: errors.has('email_responsavel') }"
						class="create__input"
						type="email"
						v-model="contato.email_responsavel"
					>
				</fieldset>
				<fieldset>
					<label class="create__label" for="telefone_responsavel">Telefone*</label>
					<input
						id="telefone_responsavel"
						name="telefone_responsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('telefone_responsavel') }"
						class="create__input"
						type="text"
						v-model="contato.telefone_responsavel"
					>
				</fieldset>

				<h4>Corresponsável</h4>
				<fieldset>
					<label class="create__label" for="name">Nome*</label>
					<input
						id="nome_coresponsavel"
						type="text"
						name="nome_coresponsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('nome_coresponsavel') }"
						class="create__input"
						v-model="contato.nome_coresponsavel"
					>
				</fieldset>
				<fieldset>
					<label class="create__label" for="cpf_cnpj_coresponsavel">CPF/CNPJ*</label>
					<input
						id="cpf_cnpj_coresponsavel"
						type="text"
						name="cpf_cnpj_coresponsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('cpf_cnpj_coresponsavel') }"
						class="create__input"
						v-model="contato.cpf_cnpj_coresponsavel"
					>
				</fieldset>
				<fieldset>
					<label class="create__label" for="email_coresponsavel">E-mail*</label>
					<input
						id="email_coresponsavel"
						name="email_coresponsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('email_coresponsavel') }"
						class="create__input"
						type="email"
						v-model="contato.email_coresponsavel"
					>
				</fieldset>
				<fieldset>
					<label class="create__label" for="telefone_coresponsavel">Telefone*</label>
					<input
						id="telefone_coresponsavel"
						name="telefone_coresponsavel"
						v-validate="'required: false'"
						:class="{ erro: errors.has('telefone_coresponsavel') }"
						class="create__input"
						type="text"
						v-model="contato.telefone_coresponsavel"
					>
				</fieldset>
			</section>
			<!-- FIM contato -->

			<section ref="caracteristicas">
				<h3>Características</h3>
				<!-- ano_fundacao -->
				<fieldset>
					<label class="create__label" for="ano_fundacao">Ano Fundação</label>
					<input
						placeholder="1900"
						id="ano_fundacao"
						v-validate="'required'"
						:class="{ erro: errors.has('ano_fundacao') }"
						class="create__input"
						type="number"
						name="ano_fundacao"
						v-model="desfile.ano_fundacao"
					/>
				</fieldset>
				<!-- FIM ano_fundacao -->

				<!-- perfil_bloco SET CUSTOM ERROR -->
				<div class="check-errors"
					:class="{ erro: custom_errors.has('perfil_bloco') }"
				>
					<h5>Perfil do bloco</h5>
					<ul>
						<li><input type="radio" v-model="desfile.perfil_bloco" value="Familiar"><label class="create__label" for="Familiar">Familiar</label></li>
						<li><input type="radio" v-model="desfile.perfil_bloco" value="Adulto"><label class="create__label" for="Adulto">Adulto</label></li>
						<li><input type="radio" v-model="desfile.perfil_bloco" value="LGBTQI+"><label class="create__label" for="LGBTQI+">LGBTQI+</label></li>
						<li><input type="radio" v-model="desfile.perfil_bloco" value="Infantil"><label class="create__label" for="Infantil">Infantil</label></li>
						<li><input type="radio" v-model="desfile.perfil_bloco" value="Religioso"><label class="create__label" for="Religioso">Religioso</label></li>
						<li><input type="radio" v-model="desfile.perfil_bloco" value="Temático"><label class="create__label" for="Temático">Temático</label></li>
						<li>
							<input
								type="radio"
								@change="setOption('desfile', 'perfil_bloco', $event)"
								value="opcional"><label class="create__label" for="opcional">Outro<template v-if="ui.opcional.perfil_bloco">:</template></label>
							<input
								v-if="ui.opcional.perfil_bloco"
								name="perfil_bloco--opcional"
								id="perfil_bloco--opcional"
								v-model="desfile.perfil_bloco">
						</li>
					</ul>
					<p>Perfil não obrigatório, como opção para divulgação</p>
				</div>
				<!-- FIM perfil_bloco -->

				<!-- estilo_musical_predominante SET CUSTOM ERROR-->
				<div class="check-errors"
					:class="{ erro: custom_errors.has('estilo_musical_predominante') }"
					>
					<h5>Estilo musical predominante</h5>
					<ul>
						<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Diversos"><label class="create__label" for="Diversos">Diversos</label></li>
						<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Música Popular Brasileira"><label class="create__label" for="Música Popular Brasileira">Música Popular Brasileira</label></li>
						<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Samba"><label class="create__label" for="Samba">Samba</label></li>
						<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Pop"><label class="create__label" for="Pop">Pop</label></li>
						<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Axé"><label class="create__label" for="Axé">Axé</label></li>
						<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Sertanejo"><label class="create__label" for="Sertanejo">Sertanejo</label></li>
						<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Rock"><label class="create__label" for="Rock">Rock</label></li>
						<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Eletrônico"><label class="create__label" for="Eletrônico">Eletrônico</label></li>
						<li>
							<input type="radio" @change="setOption('desfile', 'estilo_musical_predominante', $event)" value="opcional"><label class="create__label" for="opcional">Outro<template v-if="ui.opcional.estilo_musical_predominante">:</template></label>
							<input
								v-if="ui.opcional.estilo_musical_predominante"
								name="estilo_musical_predominante--opcional"
								id="estilo_musical_predominante--opcional"
								v-model="desfile.estilo_musical_predominante">
						</li>
					</ul>
					<p>Perfil não obrigatório, como opção para divulgação</p>
				</div>
				<!-- FIM estilo_musical_predominante -->

				<!-- bloco_comunitario SET CUSTOM ERROR -->
				<div class="check-errors"
					:class="{ erro: custom_errors.has('bloco_comunitario') }">
					<h5>Bloco comunitário?</h5>
					<ul>
						<li><input type="radio" v-model.number="desfile.bloco_comunitario" value="1"><label class="create__label" for="1">Sim</label></li>
						<li><input type="radio" v-model.number="desfile.bloco_comunitario" value="0"><label class="create__label" for="2">Não</label></li>
					</ul>
				</div>
				<!-- FIM bloco_comunitario -->

				<!-- artistas SET CUSTOM ERROR -->
				<div class="check-errors"
					:class="{ erro: custom_errors.has('artistas') }">
					<h5>Possui artistas?</h5>
					<ul>
						<li>
							<input type="radio" @change="setOption('desfile', 'artistas', $event)" value="opcional"><label class="create__label" for="opcional">Sim<template v-if="ui.opcional.artistas">. Quais?: </template></label>
							<input
								placeholder="ex. Caju e Castanha, Madonna, Anitta"
								v-if="ui.opcional.artistas"
								name="artistas--opcional"
								id="artistas--opcional"
								v-model="desfile.artistas">
						</li>
						<li><input type="radio" v-model="desfile.artistas" value="Não"><label class="create__label" for="Não">Não</label></li>
					</ul>
				</div>
				<!-- FIM artistas -->

				<!-- bateria SET CUSTOM ERROR -->
				<div class="check-errors"
					:class="{ erro: custom_errors.has('bateria') }">
					<h5>Possui bateria?</h5>
					<ul>
						<li>
							<input type="radio" @change="setOption('desfile', 'bateria', $event)" value="opcional"><label class="create__label" for="opcional">Sim<template v-if="ui.opcional.bateria">. Descreva: </template></label>
							<input
								placeholder="ex. 2 caixas, 4 tons, 2 surdos, bumbo, chimbau, 3 pratos"
								v-if="ui.opcional.bateria"
								name="bateria--opcional"
								id="bateria--opcional"
								v-model="desfile.bateria">
						</li>
						<li><input type="radio" v-model="desfile.bateria" value="Não"><label class="create__label" for="Não">Não</label></li>
					</ul>
				</div>
				<!-- FIM bateria -->

				<!-- banda_em_trio_ou_solo SET CUSTOM ERROR -->
				<div class="check-errors"
					:class="{ erro: custom_errors.has('banda_em_trio_ou_solo') }">
					<h5>Possui banda em trio ou solo?</h5>
					<ul>
						<li>
							<input
								type="radio"
								@change="setOption('desfile', 'banda_em_trio_ou_solo', $event)"
								value="opcional"
								><label class="create__label" for="opcional"
								>Sim</label>

							<label
								v-if="ui.opcional.banda_em_trio_ou_solo"
								for="banda_em_trio_ou_solo--opcional"> Trio ou solo:</label>
							<input
								placeholder="Descreva"
								v-if="ui.opcional.banda_em_trio_ou_solo"
								name="banda_em_trio_ou_solo--opcional"
								id="banda_em_trio_ou_solo--opcional"
								v-model="desfile.banda_em_trio_ou_solo">
						</li>
						<li><input
							type="radio"
							v-model="desfile.banda_em_trio_ou_solo"
							value="Não"
							name="nao"
							><label class="create__label" for="nao">Não</label></li>
					</ul>
				</div>
				<!-- FIM banda_em_trio_ou_solo -->
			</section>
			<!-- FIM caracteristicas -->

			<section ref="operacao">
				<h3>Operação</h3>
				<!-- trio_eletrico SET CUSTOM ERROR-->
				<div class="check-errors"
					:class="{ erro: custom_errors.has('trio_eletrico') }">
					<h5>Possui trio eletétrico?</h5>
					<ul>
						<li>
							<input
								type="radio"
								@change="setOption('desfile', 'trio_eletrico', $event)"
								value="opcional"
								><label class="create__label" for="opcional">Sim</label>
							<label
								v-if="ui.opcional.trio_eletrico"
								for="trio_eletrico--opcional"> Dimensões largura x comprimento x altura (em metros)</label>
							<input
								placeholder="Descreva"
								v-if="ui.opcional.trio_eletrico"
								name="trio_eletrico--opcional"
								id="trio_eletrico--opcional"
								v-model="desfile.trio_eletrico">
						</li>
						<li>
							<input
							type="radio"
							v-model="desfile.trio_eletrico"
							value="Não"
							name="nao"
							>
							<label class="create__label" for="nao">Não</label>
						</li>
					</ul>
					<p>Consulte dimensões e autorizações especiais conforme <a href="">Guia de Regras</a> e legislação vigente.</p>
				</div>
				<!-- FIM trio_eletrico -->

				<!-- n_brigadistas -->
				<fieldset>
					<label class="create__label" for="n_brigadistas">Número de brigadistas*</label>
					<input
						placeholder="15"
						id="n_brigadistas"
						name="n_brigadistas"
						v-validate="'required'"
						:class="{ erro: errors.has('n_brigadistas') }"
						class="create__input"
						type="number"
						v-model.number="desfile.n_brigadistas">
				</fieldset>
				<!-- FIM n_brigadistas -->

				<!-- n_ambulancias -->
				<fieldset>
					<label class="create__label" for="n_ambulancias">Número de ambulâncias*</label>
					<input
						placeholder="15"
						id="n_ambulancias"
						name="n_ambulancias"
						v-validate="'required'"
						:class="{ erro: errors.has('n_ambulancias') }"
						class="create__input"
						type="number"
						v-model.number="desfile.n_ambulancias">
				</fieldset>
				<!-- FIM n_ambulancias -->

				<!-- n_cordeiros -->
				<fieldset>
					<label class="create__label" for="n_cordeiros">Número de cordeiros*</label>
					<input
						placeholder="15"
						id="n_cordeiros"
						name="n_cordeiros"
						v-validate="'required'"
						:class="{ erro: errors.has('n_cordeiros') }"
						class="create__input"
						type="number"
						v-model.number="desfile.n_cordeiros">
				</fieldset>
				<!-- FIM n_cordeiros -->

				<!-- n_segurancas_habilitados -->
				<fieldset>
					<label class="create__label" for="n_segurancas_habilitados">Número de seguranças habilitados*</label>
					<input
						placeholder="15"
						id="n_segurancas_habilitados"
						name="n_segurancas_habilitados"
						v-validate="'required'"
						:class="{ erro: errors.has('n_segurancas_habilitados') }"
						class="create__input"
						type="number"
						v-model.number="desfile.n_segurancas_habilitados">
				</fieldset>
				<!-- FIM n_segurancas_habilitados -->

				<!-- n_banheiros_quimicos -->
				<fieldset>
					<label class="create__label" for="n_banheiros_quimicos">Número de banheiros químicos*</label>
					<input
						placeholder="15"
						id="n_banheiros_quimicos"
						name="n_banheiros_quimicos"
						v-validate="'required'"
						:class="{ erro: errors.has('n_banheiros_quimicos') }"
						class="create__input"
						type="number"
						v-model.number="desfile.n_banheiros_quimicos">
				</fieldset>
				<!-- FIM n_banheiros_quimicos -->

				<!-- n_catadores_de_residuos -->
				<fieldset>
					<label class="create__label" for="n_catadores_de_residuos">Número de catadores de resíduos*</label>
					<input
						placeholder="15"
						id="n_catadores_de_residuos"
						name="n_catadores_de_residuos"
						v-validate="'required'"
						:class="{ erro: errors.has('n_catadores_de_residuos') }"
						class="create__input"
						type="number"
						v-model.number="desfile.n_catadores_de_residuos">
				</fieldset>
				<!-- FIM n_catadores_de_residuos -->

				<!-- interesse_cadastrar_ambulantes SET CUSTOM ERROR -->
				<div class="custom-errors"
					:class="{ erro: custom_errors.has('interesse_cadastrar_ambulantes') }">
					<h5>Tem interesse em cadastrar ambulantes do bloco?</h5>
					<ul>
						<li><input type="radio" v-model.number="desfile.interesse_cadastrar_ambulantes" value="1"><label class="create__label" for="1">Sim</label></li>
						<li><input type="radio" v-model.number="desfile.interesse_cadastrar_ambulantes" value="0"><label class="create__label" for="2">Não</label></li>
					</ul>
				</div>
				<!-- FIM interesse_cadastrar_ambulantes -->

				<!-- plano_de_operacao -->
				<fieldset>
					<label class="create__label" for="plano_de_operacao">Plano de operação (até 2000 carac.)*</label>
					<textarea
						placeholder="Plano da operação em até 2000 caracteres"
						id="plano_de_operacao"
						type="text"
						name="plano_de_operacao"
						v-validate="'required|max:2000'"
						:class="{ erro: errors.has('plano_de_operacao') }"
						class="create__input"
						v-model="desfile.plano_de_operacao"
					></textarea>
				</fieldset>
				<!-- FIM plano_de_operacao -->

			</section>
			<!-- FIM operacao -->

			<section ref="comunicacao">
				<h3>Comunicação</h3>
				<!-- patrocinio SET CUSTOM ERROR -->
				<div class="custom-errors"
					:class="{ erro: custom_errors.has('patrocinio') }">
					<h5>Tem patrocínio com exposição de marcas?</h5>
					<ul>
						<li>
							<input
								type="radio"
								@change="setOption('desfile', 'patrocinio', $event)"
								value="opcional"
								><label class="create__label" for="opcional">Sim</label>
							<label
								v-if="ui.opcional.patrocinio"
								for="patrocinio--opcional"> Quais?</label>
							<input
								placeholder="Lista de patrocinadores"
								v-if="ui.opcional.patrocinio"
								name="patrocinio--opcional"
								id="patrocinio--opcional"
								v-model="desfile.patrocinio">
						</li>
						<li><input
							type="radio"
							v-model="desfile.patrocinio"
							value="Não"
							name="nao"
							><label class="create__label" for="nao">Não</label>
						</li>
					</ul>
				</div>
				<!-- FIM patrocinio -->

				<!-- apoiadores SET CUSTOM ERROR -->
				<div class="custom-errors"
					:class="{ erro: custom_errors.has('apoiadores') }">
					<h5>Pretende divulgar apoiadores?</h5>
					<ul>
						<li>
							<input
								type="radio"
								@change="setOption('desfile', 'apoiadores', $event)"
								value="opcional"
								><label class="create__label" for="opcional">Sim</label>
							<label
								v-if="ui.opcional.apoiadores"
								for="apoiadores--opcional"> Quais?</label>
							<input
								placeholder="Lista de patrocinadores"
								v-if="ui.opcional.patrocinio"
								name="apoiadores--opcional"
								id="apoiadores--opcional"
								v-model="desfile.apoiadores">
						</li>
						<li><input
							type="radio"
							v-model="desfile.apoiadores"
							value="Não"
							name="nao"
							><label class="create__label" for="nao">Não</label>
						</li>
					</ul>
				</div>
				<!-- FIM apoiadores -->

				<!-- interesse_contato_empresas SET CUSTOM ERROR-->
				<div class="custom-errors"
					:class="{ erro: custom_errors.has('interesse_contato_empresas') }">
					<h5>Tem interesse em receber contato de empresas/agências interessadas em patrocinar o bloco?*</h5>
					<ul>
						<li><input type="radio" v-model.number="desfile.interesse_contato_empresas" value="1"><label class="create__label" for="1">Sim</label></li>
						<li><input type="radio" v-model.number="desfile.interesse_contato_empresas" value="0"><label class="create__label" for="2">Não</label></li>
					</ul>
				</div>
				<!-- FIM interesse_contato_empresas -->

				<!-- participar_campanhas SET CUSTOM ERROR -->
				<div class="custom-errors"
					:class="{ erro: custom_errors.has('participar_campanhas') }">
					<h5>Aceita participar das campanhas promovidas pela Prefeitura de SP durante o Carnaval?*</h5>
					<ul>
						<li><input type="radio" v-model.number="desfile.participar_campanhas" value="1"><label class="create__label" for="1">Sim</label></li>
						<li><input type="radio" v-model.number="desfile.participar_campanhas" value="0"><label class="create__label" for="2">Não</label></li>
					</ul>
				</div>
				<!-- FIM participar_campanhas -->

				<!-- autoriza_divulgacao SET CUSTOM ERROR -->
				<div class="custom-errors"
					:class="{ erro: custom_errors.has('autoriza_divulgacao') }">
					<h5>Autoriza divulgação?*</h5>
					<ul>
						<li><input type="radio" v-model.number="desfile.autoriza_divulgacao" value="1"><label class="create__label" for="1">Sim</label></li>
						<li><input type="radio" v-model.number="desfile.autoriza_divulgacao" value="0"><label class="create__label" for="2">Não</label></li>
					</ul>
				</div>
				<!-- FIM autoriza_divulgacao -->

				<!-- resenha -->
				<label class="create__label" for="resenha">Resenha (até 1000 carac.)*</label>
				<textarea
					placeholder="ex. O Bloco da Maria é um tradicional bloco do bairro X..."
					type="text"
					name="resenha"
					v-validate="'required'"
					:class="{ erro: errors.has('resenha') }"
					class="create__input"
					v-model="desfile.resenha"
				></textarea>
				<!-- FIM resenha -->

			</section>
			<!-- FIM comunicacao -->

			<section ref="regras">
				<h3>Aceite</h3>
				<a href="" id="guiaDownload">
					<i class="icon-pdf icon"><span>pdf</span></i>
					<span>Guia de Regras 2020</span>
				</a>
				<!-- aceite_das_regras -->
				<fieldset id="aceite">
					<input
						type="checkbox"
						id="aceite_das_regras"
						name="aceite_das_regras"
						v-validate="'required'"
						:class="{ erro: errors.has('aceite_das_regras') }"
						v-model.number="desfile.aceite_das_regras">
					<label class="create__label" for="aceite_das_regras">Li e concordo com o conteúdo do Guia de Regras 2020.</label>
				</fieldset>
				<!-- aceite_das_regras -->
			</section>
			<!-- FIM regras -->

			<nav>
				<button class="enviar" @click.prevent="atualizar">Enviar</button>
			</nav>
		</form>
		<!-- <Mapa></Mapa> -->
	</div>
</template>

<script>
import axios from 'axios'
import fechadura from '@spurb/fechadura'
import apiconfig from '../utils/api.config.json'
import { mapState } from 'vuex'
import Mapa from '@/components/Mapa'

export default {
	name: 'FormUpdate',
	$_veeValidate: {
		validator: 'new' // instância de validator isolado neste componente
	},
	data () {
		return {
			custom_errors: new Map(),
			custom_errors_items: [
				'artistas',
				'banda_em_trio_ou_solo',
				'bateria',
				'bloco_comunitario',
				'perfil_bloco',
				'estilo_musical_predominante',
				'trio_eletrico',
				'interesse_cadastrar_ambulantes',
				'patrocinio',
				'apoiadores',
				'interesse_contato_empresas',
				'participar_campanhas',
				'autoriza_divulgacao'
			],

			fetch: {
				fazendo: false,
				sucesso: true,
				mensagem: ''
			},

			ui: {
				opcional: {
					data_do_desfile_2020: false,
					perfil_bloco: false,
					estilo_musical_predominante: false,
					artistas: false,
					bateria: false,
					banda_em_trio_ou_solo: false,
					trio_eletrico: false,
					patrocinio: false,
					apoiadores: false
				}
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
				// id: '',
				nome_do_bloco: '',
				sentido_ab: 1, // nao se aplica a este form mas precisa constar no body do post
				mapa_ok: 0, // nao se aplica a este form mas precisa constar no body do post
				endereco_concentracao: '',
				complemento_concentracao: '',
				cep_concentracao: '',
				bairro_concentracao: '',
				itinerario: '',
				endereco_dispersao: '',
				complemento_dispersao: '',
				cep_dispersao: '',
				// faltou bairro.
				data_do_desfile_2019: '',
				data_do_desfile_2020: '',
				hr_concentracao: '',
				hr_desfile: '',
				hr_encerramento: '',
				subprefeitura: '',
				publico_2019: '',
				publico_estimado: '',
				ano_fundacao: '',
				perfil_bloco: '',
				estilo_musical_predominante: '',
				bloco_comunitario: '',
				artistas: '',
				bateria: '',
				banda_em_trio_ou_solo: '',
				aceite_das_regras: '',
				apoiadores: '',
				autoriza_divulgacao: '',
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
				plano_de_operacao: '',
				resenha: '',
				trio_eletrico: ''
			},

			percurso: {}
		}
	},
	components: {
		Mapa
	},
	mounted () {
		/*
		 * Copia valores de props para este componente para permitir a edição dos valores com v-model neste componente apenas.
		*/
		this.$watch(vm => vm.formFields, () => {
			this.desfile.id = this.formFields.id
			this.desfile.nome_do_bloco = decodeURIComponent(escape(this.formFields.nome_do_bloco))
			// this.desfile.sentido_ab = this.formFields.sentido_ab
			// this.desfile.mapa_ok = this.formFields.mapa_ok
			this.desfile.endereco_concentracao = decodeURIComponent(escape(this.formFields.endereco_concentracao))
			this.desfile.endereco_dispersao = decodeURIComponent(escape(this.formFields.endereco_dispersao))
			this.desfile.complemento_concentracao = decodeURIComponent(escape(this.formFields.complemento_concentracao))
			this.desfile.complemento_dispersao = decodeURIComponent(escape(this.formFields.complemento_dispersao))
			this.desfile.bairro_concentracao = decodeURIComponent(escape(this.formFields.bairro_concentracao))
			this.desfile.bairro_dispersao = this.formFields.bairro_dispersao // faltou bairro_dispersao
			this.desfile.cep_concentracao = this.formFields.cep_concentracao
			this.desfile.cep_dispersao = this.formFields.cep_dispersao
			this.desfile.itinerario = decodeURIComponent(escape(this.formFields.itinerario))
			this.desfile.data_do_desfile_2019 = this.formFields.data_do_desfile_2019
			this.desfile.data_do_desfile_2020 = this.formFields.data_do_desfile_2020
			this.desfile.hr_concentracao = this.formFields.hr_concentracao
			this.desfile.hr_desfile = this.formFields.hr_desfile
			this.desfile.hr_encerramento = this.formFields.hr_encerramento
			this.desfile.subprefeitura = this.formFields.subprefeitura
			this.desfile.publico_2019 = this.formFields.publico_2019
			this.desfile.publico_estimado = this.formFields.publico_estimado
			this.desfile.ano_fundacao = this.formFields.ano_fundacao
			this.desfile.perfil_bloco = this.formFields.perfil_bloco
			this.desfile.estilo_musical_predominante = this.formFields.estilo_musical_predominante
			this.desfile.bloco_comunitario = this.formFields.bloco_comunitario
			this.desfile.artistas = this.formFields.artistas
			this.desfile.bateria = this.formFields.bateria
			this.desfile.banda_em_trio_ou_solo = this.formFields.banda_em_trio_ou_solo
			this.desfile.aceite_das_regras = this.formFields.aceite_das_regras
			this.desfile.apoiadores = this.formFields.apoiadores
			this.desfile.autoriza_divulgacao = this.formFields.autoriza_divulgacao
			this.desfile.id_contato = this.formFields.id_contato
			this.desfile.id_percurso = this.formFields.id_percurso
			this.desfile.interesse_cadastrar_ambulantes = this.formFields.interesse_cadastrar_ambulantes
			this.desfile.interesse_contato_empresas = this.formFields.interesse_contato_empresas
			this.desfile.n_ambulancias = this.formFields.n_ambulancias
			this.desfile.n_banheiros_quimicos = this.formFields.n_banheiros_quimicos
			this.desfile.n_brigadistas = this.formFields.n_brigadistas
			this.desfile.n_catadores_de_residuos = this.formFields.n_catadores_de_residuos
			this.desfile.n_cordeiros = this.formFields.n_cordeiros
			this.desfile.n_segurancas_habilitados = this.formFields.n_segurancas_habilitados
			this.desfile.participar_campanhas = this.formFields.participar_campanhas
			this.desfile.patrocinio = this.formFields.patrocinio
			this.desfile.plano_de_operacao = decodeURIComponent(escape(this.formFields.plano_de_operacao))
			this.desfile.resenha = decodeURIComponent(escape(this.formFields.resenha))
			this.desfile.trio_eletrico = this.formFields.trio_eletrico
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
		displayToggle (el, type) {
			this.ui[el][type] = !this.ui[el][type]
		},

		setOption (grupo, item, evento, placeholder = '') {
			if (evento.target.value === 'opcional') { // Lida com exceções em 'select' e 'radio' definidos pelo valor 'opcional' para controlar inputs opcionais
				this.ui['opcional'][item] = true
				this[grupo][item] = placeholder
			} else {
				this.ui['opcional'][item] = false
				this[grupo][item] = evento.target.value
			}
		},

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

<style lang="scss" scoped>
@import '../assets/_variables.scss';
@import '../assets/FORM';

.form--update {
	max-width: 700px;
	padding: 0 1rem;
	margin: 0 auto;
	text-align: left;
	section {
		margin: 2rem 0;
		fieldset {
			position: relative;
			& .errorPointer {
				display: block;
				margin: 0.5rem 0 0 1rem;
				font-size: small;
				line-height: 0.8rem;
				color: $preto;
				&::before {
					content: '!';
					display: inline-block;
					color: $vermelho;
					text-align: center;
					line-height: 0.75rem;
					border: 1px solid $vermelho;
					border-radius: 100%;
					width: 0.8rem;
					height: 0.8rem;
					margin-right: 0.25rem;
				}
			}
		}
	}
	form {
		nav {
			margin: 6rem 0;
			button {
				font-family: $grotesca;
				font-size: 1rem;
				border: 4px solid $branco-clique;
				color: #FFF;
				text-transform: uppercase;
				background-color: $verde;
				padding: 0.75rem 1rem;
				border-radius: 4px;
				width: 100%;
				cursor: pointer;
				&:hover {
					opacity: 0.8;
				}
			}
			@media (max-width: 600px) {
				margin: 3rem 0;
				button {
					width: auto;
				}
			}
		}
	}
}
a#guiaDownload {
	display: flex;
	align-items: center;
	margin: 2rem 0 1rem;
	background-color: $vermelho;
	color: #FFF;
	text-decoration: none;
	padding: 1.75rem;
	border: 4px solid $branco-clique;
	border-radius: 0.25rem;
	transition: all ease-in .05s;
	.icon {
		font-size: 1.5rem;
		margin-right: 0.5rem;
	}
	span {
		display: inline-block;
		font-size: 1.25rem;
		line-height: 1.6;
	}
	&:hover {
		background-color: $vermelho-tr;
	}
	@media (max-width: 600px) {
		padding: 0.5rem;
		.icon { font-size: 1.25rem; }
		span { font-size: 1rem; }
	}
}
fieldset#aceite {
	& > label {
		width: calc(100% - 1.5rem);
		padding-left: 0.5rem;
		margin-bottom: 0;
		vertical-align: middle;
	}
}
</style>
