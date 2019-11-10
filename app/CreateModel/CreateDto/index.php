<?php

  require_once('../../../vendor/autoload.php');

  use app\BuilderJson\BuildJson;
  use app\CreateModel\CreateDto\BuildDto;

  $json = (new BuildJson('../../CreateControllers/test.sql'))->getJson();
  $controllerBuilder = (new BuildDto('results.json'))->createDtoObjects();

?>