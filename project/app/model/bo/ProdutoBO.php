<?php

namespace app\model\bo;
use app\interfaces\IDAO;
use app\model\dao\ProdutoDAO;
use app\model\dto\Produto;

class ProdutoBO{
	private $produtoDAO;
	public function __construct($produtoDAO){
		$this->produtoDAO = $produtoDAO;
	}
	public function insert($produto){
		return $this->produtoDAO->insert($produto);
	}
	public function update($produto){
		return $this->produtoDAO->update($produto);
	}
	public function delete($produto){
		return $this->produtoDAO->delete($produto);
	}
	public function findAll(){
		return $this->produtoDAO->findAll();
	}
	public function findById($produto){
		return $this->produtoDAO->findById($produto);
	}
}
?>