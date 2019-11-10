<?php

require_once('../../../vendor/autoload.php');

  use app\BuilderJson\BuildJson;
  use app\CreateModel\CreateDao\BuildDao;

  $json = (new BuildJson('../../CreateControllers/test.sql'))->getJson();
  $controllerBuilder = (new BuildDao('results.json'))->createDaoObjects();

?>