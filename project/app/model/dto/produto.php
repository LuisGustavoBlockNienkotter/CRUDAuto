<?php
class Produto { 

	private $id;
	private $desc;
	private $ncm;
	private $estoque;

	public function __construct ($id, $desc, $ncm, $estoque){
		$this->id = $id;
		$this->desc = $desc;
		$this->ncm = $ncm;
		$this->estoque = $estoque;
	}
	public function getId(){
		return $this->id;
	}
	public function getDesc(){
		return $this->desc;
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
	public function setDesc($desc){
		$this->desc = $desc;
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