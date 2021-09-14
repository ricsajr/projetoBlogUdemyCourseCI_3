<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class OlaMundo extends CI_Controller {


	public function index()
	{
		$data['mensagem'] = 'Ola Mundo!';
		$this->load->view('olamundo', $data);
	}

	public function teste(){
		$data['mensagem'] = 'Testando!';
		$this->load->view('olamundo', $data);
	}
	public function testedb(){
		$dados['mensagem'] = $this->db->get('postagens')->result();
		echo "<pre>";
		print_r($dados);
	}
}
