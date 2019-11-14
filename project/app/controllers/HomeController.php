<?php

namespace app\controllers;
use core\AbsController;

class HomeController extends AbsController{
	
	public function findAll(){
		$this->requisitarView('index');
	}
}
?>