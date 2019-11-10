<?php

  require_once('../../vendor/autoload.php');

  use app\BuilderJson\BuildJson;
  use app\CreateControllers\ControllerBuilder;

  $json = (new BuildJson('../CreateControllers/test.sql'))->getJson();
  $controllerBuilder = (new ControllerBuilder('results.json'))->createControllerClass();

?>