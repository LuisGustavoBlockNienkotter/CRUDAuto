<?php

  require_once('../../vendor/autoload.php');

  use app\BuilderJson\BuildJson;
  use app\AuxBuilders\File\FileBuilder;
  use app\CreateControllers\ControllerBuilder;
  use app\CreateModel\CreateBo\BuildBo;
  use app\CreateModel\CreateDao\BuildDao;
  use app\CreateModel\CreateDto\BuildDto;
  use app\CreateRoutes\RouteBuilder;
  use app\CreateView\ViewBuilder;
  use app\CreateControllers\CreatePublic\PublicBuilder;


  // ORDEM DAS PASTAS QUE SERÃO CRIADOS
  (new BuildJson('../CreateControllers/test.sql'))->getJson();
  (new ControllerBuilder('results.json'))->createControllerClass();
  (new ControllerBuilder('results.json'))->createControllerClass();
  (new BuildBo('results.json'))->createBoObjects();
  (new BuildDao('results.json'))->createDaoObjects();
  (new BuildDto('results.json'))->createDtoObjects();
  (new RouteBuilder('results.json'))->createRoutesFile();
  (new ViewBuilder())->createViews();
  (new PublicBuilder())->createPublic();
  exec("cd ../../project/ && composer update");
  exec("cd ../../project/ && composer dump-autoload -o");
  exec("cd ../../project/ && git clone https://joaoback47@bitbucket.org/joaoback47/core.git");
<<<<<<< Updated upstream
  
=======

>>>>>>> Stashed changes
?>