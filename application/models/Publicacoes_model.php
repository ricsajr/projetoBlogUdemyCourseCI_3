<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacoes_model extends CI_Model {

	public $id;
	public $categoria;
	public $titulo;
	public $subtitulo;
	public $conteudo;
	public $data;
	public $img;
	public $user;


	public function __construct(){
		parent::__construct();


	}

	public function destaques_home(){
		// estudar montagem da query
		$this->db->select('usuario.id as idautor,
			usuario.nome, postagens.id, postagens.titulo,
			postagens.subtitulo, postagens.user, postagens.data, postagens.img');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id = postagens.user');

		$this->db->limit(4);//traz apenas os 4 ultimos itens
		//ordenando antes de exibir
		$this->db->order_by('postagens.data','DESC'); //ASC para ascendente DESC para descendente
		return $this->db->get()->result();
	}


	public function categoria_pub($id){

		// estudar montagem da query
		$this->db->select('usuario.id as idautor,
			usuario.nome, postagens.id, postagens.titulo,
			postagens.subtitulo, postagens.user, postagens.data,
			postagens.img, postagens.categoria');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id = postagens.user');
		$this->db->where('postagens.categoria ='.$id);
		//ordenando antes de exibir
		$this->db->order_by('postagens.data','DESC'); //ASC para ascendente DESC para descendente
		return $this->db->get()->result();

	}

	public function publicacao($id){
		// estudar montagem da query
		$this->db->select('usuario.id as idautor,
			usuario.nome, postagens.id, postagens.titulo,
			postagens.subtitulo, postagens.user, postagens.data,
			postagens.img, postagens.categoria, postagens.conteudo');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id = postagens.user');
		$this->db->where('postagens.id ='.$id); // nesse caso trará apenas um resultado
		return $this->db->get()->result();
	}

	public function  listar_titulo($id){
		$this->db->select('id,titulo');
		$this->db->from('postagens');
		$this->db->where('id ='.$id);
		return $this->db->get()->result();

	}

	public function listar_publicacao(){
		//ordenando antes de exibir
		$this->db->order_by('data','DESC'); //ASC para ascendente DESC para descendente
		return $this->db->get('postagens')->result();

	}
	public function listar_publicacoes($id){
		//ordenando antes de exibir
		$this->db->where('md5(id)',$id);
		return $this->db->get('postagens')->result();

	}

	public function adicionar($titulo, $subtitulo, $conteudo, $datapub, $categoria, $userpub){
		$dados['titulo'] = $titulo;
		$dados['subtitulo'] = $subtitulo;
		$dados['conteudo'] = $conteudo;
		$dados['user'] = $userpub;
		$dados['data'] = $datapub;
		$dados['categoria'] = $categoria;
		return $this->db->insert('postagens', $dados);
	}

	public function excluir($id){
		//utilizando o md5() dentro da query, comparamos o id da coluna, também criptografado
		$this->db->where('md5(id)',$id);// pegar id da url e comparar com o do banco encriptado
		return $this->db->delete('postagens');//deletar selecionado em categoria


	}
	public function alterar($titulo, $subtitulo, $conteudo, $datapub, $categoria,$id){
		$dados['titulo'] = $titulo;
		$dados['subtitulo'] = $subtitulo;
		$dados['conteudo'] = $conteudo;
		$dados['data'] = $datapub;
		$dados['categoria'] = $categoria;
		$this->db->where('id', $id);
		return $this->db->update('postagens',$dados);

	}





}
