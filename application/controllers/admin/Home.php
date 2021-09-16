<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}


	}

	public function index(){
		$data['titulo'] = 'Painel de Controle';
		$data['subtitulo'] = 'Home';

		$header['titulo'] = 'Painel de Controle';
		$header['subtitulo'] = 'Home';

		$this->load->view('backend/template/html-header',$data);
		$this->load->view('backend/template/template', $data);
		$this->load->view('backend/home', $data);
		$this->load->view('backend/template/html-footer');

	}


}
