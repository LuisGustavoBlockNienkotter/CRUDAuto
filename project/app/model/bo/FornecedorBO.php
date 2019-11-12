<?php

namespace app\model\bo;
use app\interfaces\IDAO;
use app\model\dao\FornecedorDAO;
use app\model\dto\Fornecedor;

class FornecedorBO{
	private $fornecedorDAO;
	public function __construct($fornecedorDAO){
		$this->fornecedorDAO = $fornecedorDAO;
	}
	public function inserir($fornecedor){
		return $this->fornecedorDAO->inserir($fornecedor);
	}
	public function atualizar($fornecedor){
		return $this->fornecedorDAO->atualizar($fornecedor);
	}
	public function deletar($fornecedor){
		return $this->fornecedorDAO->deletar($fornecedor);
	}
	public function listar($fornecedor){
		return $this->fornecedorDAO->listar($fornecedor);
	}
	public function procurarPorId($fornecedor){
		return $this->fornecedorDAO->procurarPorId($fornecedor);
	}
}
?>