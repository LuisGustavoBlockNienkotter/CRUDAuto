<?php

  namespace app\CreateControllers\CreateCore;

  require_once('../../vendor/autoload.php');

  use app\AuxBuilders\File\FileBuilder;
  use app\AuxBuilders\Script\ScriptClass;
  use app\AuxBuilders\Script\Method;
  use app\AuxBuilders\Script\Parameter;
  use app\AuxBuilders\Script\Property;
  use app\AuxBuilders\Script\Printer;
  use app\AuxBuilders\Strings\StringBuilder;
  use helpers\Helpers;

  class CoreBuilder{

    public function createCoreClasses(){
      $this->createRouteClass();
    }

    public function createRouteClass(){

      $constructBody = new StringBuilder();
      $constructBody->append('$this->setRoutes($rotas);');
      $constructBody->append("\n");
      $constructBody->append('$this->execController();');

      $getRequisicaoBody = new StringBuilder();
      $getRequisicaoBody->append('$obj = new \\stdClass;');
      $getRequisicaoBody->append("\n");
      $getRequisicaoBody->append('foreach ($_GET as $key => $value){');
      $getRequisicaoBody->append("\n");
      $getRequisicaoBody->append('@$obj->get->$key = $value;');
      $getRequisicaoBody->append("\n");
      $getRequisicaoBody->append('}');
      $getRequisicaoBody->append("\n");
      $getRequisicaoBody->append("\n");
      $getRequisicaoBody->append('foreach ($_POST as $key => $value){');
      $getRequisicaoBody->append("\n");
      $getRequisicaoBody->append('@$obj->post->$key = $value;');
      $getRequisicaoBody->append("\n");
      $getRequisicaoBody->append('}');
      $getRequisicaoBody->append("\n");
      $getRequisicaoBody->append("return \$obj;");
      
      $setRoutesBody = new StringBuilder();
      $setRoutesBody->append("\$r = [];");
      $setRoutesBody->append("\n");
      $setRoutesBody->append('foreach ($routes as $route){');
      $setRoutesBody->append("\n");
      $setRoutesBody->append('$explode = explode(\@, $route[1]);');
      $setRoutesBody->append("\n");
      $setRoutesBody->append('$r = [$route[0], $explode[0], $explode[1]];');
      $setRoutesBody->append("\n");
      $setRoutesBody->append('$newRoutes[] = $r;');
      $setRoutesBody->append("\n");
      $setRoutesBody->append('}');
      $setRoutesBody->append("\n");
      $setRoutesBody->append('$this->routes = $newRoutes;');

      $getUrlBody = new StringBuilder();
      $getUrlBody->append("return parse_url(\$_SERVER['REQUEST_URI'], PHP_URL_PATH);");

      $getContActBody = new StringBuilder();
      $getContActBody->append("\$encontrado = false;");
      $getContActBody->append("\n");
      $getContActBody->append("\$url = \$this->getUrl();");
      $getContActBody->append("\n");
      $getContActBody->append("\$urlArray = explode('/', \$url); ");
      $getContActBody->append("\n");

      $getContActBody->append("foreach($this->rotas as $rota){");
      $getContActBody->append("\n");
      $getContActBody->append("\$arrayRota = explode('/', \$rota[0]);");
      $getContActBody->append("\$param = [];");
      $getContActBody->append("for (\$i = 0; \$i < count(\$arrayRota); \$i++){");
      $getContActBody->append("if((strpos(\$arrayRota[\$i], \"\{\") !== false) && (count(\$urlArray) == count(\$arrayRota))){");
      $getContActBody->append("\$arrayRota[\$i]  = \$urlArray[$\i];");
      $getContActBody->append("\$param[] = \$urlArray[\$i];");
      $getContActBody->append("}");
      $getContActBody->append("\$rota[0] = implode(\$arrayRota, '/');");
      $getContActBody->append("\$param = [];");
      $getContActBody->append("\$param = [];");
      
    
      $class = (new ScriptClass())
                  ->setName('Route')
                  ->addMember((new Property())
                      ->setName('routes')
                      ->setVisibility('private'))
                  ->addMember((new Method())
                      ->setVisibility('public')
                      ->setName('__construct')
                      ->addParameter((new Parameter())
                            ->setName('rotas'))
                      ->setBody($constructBody))
                  ->addMember((new Method())
                      ->setVisibility('public')
                      ->setName('getRequisicao')
                      ->setBody($getRequisicaoBody))
                  ->addMember((new Method())
                      ->setVisibility('public')
                      ->setName('setRoutes')
                      ->addParameter((new Parameter())
                        ->setName('rotas'))
                      ->setBody($setRoutesBody))
                  ->addMember((new Method())
                      ->setVisibility('public')
                      ->setName('getURL')
                      ->setBody($getUrlBody));
                      

      $script = (new Printer())->printClass($class);
      FileBuilder::buildPHPClassFileOrDir(
        "../../../project/core/" . $class->getName(), 
        Helpers::indentTest($script)
      );
    }

  }

?>