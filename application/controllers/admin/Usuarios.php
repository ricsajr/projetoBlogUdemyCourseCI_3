<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();


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

	public function pag_login(){

		$data['titulo'] = 'Painel de Controle';
		$data['subtitulo'] = 'Entrar no sistema';

		$header['titulo'] = 'Painel de Controle';
		$header['subtitulo'] = 'Home';

		$this->load->view('backend/template/html-header',$data);
		$this->load->view('backend/login', $data);
		$this->load->view('backend/template/html-footer');


	}

	public function login(){
		//carrego a biblioteca para validação de form
		$this->load->library('form_validation');
		//listo os campos que desejo validar;(nome do campo, nome de exibição na validação, regras)
		$this->form_validation->set_rules('txt-user','Usuario','required|min_length[3]');
		$this->form_validation->set_rules('txt-senha','Senha','required|min_length[3]');
		if($this->form_validation->run() == FALSE){
			$this->pag_login();
		}
		else{
			$usuario= $this->input->post('txt-user');
			$senha= $this->input->post('txt-senha');

			$this->db->where('user', $usuario);//helper db armazena montagem da query
			$this->db->where('senha', $senha);
			$userlogado = $this->db->get('usuario')->result();
			if(count($userlogado)==1){
				$dadosSessao['userlogado'] = $userlogado[0];
				$dadosSessao['logado'] = TRUE;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin'));
			}
			else{
				$dadosSessao['userlogado'] = NULL;
				$dadosSessao['logado'] = FALSE;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin/login'));
			}

		}
	}


	public function logout(){
		$dadosSessao['userlogado'] = NULL;
		$dadosSessao['logado'] = FALSE;
		$this->session->set_userdata($dadosSessao);
		redirect(base_url('admin/login'));
	}

}
