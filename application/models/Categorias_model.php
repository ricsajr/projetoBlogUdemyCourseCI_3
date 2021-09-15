<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

	public $id;
	public $titulo;


	public function __construct(){
		parent::__construct();


	}

	public function listar_categorias(){
		//ordenando antes de exibir
		$this->db->order_by('titulo','ASC'); //ASC para ascendente DESC para descendente
		return $this->db->get('categoria')->result();

	}

	public function  listar_titulo($id){
		$this->db->from('categoria');
		$this->db->where('id ='.$id);
		return $this->db->get()->result();

	}

	public function adicionar($titulo){
		$dados['titulo'] = $titulo;
		return $this->db->insert('categoria', $dados);
	}




}
