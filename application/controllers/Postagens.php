<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens extends CI_Controller {

	public function __construct(){
		parent::__construct();
		/*carregar model no construct pois precisamos
		em varias partes que carregam sempre*/
		$this->load->model('categorias_model','modelcategorias');/*o segundo parâmetro
		é um alias*/
		$this->categorias = $this->modelcategorias->listar_categorias();

	}

	public function index($id, $slug=null){
		$data['categorias'] = $this->categorias;
		$this->load->model('publicacoes_model', 'modelpublicacoes');
		$data['postagens'] = $this->modelpublicacoes->publicacao($id);

		$data['subtitulodb'] = $this->modelpublicacoes->listar_titulo($id);

		$header['titulo'] = 'Publicacao';
		$header['subtitulo'] = '';
		$header['subtitulodb'] = $data['subtitulodb'];

		$this->load->view('frontend/template/html-header',$header);
		$this->load->view('frontend/template/header', $data);
		$this->load->view('frontend/publicacao', $data);
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}




}
