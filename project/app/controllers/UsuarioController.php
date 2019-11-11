<?php

namespace app\controllers;
use core\AbsController;
use app\model\dao\UsuarioDAO;
use app\model\bo\UsuarioBO;
use app\model\dto\Usuario;

class UsuarioController extends AbsController{
	
	public function index(){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuarioBO->listar();
	}
	public function inserir($request){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuario = (new Usuario())->setId($request->post->id)
		->setNome($request->post->nome)
		->setLogin($request->post->login)
		->setSenha($request->post->senha);
		$usuarioBO->inserir($usuario);
	}
	public function deletar($id){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuario = (new Usuario())->setAlgumaCoisa();
		$usuarioBO->deletar($usuario);
	}
	public function atualizar($id, $request){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuario = (new Usuario())->setId($request->post->id);
		$obj = $usuarioBO->procurarPorId($usuario);
		$obj = (new Usuario())->setId($request->post->id)
		->setNome($request->post->nome)
		->setLogin($request->post->login)
		->setSenha($request->post->senha);
		$usuarioBO->atualizar($usuario);
	}
	public function procurarPorId($id){
		$usuarioDAO = new UsuarioDAO();
		$usuarioBO = new UsuarioBO($usuarioDAO);
		$usuario = (new Usuario())->setId($request->post->id);
		$obj = $usuarioBO->procurarPorId($usuario);
	}
}
?>