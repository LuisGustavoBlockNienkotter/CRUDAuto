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
	public function inserir($usuario){
		return $this->usuarioDAO->inserir($usuario);
	}
	public function atualizar($usuario){
		return $this->usuarioDAO->atualizar($usuario);
	}
	public function deletar($usuario){
		return $this->usuarioDAO->deletar($usuario);
	}
	public function listar($usuario){
		return $this->usuarioDAO->listar($usuario);
	}
	public function procurarPorId($usuario){
		return $this->usuarioDAO->procurarPorId($usuario);
	}
}
?>