<template>
	<div class="form--create">

			<form @submit.prevent="criar"> <!-- validação da DOM é assíncrona -->

				<section ref="desfile">
					<h3>Desfile</h3>
					<label for="nome_do_bloco">Nome do bloco (até 100 caracteres)</label>
					<input
						placeholder="ex. Bloco da Maria"
						id="nome_do_bloco"
						type="text"
						name="nome_do_bloco"
						v-validate="'required|min:2'"
						:class="{ erro: errors.has('nome_do_bloco') }"
						v-model="desfile.nome_do_bloco"
					>
					<span>{{ errors.first('nome_do_bloco') }}</span>

					<!-- concentração -->
					<label for="endereco_concentracao">Endereço da concentração (até 100 caracteres)</label>
					<input
						placeholder="ex. Avenida São João"
						id="endereco_concentracao"
						type="text"
						name="endereco_concentracao"
						v-validate="'required|between:3,100'"
						:class="{ erro: errors.has('endereco_concentracao') }"
						v-model="desfile.endereco_concentracao"
					>

					<label for="complemento_concentracao">Complemento (até 100 caracteres)</label>
					<input
						placeholder="ex. nº 1432"
						id="complemento_concentracao"
						type="text"
						name="complemento_concentracao"
						v-validate="'required|between:1,100'"
						:class="{ erro: errors.has('complemento_concentracao') }"
						v-model="desfile.complemento_concentracao"
					>

					<label for="cep_concentracao">CEP</label>
					<input
						placeholder="00000-000"
						id="cep_concentracao"
						type="text"
						name="cep_concentracao"
						v-validate="'required|between:3,20'"
						:class="{ erro: errors.has('cep_concentracao') }"
						v-model="desfile.cep_concentracao"
					>
					<!-- consulta correios -> http://www.buscacep.correios.com.br/sistemas/buscacep/ -->

					<label for="bairro_concentracao">Bairro</label>
					<input
						placeholder="ex. Santa Cecília"
						id="bairro_concentracao"
						type="text"
						name="bairro_concentracao"
						v-validate="'required|between:3,100'"
						:class="{ erro: errors.has('bairro_concentracao') }"
						v-model="desfile.bairro_concentracao"
					>

					<label for="itinerario">Itinerário (até 1000 caracteres)</label>
					<textarea
						placeholder="ex. R. Oliveira Melo, R. Imprensa, R. Frei Durão, R. Debret"
						id="itinerario"
						type="text"
						name="itinerario"
						v-validate="'required|between:3,1000'"
						:class="{ erro: errors.has('itinerario') }"
						v-model="desfile.itinerario"
					></textarea>

					<!-- disperção -->
					<label for="endereco_dispersao">Endereço da disperção (até 100 caracteres)</label>
					<input
						placeholder="ex. R. Oliveira Melo (entre R. Imprensa e R. Debret)"
						id="endereco_dispersao"
						type="text"
						name="endereco_dispersao"
						v-validate="'required|between:3,100'"
						:class="{ erro: errors.has('endereco_dispersao') }"
						v-model="desfile.endereco_dispersao"
					>

					<label for="complemento_dispersao">Complemento (até 100 caracteres)</label>
					<input
						placeholder="ex. nº 1432"
						id="complemento_dispersao"
						type="text"
						name="complemento_dispersao"
						v-validate="'required|between:3,100'"
						:class="{ erro: errors.has('complemento_dispersao') }"
						v-model="desfile.complemento_dispersao"
					>

					<label for="cep_dispersao">CEP</label>
					<input
						placeholder="00000-000"
						id="cep_dispersao"
						type="text"
						name="cep_dispersao"
						v-validate="'required|between:3,100'"
						:class="{ erro: errors.has('cep_dispersao') }"
						v-model="desfile.cep_dispersao"
					>
					<!-- consulta correios -> http://www.buscacep.correios.com.br/sistemas/buscacep/ -->

					<!-- **************** NON ECXISTE: bairro_dispersao ************** -->
					<!-- api/model/desfiles.php (branch backend) nem no banco de dados -->
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
					<!-- **************** NON ECXISTE: bairro_dispersao ************** -->

					<!-- ***** datas ******* -->
					<!-- Data (2019) -->
					<label for="data_do_desfile_2019">Data (2019)</label>
					<input
						id="data_do_desfile_2019"
						type="date"
						name="data_do_desfile_2019"
						v-validate="'required:false'"
						:class="{ erro: errors.has('data_do_desfile_2019') }"
						v-model="desfile.data_do_desfile_2019"
					/>

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
					<label for="data_do_desfile_2020">Data (2020)</label>
					<select
						id="data_do_desfile_2020"
						type="text"
						name="data_do_desfile_2020"
						:class="{ erro: errors.has('data_do_desfile_2020') }"
						v-validate="'required'"
						@change="setOption('desfile','data_do_desfile_2020', $event, 'Opcional.')">
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
							<option value="opcional">Opcional (blocos tradicionais ou históricos)</option>
					</select>
					<textarea
						v-if="ui.opcional.data_do_desfile_2020"
						name="data_do_desfile_2020--opcional"
						id="data_do_desfile_2020--opcional"
						:class="{ erro: errors.has('data_do_desfile_2020') }"
						cols="30" rows="10"
						v-model="desfile.data_do_desfile_2020">
					</textarea>
					<p v-else>Caso seja bloco tradicional com histórico, selecione <strong>opcional</strong> para especificar outra data e horário nas observações conforme desfiles de anos anteriores.</p>
					<!-- FIM Data (2020) -->

					<!-- Horário da concentração -->
					<label for="hr_concentracao">Horário da concentração*</label>
					<select
						id="hr_concentracao"
						:class="{ erro: errors.has('hr_concentracao') }"
						type="text"
						name="hr_concentracao"
						v-validate="'required'"
						@change="setOption('desfile','hr_concentracao', $event)">
							<option value="" disabled selected>Selecione um horário</option>
							<option value="00:08:00">8h</option>
							<option value="00:08:30">8h30</option>
							<option value="00:09:00">9h</option>
							<option value="00:09:30">9h30</option>
							<option value="00:10:00">10h</option>
							<option value="00:10:30">10h30</option>
							<option value="00:11:00">11h</option>
							<option value="00:11:30">11h30</option>
							<option value="00:12:00">12h</option>
							<option value="00:12:30">12h30</option>
							<option value="00:13:00">13h</option>
							<option value="00:13:30">13h30</option>
							<option value="00:14:00">14h</option>
							<option value="00:14:30">14h30</option>
							<option value="00:15:00">15h</option>
							<option value="00:15:30">15h30</option>
							<option value="00:16:00">16h</option>
							<option value="00:16:30">16h30</option>
							<option value="00:17:00">17h</option>
					</select>
					<!-- FIM Horário da concentração -->

					<!-- Horário da desfile -->
					<label for="hr_desfile">Horário do desfile*</label>
					<select
						id="hr_desfile"
						:class="{ erro: errors.has('hr_desfile') }"
						type="text"
						name="hr_desfile"
						v-validate="'required'"
						@change="setOption('desfile','hr_desfile', $event)">
							<option value="" disabled selected>Selecione um horário</option>
							<option value="00:08:00">8h</option>
							<option value="00:08:30">8h30</option>
							<option value="00:09:00">9h</option>
							<option value="00:09:30">9h30</option>
							<option value="00:10:00">10h</option>
							<option value="00:10:30">10h30</option>
							<option value="00:11:00">11h</option>
							<option value="00:11:30">11h30</option>
							<option value="00:12:00">12h</option>
							<option value="00:12:30">12h30</option>
							<option value="00:13:00">13h</option>
							<option value="00:13:30">13h30</option>
							<option value="00:14:00">14h</option>
							<option value="00:14:30">14h30</option>
							<option value="00:15:00">15h</option>
							<option value="00:15:30">15h30</option>
							<option value="00:16:00">16h</option>
							<option value="00:16:30">16h30</option>
							<option value="00:17:00">17h</option>
					</select>
					<!-- FIM Horário da desfile -->

					<!-- Horário da encerramento -->
					<label for="hr_encerramento">Horário de encerramento*</label>
					<select
						id="hr_encerramento"
						:class="{ erro: errors.has('hr_encerramento') }"
						type="text"
						name="hr_encerramento"
						v-validate="'required'"
						@change="setOption('desfile','hr_encerramento', $event)">
							<option value="" disabled selected>Selecione um horário</option>
							<option value="00:08:00">8h</option>
							<option value="00:08:30">8h30</option>
							<option value="00:09:00">9h</option>
							<option value="00:09:30">9h30</option>
							<option value="00:10:00">10h</option>
							<option value="00:10:30">10h30</option>
							<option value="00:11:00">11h</option>
							<option value="00:11:30">11h30</option>
							<option value="00:12:00">12h</option>
							<option value="00:12:30">12h30</option>
							<option value="00:13:00">13h</option>
							<option value="00:13:30">13h30</option>
							<option value="00:14:00">14h</option>
							<option value="00:14:30">14h30</option>
							<option value="00:15:00">15h</option>
							<option value="00:15:30">15h30</option>
							<option value="00:16:00">16h</option>
							<option value="00:16:30">16h30</option>
							<option value="00:17:00">17h</option>
							<option value="00:17:00">17h30</option>
							<option value="00:18:00">18h</option>
							<option value="00:18:00">18h30</option>
							<option value="00:19:00">19h*</option>
							<option value="00:19:00">19h30*</option>
							<option value="00:20:00">20h*</option>
							<option value="00:20:00">20h30*</option>
							<option value="00:21:00">21h*</option>
							<option value="00:21:00">21h30*</option>
							<option value="00:22:00">22h*</option>
					</select>
					<!-- FIM Horário da encerramento -->
					<p>*Conforme Guia de Regras, o som deverá ser desligado até 19h e as vias liberadas para trânsito até 20h.</p>

					<!-- subprefeitura -->
					<label for="subprefeitura">subprefeitura</label>
					<select
						id="subprefeitura"
						:class="{ erro: errors.has('subprefeitura') }"
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
					<!-- FIM subprefeitura -->

					<!-- publico_2019 -->
					<label for="publico_2019">Público (2019)</label>
					<select
						name="publico_2019"
						id="publico_2019"
						v-validate="'required'"
						:class="{ erro: errors.has('publico_2019') }"
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
					<!-- FIM publico_2019 -->

					<!-- publico_estimado -->
					<label for="publico_estimado">Público estimado*</label>
					<input
						placeholder="100"
						id="publico_estimado"
						name="publico_estimado"
						v-validate="'required'"
						:class="{ erro: errors.has('publico_estimado') }"
						type="number"
						v-model.number="desfile.publico_estimado">
					<!-- FIM publico_estimado -->
				</section>
				<!-- FIM desfile -->

				<section ref="contato">
					<h3>Contato</h3>
					<h4>Responsável</h4>
					<label for="name">Nome</label>
					<input
						id="nome_responsavel"
						type="text"
						name="nome_responsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('nome_responsavel') }"
						v-model="contato.nome_responsavel"
					>

					<label for="cpf_cnpj_responsavel">CPF/CNPJ</label>
					<input
						id="cpf_cnpj_responsavel"
						type="text"
						name="cpf_cnpj_responsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('cpf_cnpj_responsavel') }"
						v-model="contato.cpf_cnpj_responsavel"
					>

					<label for="email_responsavel">Email</label>
					<input
						id="email_responsavel"
						name="email_responsavel"
						v-validate="'required|email'"
						:class="{ erro: errors.has('email_responsavel') }"
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
					<h4>Co-responsável</h4>
					<label for="name">Nome</label>
					<input
						id="nome_coresponsavel"
						type="text"
						name="nome_coresponsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('nome_coresponsavel') }"
						v-model="contato.nome_coresponsavel"
					>

					<label for="cpf_cnpj_coresponsavel">CPF/CNPJ</label>
					<input
						id="cpf_cnpj_coresponsavel"
						type="text"
						name="cpf_cnpj_coresponsavel"
						v-validate="'required'"
						:class="{ erro: errors.has('cpf_cnpj_coresponsavel') }"
						v-model="contato.cpf_cnpj_coresponsavel"
					>

					<label for="email_coresponsavel">Email</label>
					<input
						id="email_coresponsavel"
						name="email_coresponsavel"
						v-validate="'required'"
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
				</section>
				<!-- FIM contato -->

				<section ref="caracteristicas">
					<h3>Características</h3>
					<!-- ano_fundacao -->
					<label for="ano_fundacao">Ano Fundação</label>
					<input
						id="ano_fundacao"
						v-validate="'required'"
						:class="{ erro: errors.has('ano_fundacao') }"
						type="date"
						name="ano_fundacao"
						v-model="desfile.ano_fundacao"
					/>
					<!-- FIM ano_fundacao -->

					<!-- perfil_bloco SET CUSTOM ERROR -->
					<div ref="_check-errors__perfil_bloco"
						:class="{ erro: custom_errors.has('perfil_bloco') }"
					>
						<h5>Perfil do bloco</h5>
						<ul>
							<li><input type="radio" v-model="desfile.perfil_bloco" value="Familiar"><label for="Familiar">Familiar</label></li>
							<li><input type="radio" v-model="desfile.perfil_bloco" value="Adulto"><label for="Adulto">Adulto</label></li>
							<li><input type="radio" v-model="desfile.perfil_bloco" value="LGBTQI+"><label for="LGBTQI+">LGBTQI+</label></li>
							<li><input type="radio" v-model="desfile.perfil_bloco" value="Infantil"><label for="Infantil">Infantil</label></li>
							<li><input type="radio" v-model="desfile.perfil_bloco" value="Religioso"><label for="Religioso">Religioso</label></li>
							<li><input type="radio" v-model="desfile.perfil_bloco" value="Temático"><label for="Temático">Temático</label></li>
							<li>
								<input
									type="radio"
									@change="setOption('desfile', 'perfil_bloco', $event)"
									value="opcional"><label for="opcional">Outro<template v-if="ui.opcional.perfil_bloco">:</template></label>
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
					<div ref="_check-errors__estilo_musical_predominante"
						:class="{ erro: custom_errors.has('estilo_musical_predominante') }">
						<h5>Estilo musical predominante</h5>
						<ul>
							<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Diversos"><label for="Diversos">Diversos</label></li>
							<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Música Popular Brasileira"><label for="Música Popular Brasileira">Música Popular Brasileira</label></li>
							<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Samba"><label for="Samba">Samba</label></li>
							<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Pop"><label for="Pop">Pop</label></li>
							<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Axé"><label for="Axé">Axé</label></li>
							<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Sertanejo"><label for="Sertanejo">Sertanejo</label></li>
							<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Rock"><label for="Rock">Rock</label></li>
							<li><input type="radio" v-model="desfile.estilo_musical_predominante" value="Eletrônico"><label for="Eletrônico">Eletrônico</label></li>
							<li>
								<input type="radio" @change="setOption('desfile', 'estilo_musical_predominante', $event)" value="opcional"><label for="opcional">Outro<template v-if="ui.opcional.estilo_musical_predominante">:</template></label>
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
					<div ref="_check-errors__bloco_comunitario"
						:class="{ erro: custom_errors.has('bloco_comunitario') }">
						<h5>Bloco comunitário?</h5>
						<ul>
							<li><input type="radio" v-model.number="desfile.bloco_comunitario" value="1"><label for="1">Sim</label></li>
							<li><input type="radio" v-model.number="desfile.bloco_comunitario" value="0"><label for="2">Não</label></li>
						</ul>
					</div>
					<!-- FIM bloco_comunitario -->

					<!-- artistas SET CUSTOM ERROR -->
					<div ref="_check-errors__artistas"
						:class="{ erro: custom_errors.has('artistas') }">
						<h5>Possui artistas?</h5>
						<ul>
							<li>
								<input type="radio" @change="setOption('desfile', 'artistas', $event)" value="opcional"><label for="opcional">Sim<template v-if="ui.opcional.artistas">. Quais?: </template></label>
								<input
									placeholder="ex. Caju e Castanha, Madonna, Anitta"
									v-if="ui.opcional.artistas"
									name="artistas--opcional"
									id="artistas--opcional"
									v-model="desfile.artistas">
							</li>
							<li><input type="radio" v-model="desfile.artistas" value="Não"><label for="Não">Não</label></li>
						</ul>
					</div>
					<!-- FIM artistas -->

					<!-- bateria SET CUSTOM ERROR -->
					<div ref="_check-errors__bateria"
						:class="{ erro: custom_errors.has('bateria') }">
						<h5>Possui bateria?</h5>
						<ul>
							<li>
								<input type="radio" @change="setOption('desfile', 'bateria', $event)" value="opcional"><label for="opcional">Sim<template v-if="ui.opcional.bateria">. Descreva: </template></label>
								<input
									placeholder="ex. 2 caixas, 4 tons, 2 surdos, bumbo, chimbau, 3 pratos"
									v-if="ui.opcional.bateria"
									name="bateria--opcional"
									id="bateria--opcional"
									v-model="desfile.bateria">
							</li>
							<li><input type="radio" v-model="desfile.bateria" value="Não"><label for="Não">Não</label></li>
						</ul>
					</div>
					<!-- FIM bateria -->

					<!-- banda_em_trio_ou_solo SET CUSTOM ERROR -->
					<div ref="_check-errors__banda_em_trio_ou_solo"
						:class="{ erro: custom_errors.has('banda_em_trio_ou_solo') }">
						<h5>Possui banda em trio ou solo?</h5>
						<ul>
							<li>
								<input
									type="radio"
									@change="setOption('desfile', 'banda_em_trio_ou_solo', $event)"
									value="opcional"
									><label for="opcional"
									>Sim.</label>

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
								id="nao"
								name="nao"
								><label for="nao">Não</label></li>
						</ul>
					</div>
					<!-- FIM banda_em_trio_ou_solo -->

				</section>
				<!-- FIM caracteristicas -->

				<section ref="operacao">
					<h3>Operação</h3>

					<!-- trio_eletrico -->
					<!-- FIM trio_eletrico -->

					<!-- n_brigadistas -->
					<!-- FIM n_brigadistas -->

					<!-- n_cordeiros -->
					<!-- FIM n_cordeiros -->

					<!-- n_segurancas_habilitados -->
					<!-- FIM n_segurancas_habilitados -->

					<!-- n_banheiros_quimicos -->
					<!-- FIM n_banheiros_quimicos -->

					<!-- n_catadores_de_residuos -->
					<!-- FIM n_catadores_de_residuos -->

					<!-- interesse_cadastrar_ambulantes -->
					<!-- FIM interesse_cadastrar_ambulantes -->

					<!-- plano_de_operacao -->
					<!-- FIM plano_de_operacao -->

				</section>
				<!-- FIM operacao -->

				<button @click.prevent="criar">Criar </button>
			</form>

	</div>
