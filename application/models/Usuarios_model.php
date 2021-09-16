<?php
//impede o acesso direto à pasta por url!!!
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public $id;
	public $nome;
	public $email;
	public $img;
	public $historico;
	public $user;
	public $senha;


	public function __construct(){
		parent::__construct();


	}


	public function  listar_autor($id){
		$this->db->select('id,nome,historico,img');
		$this->db->from('usuario');
		$this->db->where('id ='.$id);
		return $this->db->get()->result();

	}
	public function  listar_autores(){
		$this->db->select('id,nome,img');
		$this->db->from('usuario');
		$this->db->order_by('nome', 'ASC');
		return $this->db->get()->result();

	}
	public function adicionar($nome, $email, $historico, $user, $senha){
		$dados['nome'] = $nome;
		$dados['email'] = $email;
		$dados['historico'] = $historico;
		$dados['user'] = $user;
		$dados['senha'] = md5($senha);
		return $this->db->insert('usuario', $dados);
	}

	public function excluir($id){
		//utilizando o md5() dentro da query, comparamos o id da coluna, também criptografado
		$this->db->where('md5(id)',$id);// pegar id da url e comparar com o do banco encriptado
		return $this->db->delete('usuario');//deletar selecionado em categoria


	}
	public function  listar_usuario($id){
		$this->db->select('id,nome,historico,email,user');
		$this->db->from('usuario');
		$this->db->where('md5(id)',$id);
		return $this->db->get()->result();

	}


	public function alterar($nome, $email, $historico, $user, $senha, $id){
		$dados['nome'] = $nome;
		$dados['email'] = $email;
		$dados['historico'] = $historico;
		$dados['user'] = $user;
		$dados['senha'] = md5($senha);
		$dados['senha'] = md5($senha);
		$this->db->where('id', $id);
		return $this->db->update('categoria',$dados);

	}



}
