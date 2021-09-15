<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('categorias_model','modelcategorias');/*o segundo parâmetro
		é um alias*/
		$this->categorias = $this->modelcategorias->listar_categorias();

	}

	public function index(){
		$this->load->library('table');
		$data['categorias'] = $this->categorias;
		$data['titulo'] = 'Painel de Controle';
		$data['subtitulo'] = 'Categoria';

		$header['titulo'] = 'Painel de Controle';
		$header['subtitulo'] = 'Categoria';

		$this->load->view('backend/template/html-header',$data);
		$this->load->view('backend/template/template', $data);
		$this->load->view('backend/categoria', $data);
		$this->load->view('backend/template/html-footer');

	}
	public function inserir(){
		//carrego a biblioteca para validação de form
		$this->load->library('form_validation');
		//listo os campos que desejo validar;(nome do campo, nome de exibição na validação, regras)
		$this->form_validation->set_rules('txt-categoria','Nome da Categoria','required|min_length[3]|is_unique[categoria.titulo]');
		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$titulo = $this->input->post('txt-categoria');
			if($this->modelcategorias->adicionar($titulo)){
				redirect(base_url('admin/categoria'));
			}
			else{
				echo 'Ops, ocorreu um erro';
			}
		}

	}


}
