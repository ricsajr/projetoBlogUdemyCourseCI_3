<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobrenos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		/*carregar model no construct pois precisamos
		em varias partes que carregam sempre*/
		$this->load->model('categorias_model','modelcategorias');/*o segundo parâmetro
		é um alias*/
		$this->categorias = $this->modelcategorias->listar_categorias();
		$this->load->model('usuarios_model', 'modelusuarios');

	}

	public function index(){
		$data['categorias'] = $this->categorias;

		$data['autores'] = $this->modelusuarios->listar_autores();

		$data['titulo'] = 'Sobre Nós';
		$data['subtitulo'] = 'Conheça nossa equipe';
		$header['titulo'] = 'Sobre Nós';
		$header['subtitulo'] = 'Conheça nossa equipe';


		$this->load->view('frontend/template/html-header',$header);
		$this->load->view('frontend/template/header', $data);
		$this->load->view('frontend/sobrenos', $data);
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function autores($id, $slug=null){

		$data['categorias'] = $this->categorias;

		$data['autores'] = $this->modelusuarios->listar_autor($id);

		$header['titulo'] = 'Sobre Nós';
		$header['subtitulo'] = 'Autor';


		$this->load->view('frontend/template/html-header',$header);
		$this->load->view('frontend/template/header', $data);
		$this->load->view('frontend/autor', $data);
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');

	}


}
