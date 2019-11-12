<?php

namespace app\controllers;
use core\AbsController;
use app\model\dao\FornecedorDAO;
use app\model\bo\FornecedorBO;
use app\model\dto\Fornecedor;

class FornecedorController extends AbsController{
	
	public function index(){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$obj = $fornecedorBO->listar();
		$this->view->fornecedor = $obj;
		$this->requisitarView('fornecedor/index');
	}
	public function inserir($request){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id)
		->setNome($request->post->nome)
		->setCpf($request->post->cpf);
		$fornecedorBO->inserir($fornecedor);
		$this->requisitarView('fornecedor/cadastrar');
	}
	public function deletar($id){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id);
		$fornecedorBO->deletar($fornecedor);
		$this->requisitarView('fornecedor/deletar');
	}
	public function atualizar($id, $request){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id);
		$obj = $fornecedorBO->procurarPorId($fornecedor);
		$obj = (new Fornecedor())->setId($request->post->id)
		->setNome($request->post->nome)
		->setCpf($request->post->cpf);
		$fornecedorBO->atualizar($fornecedor);
		$this->requisitarView('fornecedor/atualizar');
	}
	public function procurarPorId($id){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id);
		$obj = $fornecedorBO->procurarPorId($fornecedor);
		$this->view->fornecedor = $obj;
		$this->requisitarView('fornecedor/visualizar');
	}
}
?>