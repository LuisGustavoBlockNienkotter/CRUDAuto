<?php

namespace app\model\bo;
use app\interfaces\IDAO;
use app\model\dao\RocketDAO;
use app\model\dto\Rocket;

class RocketBO{
	private $rocketDAO;
	public function __construct($rocketDAO){
		$this->rocketDAO = $rocketDAO;
	}
	public function insert($rocket){
		return $this->rocketDAO->insert($rocket);
	}
	public function update($rocket){
		return $this->rocketDAO->update($rocket);
	}
	public function delete($rocket){
		return $this->rocketDAO->delete($rocket);
	}
	public function findAll(){
		return $this->rocketDAO->findAll();
	}
	public function findById($rocket){
		return $this->rocketDAO->findById($rocket);
	}
}
?>