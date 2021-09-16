<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();


	}

	public function index(){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}

		$this->load->library('table'); //preciso pra gerar a table na view

		$this->load->model('usuarios_model', 'modelusuarios');
		$data['titulo'] = 'Painel de Controle';
		$data['subtitulo'] = 'Home';
		$data['usuarios'] = $this->modelusuarios->listar_autores();

		$header['titulo'] = 'Painel de Controle';
		$header['subtitulo'] = 'Usuários';

		$this->load->view('backend/template/html-header',$data);
		$this->load->view('backend/template/template', $data);
		$this->load->view('backend/usuarios', $data);
		$this->load->view('backend/template/html-footer');

	}

	public function inserir(){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
		//carrego a biblioteca para validação de form
		$this->load->library('form_validation');
		//listo os campos que desejo validar;(nome do campo, nome de exibição na validação, regras)
		$this->form_validation->set_rules('txt-nome','Nome do Usuário','required|min_length[3]');
		$this->form_validation->set_rules('txt-email','Email','required|valid_email|');
		$this->form_validation->set_rules('txt-historico','Histórico','required|min_length[20]');
		$this->form_validation->set_rules('txt-user','Username','required|min_length[3]|is_unique[usuario.user]');
		$this->form_validation->set_rules('txt-senha','Senha','required|min_length[3]');
		$this->form_validation->set_rules('txt-confirmarsenha','Confirmar Senha','required|matches[txt-senha]');
		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$nome = $this->input->post('txt-nome');
			$email = $this->input->post('txt-email');
			$historico = $this->input->post('txt-historico');
			$user = $this->input->post('txt-user');
			$senha = $this->input->post('txt-senha');
			if($this->modelusuarios->adicionar($nome, $email, $historico, $user, $senha)){
				redirect(base_url('admin/categoria'));
			}
			else{
				echo 'Ops, ocorreu um erro';
			}
		}

	}
	public function excluir($id){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}

		if($this->modelcategorias->excluir($id)){
			redirect(base_url('admin/categoria'));
		}
		else{
			echo 'Ops, ocorreu um erro';
		}

	}


	public function alterar($id){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}

		$this->load->library('table');
		$data['categorias'] = $this->modelcategorias->listar_categoria($id);
		$data['titulo'] = 'Painel de Controle';
		$data['subtitulo'] = 'Categoria';

		$header['titulo'] = 'Painel de Controle';
		$header['subtitulo'] = 'Alterar - Categoria';

		$this->load->view('backend/template/html-header',$data);
		$this->load->view('backend/template/template', $data);
		$this->load->view('backend/alterar-categoria', $data);
		$this->load->view('backend/template/html-footer');


	}

	public function salvar_alteracoes(){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}

		//carrego a biblioteca para validação de form
		$this->load->library('form_validation');
		//listo os campos que desejo validar;(nome do campo, nome de exibição na validação, regras)
		$this->form_validation->set_rules('txt-categoria','Nome da Categoria','required|min_length[3]|is_unique[categoria.titulo]');
		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$titulo = $this->input->post('txt-categoria');
			$id = $this->input->post('txt-id');
			if($this->modelcategorias->alterar($titulo,$id)){
				redirect(base_url('admin/categoria'));
			}
			else{
				echo 'Ops, ocorreu um erro';
			}
		}

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
