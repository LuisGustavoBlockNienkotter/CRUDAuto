<?php
namespace app\model\dto; 
class Fornecedor { 

	private $id;
	private $nome;
	private $cpf;

	public function getId(){
		return $this->id;
	}
	public function getNome(){
		return $this->nome;
	}
	public function getCpf(){
		return $this->cpf;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}
	public function setCpf($cpf){
		$this->cpf = $cpf;
		return $this;
	}

}
?>