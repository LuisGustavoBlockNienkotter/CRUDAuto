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
  use app\CreateControllers\CreateCore\CoreBuilder;

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
                ->setExtends('AbsController')

                ->setNamespace('app\controllers')
                ->addUse('core\AbsController')
                ->addUse('app\model\dao\\' . Helpers::strToDAOName($classes[$i]["name"], true))
                ->addUse('app\model\bo\\'. Helpers::strToBOName($classes[$i]["name"], true))
                ->addUse('app\model\dto\\'. Helpers::strToUCFirst(Helpers::strToLoweredCase($classes[$i]["name"])))

                ->addMember((new Method())
                  ->setName('index')
                  ->setVisibility('public')
                  ->setBody($this->buildIndexMethodBody($classes[$i])))

                ->addMember((new Method())
                  ->setName('inserir')
                  ->setVisibility('public') 
                  ->addParameter((new Parameter())
                    ->setName('request'))
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
                    ->addParameter((new Parameter())
                    ->setName('request'))
                  ->setBody($this->buildUpdateMethodBody($classes[$i])))

                ->addMember((new Method())
                  ->setName('procurarPorId')
                  ->setVisibility('public')
                  ->addParameter((new Parameter())
                    ->setName('id'))
                  ->setBody($this->buildFindByIdMethodBody($classes[$i])));
          
        $classScript = $this->printer->printClass($class);
        FileBuilder::buildPHPClassFileOrDir(
          "../../project/app/controllers/" . Helpers::strToControllerName($classes[$i]["name"]), 
          $classScript
        );
      }
      // (new CoreBuilder())->createCoreClasses();
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
        $params->append("(\$request->post->" . Helpers::strToLoweredCase($class["parameters"][$i]) . ")"); 

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
      $idParams = new StringBuilder();

      /* Constrói funções set */
      for ($i = 0; $i < count($class["parameters"]); $i++){
        $params->append('set');
        $params->append(Helpers::strToUCFirst($class["parameters"][$i]));
        $params->append("(\$request->post->" . Helpers::strToLoweredCase($class["parameters"][$i]) . ")"); 

        if(count($class["parameters"])-1 === $i){
          $params->append(";");
        }else{
          $params->append("\n");
          $params->append("->");
        }
      }

      $idParams->append('set');
      $idParams->append(Helpers::strToUCFirst($class["parameters"][0]));
      $idParams->append("(\$request->post->" . Helpers::strToLoweredCase($class["parameters"][0]) . ")"); 
      $idParams->append(";");
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
      $body->append($idParams);
      $body->append("\n");
      $body->append("\$obj = ");
      $body->append("$");
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append("->procurarPorId($");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(");");
      $body->append("\n");
      $body->append("\$obj");
      $body->append(" = (new ");
      $body->append(Helpers::strToUCFirst($class["name"]));
      $body->append("())->");
      $body->append($params);
      $body->append("\n");
      $body->append("$");
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append("->atualizar($");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(");");

      return $body;
    }

    private function buildFindByIdMethodBody($class){
      $idParams = new StringBuilder();

      $idParams->append('set');
      $idParams->append(Helpers::strToUCFirst($class["parameters"][0]));
      $idParams->append("(\$request->post->" . Helpers::strToLoweredCase($class["parameters"][0]) . ")"); 
      $idParams->append(";");

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
      $body->append($idParams);
      $body->append("\n");
      $body->append("\$obj = ");
      $body->append("$");
      $body->append(Helpers::strToBOName($class["name"]));
      $body->append("->procurarPorId($");
      $body->append(Helpers::strToLoweredCase($class["name"]));
      $body->append(");");
      return $body;
    }

  }

?>