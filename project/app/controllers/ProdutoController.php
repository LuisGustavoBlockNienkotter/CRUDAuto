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
	public function visualizar($id){
		$this->requestView('produto/update' , 'baseHtml');
	}
	public function insert($request){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($request->post->id)
		->setDescricao($request->post->descricao)
		->setNcm($request->post->ncm)
		->setEstoque($request->post->estoque);
		$produtoBO->insert($produto);
		Redirector::toRoute('/produto');
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
		$produto = (new Produto())->setId($id);
		$obj = $produtoBO->findById($produto)[0];
		$obj->setId($request->post->id)
		->setDescricao($request->post->descricao)
		->setNcm($request->post->ncm)
		->setEstoque($request->post->estoque);
		$produtoBO->update($obj);
		Redirector::toRoute('/produto');
	}
	public function findById($id){
		$produtoDAO = new ProdutoDAO();
		$produtoBO = new ProdutoBO($produtoDAO);
		$produto = (new Produto())->setId($id);
		$obj = $produtoBO->findById($produto);
		$this->view->produto = $obj;
		$this->requestView('produto/update', 'baseHtml');
	}
}
?>