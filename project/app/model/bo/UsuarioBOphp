<?php

namespace app\model\bo;
use app\interfaces\IDAO;
use app\model\dao\UsuarioDAO;
use app\model\dto\Usuario;

class UsuarioBO{
	private $usuarioDAO;
	public function __construct($usuarioDAO){
		$this->usuarioDAO = $usuarioDAO;
	}
	public function insert($usuario){
		return $this->usuarioDAO->insert($usuario);
	}
	public function update($usuario){
		return $this->usuarioDAO->update($usuario);
	}
	public function delete($usuario){
		return $this->usuarioDAO->delete($usuario);
	}
	public function findAll(){
		return $this->usuarioDAO->findAll();
	}
	public function findById($usuario){
		return $this->usuarioDAO->findById($usuario);
	}
}
?>