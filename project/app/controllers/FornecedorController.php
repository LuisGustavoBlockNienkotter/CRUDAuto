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
		$fornecedorBO->listar();
	}
	public function inserir($request){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id)
		->setNome($request->post->nome)
		->setCpf($request->post->cpf);
		$fornecedorBO->inserir($fornecedor);
	}
	public function deletar($id){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setAlgumaCoisa();
		$fornecedorBO->deletar($fornecedor);
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
	}
	public function procurarPorId($id){
		$fornecedorDAO = new FornecedorDAO();
		$fornecedorBO = new FornecedorBO($fornecedorDAO);
		$fornecedor = (new Fornecedor())->setId($request->post->id);
		$obj = $fornecedorBO->procurarPorId($fornecedor);
	}
}
?>