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
	public function insert($fornecedor){
		return $this->fornecedorDAO->insert($fornecedor);
	}
	public function update($fornecedor){
		return $this->fornecedorDAO->update($fornecedor);
	}
	public function delete($fornecedor){
		return $this->fornecedorDAO->delete($fornecedor);
	}
	public function findAll(){
		return $this->fornecedorDAO->findAll();
	}
	public function findById($fornecedor){
		return $this->fornecedorDAO->findById($fornecedor);
	}
}
?>