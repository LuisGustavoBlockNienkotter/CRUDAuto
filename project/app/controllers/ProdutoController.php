<?php

namespace app\controllers;
use core\AbsController;
use core\Redirector;
use app\model\dao\ProdutoDAO;
use app\model\bo\ProdutoBO;
use app\model\dto\Produto;

class ProdutoController extends AbsController{
	
	public function findAll(){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$obj = $produtoBO->findAll();
		$this->view->produto = $obj;
		$this->requestView('produto/index', 'baseHtml');
	}
	public function cadastrar(){
		$this->requestView('produto/insert' , 'baseHtml');
	}
	public function insert($request){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($request->post->id)
		->setDescricao($request->post->descricao)
		->setNcm($request->post->ncm)
		->setEstoque($request->post->estoque);
		$produtoBO->insert($produto);
		$this->requestView('produto/insert', 'baseHtml');
	}
	public function delete($id){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($id);
		$produtoBO->delete($produto);
		Redirector::toRoute('/produto');
	}
	public function update($id, $request){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($request->post->id);
		$obj = $produtoBO->findById($produto);
		$obj = (new Produto())->setId($request->post->id)
		->setDescricao($request->post->descricao)
		->setNcm($request->post->ncm)
		->setEstoque($request->post->estoque);
		$produtoBO->update($produto);
		$this->requestView('produto/update', 'baseHtml');
	}
	public function findById($id){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($request->post->id);
		$obj = $produtoBO->findById($produto);
		$this->view->produto = $obj;
		$this->requestView('produto/findById', 'baseHtml');
	}
}
?>