<?php
namespace app\model\dto; 
class Usuario { 

	private $id;
	private $nome;
	private $login;
	private $senha;

	public function getId(){
		return $this->id;
	}
	public function getNome(){
		return $this->nome;
	}
	public function getLogin(){
		return $this->login;
	}
	public function getSenha(){
		return $this->senha;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}
	public function setLogin($login){
		$this->login = $login;
		return $this;
	}
	public function setSenha($senha){
		$this->senha = $senha;
		return $this;
	}

}
?>