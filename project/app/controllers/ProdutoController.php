<?php

namespace app\controllers;
use core\AbsController;
use app\model\dao\ProdutoDAO;
use app\model\bo\ProdutoBO;
use app\model\dto\Produto;

class ProdutoController extends AbsController{
	
	public function index(){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$obj = $produtoBO->listar();
		$this->view->produto = $obj;
		$this->requisitarView('produto/index');
	}
	public function inserir($request){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($request->post->id)
		->setDesc($request->post->desc)
		->setNcm($request->post->ncm)
		->setEstoque($request->post->estoque);
		$produtoBO->inserir($produto);
		$this->requisitarView('produto/cadastrar');
	}
	public function deletar($id){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($request->post->id);
		$produtoBO->deletar($produto);
		$this->requisitarView('produto/deletar');
	}
	public function atualizar($id, $request){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($request->post->id);
		$obj = $produtoBO->procurarPorId($produto);
		$obj = (new Produto())->setId($request->post->id)
		->setDesc($request->post->desc)
		->setNcm($request->post->ncm)
		->setEstoque($request->post->estoque);
		$produtoBO->atualizar($produto);
		$this->requisitarView('produto/atualizar');
	}
	public function procurarPorId($id){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($request->post->id);
		$obj = $produtoBO->procurarPorId($produto);
		$this->view->produto = $obj;
		$this->requisitarView('produto/visualizar');
	}
}
?>