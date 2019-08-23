<?php
require_once "GenericDAO.php";

class Desfile extends GenericDAO{
	
	private $aceite_das_regras;
	private $ano_fundacao;
	private $apoiadores;
	private $artistas;
    private $autoriza_divulgacao;
    private $bairro_concentracao;
    private $banda_em_trio_ou_solo;
    private $bateria;
	private $bloco_comunitario;
    private $cep_concentracao;
    private $cep_dispersao;
    private $complemento_concentracao;
    private $complemento_dispersao;
    private $data_do_desfile_2019;
    private $data_do_desfile_2020;
    private $endereco_concentracao;
    private $endereco_dispersao;
    private $estilo_musical_predominante;
    private $hr_concentracao;
    private $hr_desfile;
    private $hr_encerramento;
    private $id;
    private $id_contato;
    private $id_percurso;
    private $interesse_cadastrar_ambulantes;
    private $interesse_contato_empresas;
    private $itinerario;
    private $mapa_ok;
    private $nome_do_bloco;
    private $n_ambulancias;
    private $n_banheiros_quimicos;
    private $n_brigadistas;
    private $n_catadores_de_residuos;
    private $n_cordeiros;
    private $n_segurancas_habilitados;
    private $participar_campanhas;
    private $patrocinio;
    private $perfil_bloco;
    private $plano_de_operacao;
    private $publico_2019;
    private $publico_estimado;
    private $resenha;
    private $sentido_ab;
    private $subprefeitura;
    private $trio_eletrico;
	
	public function __construct(){

	
		$tableName = "desfile";
		$classProps =  get_class_vars(get_class($this));
		/*
			key = coluna do banco => value = property da classe
		*/
		$columns = array();
        foreach($classProps as $name => $val){
            $columns[$name] = $name;
        }

		parent::__construct($tableName, $columns);
	}
	
	public function __get($campo) {
		return $this -> $campo;
	}

	public function __set($campo, $valor) {
		$this -> $campo = $valor;
	}
	
}
