<?php

  require_once("../../../vendor/autoload.php");

  use app\BuilderJson\BuildJson;
  use app\CreateModel\CreateBo\BuildBo;

  $json = (new BuildJson('../../CreateControllers/test.sql'))->getJson();
  $controllerBuilder = (new BuildBo('results.json'))->createBoObjects();

?>