<?php

namespace app\controllers;
use core\AbsController;
use core\Redirector;
use app\model\dao\FornecedorDAO;
use app\model\bo\FornecedorBO;
use app\model\dto\Fornecedor;

class FornecedorController extends AbsController{
	
	public function findAll(){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$obj = $fornecedorBO->findAll();
		$this->view->fornecedor = $obj;
		$this->requestView('fornecedor/index', 'baseHtml');
	}
	public function cadastrar(){
		$this->requestView('fornecedor/insert' , 'baseHtml');
	}
	public function visualizar($id){
		$this->requestView('fornecedor/update' , 'baseHtml');
	}
	public function insert($request){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id)
		->setNome($request->post->nome)
		->setCpf($request->post->cpf);
		$fornecedorBO->insert($fornecedor);
		Redirector::toRoute('/fornecedor');
	}
	public function delete($id){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($id);
		$fornecedorBO->delete($fornecedor);
		Redirector::toRoute('/fornecedor');
	}
	public function update($id, $request){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($id);
		$obj = $fornecedorBO->findById($fornecedor)[0];
		$obj->setId($request->post->id)
		->setNome($request->post->nome)
		->setCpf($request->post->cpf);
		$fornecedorBO->update($obj);
		Redirector::toRoute('/fornecedor');
	}
	public function findById($id){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($id);
		$obj = $fornecedorBO->findById($fornecedor);
		$this->view->fornecedor = $obj;
		$this->requestView('fornecedor/update', 'baseHtml');
	}
}
?>