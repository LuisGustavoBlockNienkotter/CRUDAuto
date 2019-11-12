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
	public function inserir($produto){
		return $this->produtoDAO->inserir($produto);
	}
	public function atualizar($produto){
		return $this->produtoDAO->atualizar($produto);
	}
	public function deletar($produto){
		return $this->produtoDAO->deletar($produto);
	}
	public function listar($produto){
		return $this->produtoDAO->listar($produto);
	}
	public function procurarPorId($produto){
		return $this->produtoDAO->procurarPorId($produto);
	}
}
?>