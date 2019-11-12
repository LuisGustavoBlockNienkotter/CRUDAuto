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
	public function inserir($rocket){
		return $this->rocketDAO->inserir($rocket);
	}
	public function atualizar($rocket){
		return $this->rocketDAO->atualizar($rocket);
	}
	public function deletar($rocket){
		return $this->rocketDAO->deletar($rocket);
	}
	public function listar($rocket){
		return $this->rocketDAO->listar($rocket);
	}
	public function procurarPorId($rocket){
		return $this->rocketDAO->procurarPorId($rocket);
	}
}
?>