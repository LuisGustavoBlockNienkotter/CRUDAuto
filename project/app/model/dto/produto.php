<?php
namespace app\model\dto; 
class Produto { 

	private $id;
	private $descricao;
	private $ncm;
	private $estoque;

	public function getId(){
		return $this->id;
	}
	public function getDescricao(){
		return $this->descricao;
	}
	public function getNcm(){
		return $this->ncm;
	}
	public function getEstoque(){
		return $this->estoque;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	public function setDescricao($descricao){
		$this->descricao = $descricao;
		return $this;
	}
	public function setNcm($ncm){
		$this->ncm = $ncm;
		return $this;
	}
	public function setEstoque($estoque){
		$this->estoque = $estoque;
		return $this;
	}

}
?>