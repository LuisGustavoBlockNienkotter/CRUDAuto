<?php
  namespace app\CreateControllers;

  require_once('../../vendor/autoload.php');

  use app\AuxBuilders\File\FileBuilder;
  use app\AuxBuilders\Script\ScriptClass;
  use app\AuxBuilders\Script\Method;
  use app\AuxBuilders\Script\Parameter;
  use app\AuxBuilders\Script\Property;
  use app\AuxBuilders\Script\Printer;
  use app\AuxBuilders\Strings\StringBuilder;
  use helpers\Helpers;

  class ControllerBuilder{

    private $json;
    private $printer;

    public function __construct($json){
      $fileJson = file_get_contents($json);
      $this->json = json_decode($fileJson, true);
      $this->printer = new Printer();
    }

    public function createControllerClass(){
      $classes = $this->json['objects'];
      for ($i = 0; $i < count($classes); $i++){
        $class = (new ScriptClass())
                ->setName(Helpers::strToControllerName($classes[$i]["name"]))
                
                ->addMember((new Method())
                  ->setName('index')
                  ->setVisibility('public')
                  ->setBody($this->buildIndexMethodBody($classes[$i])))

                ->addMember((new Method())
                  ->setName('inserir')
                  ->setVisibility('public') 
                  ->setBody($this->buildInsertMethodBody($classes[$i])))

                ->addMember((new Method())  
                  ->setName('deletar')
                  ->setVisibility('public')
                    ->addParameter((new Parameter())
                    ->setName('id'))
                  ->setBody($this->buildDeleteMethodBody($classes[$i])))

                ->addMember((new Method())
                  ->setName('atualizar')
                  ->setVisibility('public')
                    ->addParameter((new Parameter())
                    ->setName('id'))
                  ->setBody($this->buildUpdateMethodBody($classes[$i])));
          
        $classScript = $this->printer->printClass($class);
        FileBuilder::buildPHPClassFileOrDir(
          __DIR__ . "/../../project/controllers/" . Helpers::strToControllerName($classes[$i]["name"]), 
          $this->indentTest($classScript)
        );
      }
    }

    private function buildIndexMethodBody($class){
      /* Constrói corpo da função */ 
      $body = new StringBuilder();
      $body->append('$');
      $body->append(Helpers::strToDAOName($class["name"]));
      $body->append(" = new ");
      $body->append(Helpers::strToDAOName($class["name"], true));
      $body->append("();");
      $body->append("\n");
      $body->append('$');
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append(" = new ");
      $body->append(Helpers::strToBOName($class["name"], true));
      $body->append("($" . Helpers::strToDAOName($class["name"]) . ");");
      $body->append("\n");
      $body->append('$');
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append("->listar();");

      return $body;
    }

    private function buildInsertMethodBody($class){
      $str = '';
      $params = new StringBuilder();

      /* Constrói funções set */
      for ($i = 0; $i < count($class["parameters"]); $i++){
        $params->append('set');
        $params->append(Helpers::strToUCFirst($class["parameters"][$i]));
        $params->append("()"); 

        if(count($class["parameters"])-1 === $i){
          $params->append(";");
        }else{
          $params->append("\n");
          $params->append("->");
        }
      }

      /* Constrói corpo da função */ 
      $body = new StringBuilder();
      $body->append('$');
      $body->append(Helpers::strToDAOName($class["name"]));
      $body->append(" = new ");
      $body->append(Helpers::strToDAOName($class["name"], true));
      $body->append("();");
      $body->append("\n");
      $body->append('$');
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append(" = new ");
      $body->append(Helpers::strToBOName($class["name"], true));
      $body->append("($" . Helpers::strToDAOName($class["name"]) . ");");
      $body->append("\n");
      $body->append("$");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(" = (new ");
      $body->append(Helpers::strToUCFirst($class["name"]));
      $body->append("())->");
      $body->append($params);
      $body->append("\n");
      $body->append("$");
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append("->inserir($");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(");");

      return $body;
    }

    private function buildDeleteMethodBody($class){
      /* Constrói corpo da função */ 
      $body = new StringBuilder();
      $body->append('$');
      $body->append(Helpers::strToDAOName($class["name"]));
      $body->append(" = new ");
      $body->append(Helpers::strToDAOName($class["name"], true));
      $body->append("();");
      $body->append("\n");
      $body->append('$');
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append(" = new ");
      $body->append(Helpers::strToBOName($class["name"], true));
      $body->append("($" . Helpers::strToDAOName($class["name"]) . ");");
      $body->append("\n");
      $body->append("$");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(" = (new ");
      $body->append(Helpers::strToUCFirst($class["name"]));
      $body->append("())->"); // primary key
      $body->append("setAlgumaCoisa();");
      $body->append("\n");
      $body->append("$");
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append("->deletar($");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(");");

      return $body;
    }

    private function buildUpdateMethodBody($class){
      $str = '';
      $params = new StringBuilder();

      /* Constrói funções set */
      for ($i = 0; $i < count($class["parameters"]); $i++){
        $params->append('set');
        $params->append(Helpers::strToUCFirst($class["parameters"][$i]));
        $params->append("()"); 

        if(count($class["parameters"])-1 === $i){
          $params->append(";");
        }else{
          $params->append("\n");
          $params->append("->");
        }
      }

      /* Constrói corpo da função */ 
      $body = new StringBuilder();
      $body->append('$');
      $body->append(Helpers::strToDAOName($class["name"]));
      $body->append(" = new ");
      $body->append(Helpers::strToDAOName($class["name"], true));
      $body->append("();");
      $body->append("\n");
      $body->append('$');
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append(" = new ");
      $body->append(Helpers::strToBOName($class["name"], true));
      $body->append("($" . Helpers::strToDAOName($class["name"]) . ");");
      $body->append("\n");
      $body->append("$");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(" = (new ");
      $body->append(Helpers::strToUCFirst($class["name"]));
      $body->append("())->");
      $body->append($params);
      $body->append("\n");
      $body->append("$");
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append("->inserir($");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(");");

      return $body;
    }
    
    public function indentTest($script){
      $withoutTabs = preg_replace('/\t/', '', $script);
      $array = preg_split("/\r\n|\n|\r/", $withoutTabs);
      return $this->indent($array, 0);
    }

    public function indent($arr, $indent){
      for ($i = 0; $i < count($arr); $i++){
        $chars = str_split($arr[$i]);
        if($chars[count($chars)-1] == '{'){
          for ($j = 0; $j < $indent; $j++){
            $arr[$i] = "\t" . $arr[$i];
          }
          $this->indent($arr[$i+1], $indent++);
        }else{
          if($chars[count($chars)-1] == '}'){
            $indent--;
            for ($j = 0; $j < $indent; $j++){
              $arr[$i] = "\t" . $arr[$i];
            }
            $this->indent($arr[$i+1], $indent);
          }else{
            for ($j = 0; $j < $indent; $j++){
              $arr[$i] = "\t" . $arr[$i];
            }
          }
        }
      }
      return implode("\n", $arr);
    }

  }

?>