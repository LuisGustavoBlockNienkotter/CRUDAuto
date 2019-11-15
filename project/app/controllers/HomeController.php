<?php

namespace app\controllers;
use core\AbsController;

class HomeController extends AbsController{
	
	public function index(){
		$this->requestView('index', 'baseHtml');
	}
}
?>