<?php

namespace app\CreateModel\CreateBo;

require_once(__DIR__ . '/../../../vendor/autoload.php');

use app\AuxBuilders\File\FileBuilder;
use app\AuxBuilders\Script\ScriptClass;
use app\AuxBuilders\Script\Method;
use app\AuxBuilders\Script\Parameter;
use app\AuxBuilders\Script\Property;
use app\AuxBuilders\Script\Printer;
use app\AuxBuilders\Strings\StringBuilder;

use helpers\Helpers;

class BuildBo{

    private $json;
    private $printer;

    public function __construct($json) {
        $json_file = file_get_contents($json);
        $json_file = json_decode($json_file, true);
        $this->json = $json_file;
        $this->printer = new Printer();
    }

    public function createBoObjects(){
        $classes = $this->json['objects'];
        for ($i = 0; $i < count($classes); $i++){
            $boClass = (new ScriptClass())
                        ->setName(Helpers::strToBOName($classes[$i]["name"], true))
                        ->setNamespace('app\model\bo')
                        ->addUse('app\interfaces\IDAO')
                        ->addUse('app\model\dao\\' . Helpers::strToDAOName($classes[$i]["name"], true))
                        ->addUse('app\model\dto\\'. Helpers::strToUCFirst(Helpers::strToLoweredCase($classes[$i]["name"])))

                        ->addMember((new Property())
                            ->setName(Helpers::strToDAOName($classes[$i]["name"]))
                            ->setVisibility('private')
                        )
                        
                        ->addMember((new Method())
                        ->setName('__construct')
                        ->setVisibility('public')
                        ->addParameter((new Parameter())
                            ->setName(Helpers::strToDAOName($classes[$i]["name"])))
                        ->setBody($this->buildConstructMethodBody($classes[$i]["name"])))

                        ->addMember((new Method())
                        ->setName('inserir')
                        ->setVisibility('public')
                        ->addParameter((new Parameter())
                            ->setName(Helpers::strToLoweredCase($classes[$i]["name"])))
                        ->setBody($this->buildInsertMethodBody($classes[$i]["name"])))

                        ->addMember((new Method())
                        ->setName('atualizar')
                        ->setVisibility('public')
                        ->addParameter((new Parameter())
                            ->setName(Helpers::strToLoweredCase($classes[$i]["name"])))
                        ->setBody($this->buildUpdateMethodBody($classes[$i]["name"])))

                        ->addMember((new Method())
                        ->setName('deletar')
                        ->setVisibility('public')
                        ->addParameter((new Parameter())
                            ->setName(Helpers::strToLoweredCase($classes[$i]["name"])))
                        ->setBody($this->buildDeleteMethodBody($classes[$i]["name"])))

                        ->addMember((new Method())
                        ->setName('listar')
                        ->setVisibility('public')
                        ->addParameter((new Parameter())
                            ->setName(Helpers::strToLoweredCase($classes[$i]["name"])))
                        ->setBody($this->buildFindAllMethodBody($classes[$i]["name"])))

                        ->addMember((new Method())
                        ->setName('procurarPorId')
                        ->setVisibility('public')
                        ->addParameter((new Parameter())
                            ->setName(Helpers::strToLoweredCase($classes[$i]["name"])))
                        ->setBody($this->buildFindByIdMethodBody($classes[$i]["name"])));



            print_r($boClass);
            $boScript = $this->printer->printClass($boClass);
            FileBuilder::buildPHPClassFileOrDir(
                "../../project/app/model/bo/" . Helpers::strToBOName($classes[$i]["name"], true), 
                $boScript
            );  
        }
 
    }


    private function buildConstructMethodBody($class){
        $body = new StringBuilder();
        $body->append('$this->');
        $body->append(Helpers::strToDAOName($class));
        $body->append(" = "); 
        $body->append("$");
        $body->append(Helpers::strToDAOName($class));
        $body->append(";");
        return $body;
    }

    private function buildInsertMethodBody($class){
        $body = new StringBuilder();
        $body->append('return $this->');
        $body->append(Helpers::strToDAOName($class));
        $body->append("->inserir("); 
        $body->append("$");
        $body->append(Helpers::strToLoweredCase($class));
        $body->append(");");
        return $body;
    }

    private function buildDeleteMethodBody($class){
        $body = new StringBuilder();
        $body->append('return $this->');
        $body->append(Helpers::strToDAOName($class));
        $body->append("->deletar("); 
        $body->append("$");
        $body->append(Helpers::strToLoweredCase($class));
        $body->append(");");
        return $body;
    }    
    
    private function buildUpdateMethodBody($class){
        $body = new StringBuilder();
        $body->append('return $this->');
        $body->append(Helpers::strToDAOName($class));
        $body->append("->atualizar("); 
        $body->append("$");
        $body->append(Helpers::strToLoweredCase($class));
        $body->append(");");
        return $body;
    }    
    
    private function buildFindByIdMethodBody($class){
        $body = new StringBuilder();
        $body->append('return $this->');
        $body->append(Helpers::strToDAOName($class));
        $body->append("->procurarPorId("); 
        $body->append("$");
        $body->append(Helpers::strToLoweredCase($class));
        $body->append(");");
        return $body;
    }

    private function buildFindAllMethodBody($class){
        $body = new StringBuilder();
        $body->append('return $this->');
        $body->append(Helpers::strToDAOName($class));
        $body->append("->listar("); 
        $body->append("$");
        $body->append(Helpers::strToLoweredCase($class));
        $body->append(");");
        return $body;
    }
}


?>