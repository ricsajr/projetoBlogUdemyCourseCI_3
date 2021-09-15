<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct(){
		parent::__construct();


	}

	public function index(){
		$data['titulo'] = 'Painel de Controle';
		$data['subtitulo'] = 'Categoria';

		$header['titulo'] = 'Painel de Controle';
		$header['subtitulo'] = 'Categoria';

		$this->load->view('backend/template/html-header',$data);
		$this->load->view('backend/template/template', $data);
		$this->load->view('backend/categoria', $data);
		$this->load->view('backend/template/html-footer');

	}


}
