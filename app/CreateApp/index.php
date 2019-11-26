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
  print_r("\n==============================================\n");
  print_r("-> EXTRAINDO INFORMAÇÕES DO SQL...\n");
  (new BuildJson('../CreateControllers/test.sql'))->getJson();
  print_r("-> CRIANDO CLASSES CONTROLLERS...\n");
  (new ControllerBuilder('results.json'))->createControllerClass();
  print_r("-> CRIANDO CLASSES BO's...\n");
  (new BuildBo('results.json'))->createBoObjects();
  print_r("-> CRIANDO CLASSES DAO's...\n");
  (new BuildDao('results.json'))->createDaoObjects();
  print_r("-> CRIANDO CLASSES DTO's...\n");
  (new BuildDto('results.json'))->createDtoObjects();
  print_r("-> CRIANDO ARQUIVO DE ROTAS...\n");
  (new RouteBuilder('results.json'))->createRoutesFile();
  print_r("-> CRIANDO VIEWS...\n");
  (new ViewBuilder('results.json'))->createViews();
  print_r("-> CRIANDO PASTA PÚBLICA...\n");
  (new PublicBuilder())->createPublic();
  print_r("-> ATUALIZANDO AUTOLOAD NA PASTA DO PROJETO...\n");
  exec("cd ../../project/ && composer update");
  exec("cd ../../project/ && composer dump-autoload -o");
  print_r("-> GERANDO PASTA CORE NA RAIZ DO PROJETO...\n");
  exec("cd ../../project/ && git clone https://joaoback47@bitbucket.org/joaoback47/core.git");
  print_r("==============================================");
?>