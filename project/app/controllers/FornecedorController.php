<?php

namespace app\controllers;
use core\AbsController;
use app\model\dao\FornecedorDAO;
use app\model\bo\FornecedorBO;
use app\model\dto\Fornecedor;

class FornecedorController extends AbsController{
	
	public function findAll(){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$obj = $fornecedorBO->findAll();
		$this->view->fornecedor = $obj;
		$this->requestView('fornecedor/index');
	}
	public function insert($request){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id)
		->setNome($request->post->nome)
		->setCpf($request->post->cpf);
		$fornecedorBO->insert($fornecedor);
		$this->requestView('fornecedor/insert');
	}
	public function delete($id){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id);
		$fornecedorBO->delete($fornecedor);
		$this->requestView('fornecedor/delete');
	}
	public function update($id, $request){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id);
		$obj = $fornecedorBO->findById($fornecedor);
		$obj = (new Fornecedor())->setId($request->post->id)
		->setNome($request->post->nome)
		->setCpf($request->post->cpf);
		$fornecedorBO->update($fornecedor);
		$this->requestView('fornecedor/update');
	}
	public function findById($id){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id);
		$obj = $fornecedorBO->findById($fornecedor);
		$this->view->fornecedor = $obj;
		$this->requestView('fornecedor/findById');
	}
}
?>