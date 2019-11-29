<?php

namespace app\controllers;
use core\AbsController;
use core\Redirector;
use app\model\dao\UsuarioDAO;
use app\model\bo\UsuarioBO;
use app\model\dto\Usuario;

class UsuarioController extends AbsController{
	
	public function findAll(){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$obj = $usuarioBO->findAll();
		$this->view->usuario = $obj;
		$this->requestView('usuario/index', 'baseHtml');
	}
	public function cadastrar(){
		$this->requestView('usuario/insert' , 'baseHtml');
	}
	public function visualizar($id){
		$this->requestView('usuario/update' , 'baseHtml');
	}
	public function insert($request){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuario = (new Usuario())->setId($request->post->id)
		->setNome($request->post->nome)
		->setLogin($request->post->login)
		->setSenha($request->post->senha);
		$usuarioBO->insert($usuario);
		Redirector::toRoute('/usuario');
	}
	public function delete($id){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuario = (new Usuario())->setId($id);
		$usuarioBO->delete($usuario);
		Redirector::toRoute('/usuario');
	}
	public function update($id, $request){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuario = (new Usuario())->setId($id);
		$obj = $usuarioBO->findById($usuario)[0];
		$obj->setId($request->post->id)
		->setNome($request->post->nome)
		->setLogin($request->post->login)
		->setSenha($request->post->senha);
		$usuarioBO->update($obj);
		Redirector::toRoute('/usuario');
	}
	public function findById($id){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuario = (new Usuario())->setId($id);
		$obj = $usuarioBO->findById($usuario);
		$this->view->usuario = $obj;
		$this->requestView('usuario/update', 'baseHtml');
	}
}
?>