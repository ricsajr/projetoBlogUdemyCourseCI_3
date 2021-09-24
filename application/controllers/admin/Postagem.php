<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Postagem extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}
		$this->load->model('categorias_model','modelcategorias');/*o segundo parâmetro
		é um alias*/
		$this->load->model('publicacoes_model', 'modelpublicacao');
		$this->categorias = $this->modelcategorias->listar_categorias();

	}

	public function index(){
		$this->load->library('table');
		$data['categorias'] = $this->categorias;
		$data['publicacoes'] = $this->modelpublicacao->listar_publicacao();
		$data['titulo'] = 'Painel de Controle';
		$data['subtitulo'] = 'Postagem';

		$header['titulo'] = 'Painel de Controle';
		$header['subtitulo'] = 'Postagem';

		$this->load->view('backend/template/html-header',$header);
		$this->load->view('backend/template/template', $header);
		$this->load->view('backend/postagem', $data);
		$this->load->view('backend/template/html-footer');

	}
	public function inserir(){
		//carrego a biblioteca para validação de form
		$this->load->library('form_validation');
		//listo os campos que desejo validar;(nome do campo, nome de exibição na validação, regras)
		$this->form_validation->set_rules('txt-titulo','Titulo','required|min_length[3]');
		$this->form_validation->set_rules('txt-subtitulo','Subtitulo','required|min_length[3]');
		$this->form_validation->set_rules('txt-conteudo','Conteudo','required|min_length[20]');
		//lembrar de validar campo data com jquery
		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$titulo = $this->input->post('txt-titulo');
			$subtitulo = $this->input->post('txt-subtitulo');
			$conteudo = $this->input->post('txt-conteudo');
			$datapub = $this->input->post('txt-data');
			$categoria = $this->input->post('select-categoria');
			$userpub = $this->input->post('txt-usuario');
			if($this->modelpublicacao->adicionar($titulo, $subtitulo, $conteudo, $datapub, $categoria, $userpub)){
				redirect(base_url('admin/postagem'));
			}
			else{
				echo 'Ops, ocorreu um erro';
			}
		}

	}
	public function excluir($id){

		if($this->modelpublicacao->excluir($id)){
			redirect(base_url('admin/postagem'));
		}
		else{
			echo 'Ops, ocorreu um erro';
		}

	}


	public function alterar($id){

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



}
