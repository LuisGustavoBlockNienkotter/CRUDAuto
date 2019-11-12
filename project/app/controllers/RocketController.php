<?php

namespace app\controllers;
use core\AbsController;
use app\model\dao\RocketDAO;
use app\model\bo\RocketBO;
use app\model\dto\Rocket;

class RocketController extends AbsController{
	
	public function index(){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$obj = $rocketBO->listar();
		$this->view->rocket = $obj;
		$this->requisitarView('rocket/index');
	}
	public function inserir($request){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$rocket = (new Rocket())->setId($request->post->id)
		->setCodigo($request->post->codigo)
		->setAltura($request->post->altura)
		->setLargura($request->post->largura)
		->setPeso($request->post->peso);
		$rocketBO->inserir($rocket);
		$this->requisitarView('rocket/cadastrar');
	}
	public function deletar($id){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$rocket = (new Rocket())->setId($request->post->id);
		$rocketBO->deletar($rocket);
		$this->requisitarView('rocket/deletar');
	}
	public function atualizar($id, $request){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$rocket = (new Rocket())->setId($request->post->id);
		$obj = $rocketBO->procurarPorId($rocket);
		$obj = (new Rocket())->setId($request->post->id)
		->setCodigo($request->post->codigo)
		->setAltura($request->post->altura)
		->setLargura($request->post->largura)
		->setPeso($request->post->peso);
		$rocketBO->atualizar($rocket);
		$this->requisitarView('rocket/atualizar');
	}
	public function procurarPorId($id){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$rocket = (new Rocket())->setId($request->post->id);
		$obj = $rocketBO->procurarPorId($rocket);
		$this->view->rocket = $obj;
		$this->requisitarView('rocket/visualizar');
	}
}
?>