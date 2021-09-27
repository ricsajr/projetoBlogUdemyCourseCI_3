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
		$data['categorias'] = $this->modelcategorias->listar_categorias();
		$data['publicacoes'] = $this->modelpublicacao->listar_publicacoes($id);
		$data['titulo'] = 'Painel de Controle';
		$data['subtitulo'] = 'Publicação';

		$header['titulo'] = 'Painel de Controle';
		$header['subtitulo'] = 'Alterar - Publicação';

		$this->load->view('backend/template/html-header',$data);
		$this->load->view('backend/template/template', $data);
		$this->load->view('backend/alterar-publicacao', $data);
		$this->load->view('backend/template/html-footer');


	}

	public function salvar_alteracoes(){

		//carrego a biblioteca para validação de form
		$this->load->library('form_validation');
		//listo os campos que desejo validar;(nome do campo, nome de exibição na validação, regras)
		$this->form_validation->set_rules('txt-titulo','Titulo','required|min_length[3]');
		$this->form_validation->set_rules('txt-subtitulo','Subtitulo','required|min_length[3]');
		$this->form_validation->set_rules('txt-conteudo','Conteudo','required|min_length[20]');
		//lembrar de validar campo data com jquery
		if($this->form_validation->run() == FALSE){
			$this->alterar($this->input->post('txt-usuario'));
		}
		else{
			$titulo = $this->input->post('txt-titulo');
			$subtitulo = $this->input->post('txt-subtitulo');
			$conteudo = $this->input->post('txt-conteudo');
			$datapub = $this->input->post('txt-data');
			$categoria = $this->input->post('select-categoria');
			$id = $this->input->post('txt-id');
			if($this->modelpublicacao->alterar($titulo, $subtitulo, $conteudo, $datapub, $categoria,$id)){
				redirect(base_url('admin/postagem'));
			}
			else{
				echo 'Ops, ocorreu um erro';
			}
		}

	}
	public function nova_foto(){
		if(!$this->session->userdata('logado')){
			redirect(base_url('admin/login'));
		}


		$id = $this->input->post('id');
		$config['upload_path'] = './assets/frontend/img/publicacoes';//apontar para o diretorio onde a imagem será salva
		$config['allowed_types'] = 'jpg';// tipos de arquivo aceitos
		$config['file_name'] = $id.".jpg";// id do usuario concatenado com ".extensão
		$config['overwrite'] = TRUE;// TRUE para quando trocarmos a imagem, ela ser substituída
		//carregar biblioteca de upload de imagens
		$this->load->library('upload', $config);

		//se não der upload
		if(!$this->upload->do_upload()){
			echo $this->upload->display_errors();
		}
		else{
			//aqui posso adicionar thumb, marca d'água etc...
			//nesse caso configurando o tamanho apenas
			$config2['source_image'] = './assets/frontend/img/publicacoes/'.$id.'.jpg';
			$config2['create_thumb'] = FALSE;
			$config2['width'] = 900;//medida em pixels
			$config2['height'] = 300;//medida em pixels
			//carregando a lib que altera imagens
			$this->load->library('image_lib', $config2);
			if($this->image_lib->resize()){
				if($this->modelpublicacao->alterar_img($id)){
					redirect(base_url('admin/postagem/alterar/'.$id));
				}
				else{
					echo 'Ops, ocorreu um erro';
				}

			}
			else{
				echo $this->image_lib->display_errors();
			}

		}





	}




}
