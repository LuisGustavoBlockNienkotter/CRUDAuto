<?php

namespace app\controllers;
use core\AbsController;
use app\model\dao\RocketDAO;
use app\model\bo\RocketBO;
use app\model\dto\Rocket;

class RocketController extends AbsController{
	
	public function findAll(){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$obj = $rocketBO->findAll();
		$this->view->rocket = $obj;
		$this->requestView('rocket/index');
	}
	public function insert($request){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$rocket = (new Rocket())->setId($request->post->id)
		->setCodigo($request->post->codigo)
		->setAltura($request->post->altura)
		->setLargura($request->post->largura)
		->setPeso($request->post->peso);
		$rocketBO->insert($rocket);
		$this->requestView('rocket/insert');
	}
	public function delete($id){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$rocket = (new Rocket())->setId($request->post->id);
		$rocketBO->delete($rocket);
		$this->requestView('rocket/delete');
	}
	public function update($id, $request){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$rocket = (new Rocket())->setId($request->post->id);
		$obj = $rocketBO->findById($rocket);
		$obj = (new Rocket())->setId($request->post->id)
		->setCodigo($request->post->codigo)
		->setAltura($request->post->altura)
		->setLargura($request->post->largura)
		->setPeso($request->post->peso);
		$rocketBO->update($rocket);
		$this->requestView('rocket/update');
	}
	public function findById($id){
		$rocketDAO = new RocketDAO();
		$rocketBO = new RocketBO($rocketDAO);
		$rocket = (new Rocket())->setId($request->post->id);
		$obj = $rocketBO->findById($rocket);
		$this->view->rocket = $obj;
		$this->requestView('rocket/findById');
	}
}
?>