<?php
require_once "IDAO.php";
class BoController implements IDAO{
	private $type;
	public function __construct($type){
		$this->type = $type;
	}
	public function post($object){
		return $this->type->post($object);
	}
	public function get($object){
		return $this->type->get($object);
	}
	public function put($object){
		return $this->type->put($object);
	}
	public function delete($object){
		return $this->type->delete($object);
	}
}
?>