</template>

<script>
import axios from 'axios'
import fechadura from '@spurb/fechadura'
import apiconfig from '../utils/api.config.json'

// Sugestão -> utilizar um autofill para testar o formulário durante o desenvolvimento:
// https://chrome.google.com/webstore/detail/form-filler/bnjjngeaknajbdcgpfkgnonkmififhfo

export default {
	name: 'FormCreate',
	$_veeValidate: {
		validator: 'new' // instância de validator isolado neste componente
	},
	data () {
		return {
			custom_errors: new Map(),

			ui: {
				opcional: {
					data_do_desfile_2020: false,
					perfil_bloco: false,
					estilo_musical_predominante: false,
					artistas: false,
					bateria: false,
					banda_em_trio_ou_solo: false
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
				id: '',
				nome_do_bloco: '',
				sentido_ab: '1', // nao se aplica a este form mas precisa constar no body do post
				mapa_ok: '0', // nao se aplica a este form mas precisa constar no body do post
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

				// caracteristicas
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
			}
		}
	},
	created () {
		/* Preenche os campos já conhecidos pela aplicação */
		this.contato.email_responsavel = this.$route.params.email
	},

	methods: {
		customErrors () {
			/*
			* @return aplica classe 'error' em custom errors. Retorna Boolean (verdadeiro se existir erro)
			*/
			this.custom_errors.clear()

			const customCheck = [
				'artistas',
				'banda_em_trio_ou_solo',
				'bateria',
				'bloco_comunitario',
				'perfil_bloco'
			]

			customCheck
				.filter(val => this.desfile[val] === '')
				.forEach(err => this.custom_errors.set(err, 'erro'))

			return this.custom_errors.size !== 0
		},

		criar () {
			/*
			 * 0. Valida
			 * 1. Cria contato em /contato
			 * 2. Cria desfile em /desfile com id de contato criado
			*/

			// 0.1. Validacao de custom_errors
			const isCustomError = this.customErrors()

			// 0.2. Validacao de v-validate
			this.$validator.validate()
				.then(valid => {
					if (!valid || isCustomError) {
						console.log('not-valid')
						return true
					}
				})

			const config = {
				headers: {
					Current: fechadura(apiconfig.chave, 'bicho').encript,
					'Content-Type': 'application/json'
				}
			}

			// 1
			axios.post(apiconfig.base + '/contato/', this.contato, config)
				.then(res => console.log(res))
				.catch(err => console.log(err))
		},

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
