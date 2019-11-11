<?php

  namespace app\CreateRoutes;

  require_once('../../vendor/autoload.php');
  use app\AuxBuilders\File\FileBuilder;
  use app\AuxBuilders\Strings\StringBuilder;
  use app\AuxBuilders\Script\Printer;
  use helpers\Helpers;

  class RouteBuilder{

    private $json;
    private $printer;

    public function __construct($json){
      $fileJson = file_get_contents($json);
      $this->json = json_decode($fileJson, true);
      $this->printer = new Printer();
    }
    public function getJson(){
      return $this->json;
    }

    public function setJson($json){
      $this->json = $json;
      return $this;
    }

    public function createRoutesFile(){
      $classes = $this->json['objects'];
      $methods = ["index", "atualizar", "inserir", "deletar", "listar"];
      $routes = new StringBuilder();
      $routes->append("<?php");
      $routes->append("\n");
      $routes->append("\n");
      for($i = 0; $i < count($classes); $i++){
        $class = $classes[$i];
        for($j = 0; $j < count($methods); $j++){
          $routes->append("\$routes[] = [\"/" . Helpers::strToLoweredCase($class["name"]));
          if($methods[$j] != 'index'){
            $routes->append("/");
            $routes->append("{");
            $routes->append(Helpers::strToLoweredCase($class["parameters"][0]));
            $routes->append("}");
            $routes->append("/");
            $routes->append($methods[$j]);
          }
          $routes->append("', ");
          $routes->append(Helpers::strToControllerName($class["name"]));
          $routes->append("@");
          $routes->append($methods[$j]);
          $routes->append("\"];");
          $routes->append("\n");
        }
      }
      $routes->append("\n");
      $routes->append("return \$routes;");
      $routes->append("\n");
      $routes->append("\n");
      $routes->append("?>");
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/routes", 
        $routes
      );
    }

  }

?>