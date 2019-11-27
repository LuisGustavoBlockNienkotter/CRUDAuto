<?php
namespace app\model\dto; 
class Rocket { 

	private $id;
	private $codigo;
	private $altura;
	private $largura;
	private $peso;

	public function getId(){
		return $this->id;
	}
	public function getCodigo(){
		return $this->codigo;
	}
	public function getAltura(){
		return $this->altura;
	}
	public function getLargura(){
		return $this->largura;
	}
	public function getPeso(){
		return $this->peso;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	public function setCodigo($codigo){
		$this->codigo = $codigo;
		return $this;
	}
	public function setAltura($altura){
		$this->altura = $altura;
		return $this;
	}
	public function setLargura($largura){
		$this->largura = $largura;
		return $this;
	}
	public function setPeso($peso){
		$this->peso = $peso;
		return $this;
	}

}
?>