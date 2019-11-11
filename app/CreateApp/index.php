<?php

  require_once('../../vendor/autoload.php');

  use app\BuilderJson\BuildJson;
  use app\AuxBuilders\File\FileBuilder;
  use app\CreateControllers\ControllerBuilder;
  use app\CreateModel\CreateBo\BuildBo;
  use app\CreateModel\CreateDao\BuildDao;
  use app\CreateModel\CreateDto\BuildDto;
  use app\CreateRoutes\RouteBuilder;

  (new BuildJson('../CreateControllers/test.sql'))->getJson();
  (new ControllerBuilder('results.json'))->createControllerClass();
  (new ControllerBuilder('results.json'))->createControllerClass();
  (new BuildBo('results.json'))->createBoObjects();
  (new BuildDao('results.json'))->createDaoObjects();
  (new BuildDto('results.json'))->createDtoObjects();
  (new RouteBuilder('results.json'))->createRoutesFile();

?>