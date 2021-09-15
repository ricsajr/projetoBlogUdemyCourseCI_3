<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacoes_model extends CI_Model {

	public $id;
	public $categoria;
	public $titulo;
	public $subtitulo;
	public $conteudo;
	public $data;
	public $img;
	public $user;


	public function __construct(){
		parent::__construct();


	}

	public function destaques_home(){
		//ordenando antes de exibir
		$this->db->limit(4);//traz apenas os 4 ultimos itens
		$this->db->order_by('data','DESC'); //ASC para ascendente DESC para descendente
		return $this->db->get('postagens')->result();

	}




}
