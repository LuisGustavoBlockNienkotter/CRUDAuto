<?php

namespace app\CreateModel\CreateDao;

require_once(__DIR__ . '/../../../vendor/autoload.php');

use app\AuxBuilders\File\FileBuilder;
use app\AuxBuilders\Script\ScriptClass;
use app\AuxBuilders\Script\Method;
use app\AuxBuilders\Script\Parameter;
use app\AuxBuilders\Script\Property;
use app\AuxBuilders\Script\Printer;
use app\AuxBuilders\Strings\StringBuilder;

use helpers\Helpers;
class BuildDao
{
    
    private $json;

    public function __construct($json) {
        $json_file = file_get_contents($json);
        $json_file = json_decode($json_file, true);
        $this->json = $json_file;
    }

    private function createPdo(){
        $pdo = '<?php'."\n".
        "namespace app\conexao;" . "\n" . 
        "use PDO; " . "\n" .
        'class Conexao{'."\n".
            "\t".'private $pdo;'."\n".
            "\t".'public function __construct(){'."\n".
                "\t"."\t".'$this->pdo = new PDO("mysql:host=localhost;dbname='.$this->json['project name'].'", "root","");'."\n".
            "\t".'}'."\n".
            "\t".'public function getPdo(){'."\n".
                "\t"."\t".'$this->pdo = new PDO("mysql:host=localhost;dbname='.$this->json['project name'].'", "root","");'."\n".
                "\t"."\t".'$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);'."\n".
                "\t"."\t".'return $this->pdo;'."\n".
            "\t".'}'."\n".
            "\t".'public function setPdo($pdo){'."\n".
                "\t"."\t".'$this->pdo = $pdo;'."\n".
                "\t". "\t". 'return $this;'."\n".
            "\t".'}'."\n".
        '}'."\n".
        '?>';
        FileBuilder::buildPHPClassFileOrDir(
            "../../project/app/conexao/Conexao", 
            $pdo
        );  
    }

    private function createOrdenedParamsWithoutDots($object){
        $params = '';
        foreach ($object['parameters'] as $key => $value) {
            if (array_key_last($object['parameters']) == $key) {
                $params .= $value;
            } else {
                $params .= $value.', ';
            }
        }
        return $params;
    }
    

    private function createOrdenedParamsWithDots($object)
    {
        $params = '';
        foreach ($object['parameters'] as $key => $value) {
            if (array_key_last($object['parameters']) == $key) {
                $params .= ':'.$value;
            } else {
                $params .= ':'.$value.', ';
            }
        }
        return $params;
    }

    private function createBindParamForObjects($object, $space = false)
    {
        $bind_params = '';
        $params_dots = $this->createOrdenedParamsWithDots($object);
        $params = $this->createOrdenedParamsWithoutDots($object);
        $params_dots = explode(',', $params_dots);
        $params = explode(',', $params);
        foreach ($params_dots as $key => $value) {
            if ($space) {
                $bind_params .= "\t"."\t"."\t".'$stmt->bindParam("'.trim($value).'", $'.trim($params[$key]).', PDO::PARAM_STR);'."\n";
            }else{
                $bind_params .= "\t"."\t".'$stmt->bindParam("'.trim($value).'", $'.trim($params[$key]).', PDO::PARAM_STR);'."\n";
            }
            
        }
        return $bind_params;
    }
    
    private function createFindByIdMethodBody($object){
        $findbyid = new StringBuilder();
        $findbyid->append("public function findById(\$objeto){");
        $findbyid->append("\n");
        $findbyid->append("\$stmt = \$this->getPdo()->prepare(");
        $findbyid->append("\"SELECT * FROM ");
        $findbyid->append($object['name']);
        $findbyid->append(" WHERE ");
        $findbyid->append($object['parameters'][0]);
        $findbyid->append(" = :");
        $findbyid->append($object['parameters'][0]);
        $findbyid->append(";\"");
        $findbyid->append(");");
        $findbyid->append("\n");
        $findbyid->append("\$stmt->bindParam(");
        $findbyid->append("':");
        $findbyid->append($object['parameters'][0]);
        $findbyid->append("'");
        $findbyid->append(", $");
        $findbyid->append($object['parameters'][0]);
        $findbyid->append(");");
        $findbyid->append("\n");
        $findbyid->append("$");
        $findbyid->append($object['parameters'][0]);
        $findbyid->append(" = ");
        $findbyid->append("\$objeto->get");
        $findbyid->append(Helpers::strToUCFirst($object['parameters'][0]));
        $findbyid->append("(); ");
        $findbyid->append("\n");
        $findbyid->append("\$stmt->execute();");
        $findbyid->append("\n");
        $findbyid->append("while (\$obj = \$stmt->fetch(PDO::FETCH_ASSOC)){");
        $findbyid->append("\n");
        $findbyid->append("\$r[] = (new ");
        $findbyid->append(Helpers::strToUCFirst($object['name']));
        $findbyid->append("())->");  
        $findbyid->append("\n"); 
        $params = new StringBuilder(); 

              /* Constrói funções set */
      for ($i = 0; $i < count($object["parameters"]); $i++){
        $params->append('set');
        $params->append(Helpers::strToUCFirst($object["parameters"][$i]));
        $params->append("(");
        $params->append("\$obj['". $object["parameters"][$i]."'])"); 
        if(count($object["parameters"])-1 === $i){
          $params->append(";");
        }else{
          $params->append("\n");
          $params->append("->");
        }
      }

        $findbyid->append($params);    
        $findbyid->append("\n");  
        $findbyid->append("}");  
        $findbyid->append("\n");    
        $findbyid->append("return \$r;");  
        $findbyid->append("\n");
        $findbyid->append("}");
        $findbyid->append("\n");

        return Helpers::indentTest($findbyid, 1);
    }

    private function createSetterValuesForBindParams($object, $space = false)
    {
        $params = '';
        foreach ($object['parameters'] as $key => $value) {
            if ($space) {
                $params .= "\t"."\t"."\t".'$'.$value.' = $object->get'.ucfirst($value).'();'."\n";
            }else{
                $params .= "\t"."\t".'$'.$value.' = $object->get'.ucfirst($value).'();'."\n";
            }
            
        }
        return $params;
    }

    private function createResultsFromQuerys($object)
    {
        $str = '';
        foreach ($object['parameters'] as $key => $value) {
            if (array_key_last($object['parameters']) == $key) {
                $str .= '$result["'.$value.'"]';
            } else {
                $str .= '$result["'.$value.'"],';
            }
        }
        return $str;
    }

    private function createParamsForUpdate($object)
    {
        $params = array();
        $str = '';
        foreach ($object['parameters'] as $key => $value) {
            if (0 == $key) {
                $str = $value.' = :'.$value;
                array_push($params, $str);
                $str = '';
            } else if(array_key_last($object['parameters']) == $key){
                $str .= $value.' = :'.$value;
            }else{
                $str .= $value.' = :'.$value.', ';
            }
        }
        array_push($params, $str);
        return $params;
    }

    private function createBindParamsOnlyForId($object)
    {
        $str = '';
        foreach ($object['parameters'] as $key => $value) {
            if (0 == $key) {
                $str .= "\t"."\t"."\t"."\t".'$stmt->bindParam(":'.trim($value).'", $'.trim($value).', PDO::PARAM_STR);'."\n";
            }
        }
        return $str;
    }

    private function createSetterGetterOnlyForId($object)
    {
        $str = '';
        foreach ($object['parameters'] as $key => $value) {
            if (0 == $key) {
                $str .= "\t"."\t"."\t"."\t".'$'.$value.' = $objeto->get'.ucfirst($value).'();'."\n";
            }
        }
        return $str;
    }

    private function createInsertFunctions($object)
    {
        $function = "\t".'public function insert($object){'."\n".
                    "\t"."\t".'$stmt = $this->getPdo()->prepare("INSERT INTO '.$object['name']."\n".
                    "\t"."\t"."\t"."\t"."\t"."\t"."\t"."\t"."\t"."\t".'('.$this->createOrdenedParamsWithoutDots($object).')'."\n".
                    "\t"."\t"."\t"."\t"."\t"."\t"."\t"."\t"."\t"."\t".'VALUES ('.$this->createOrdenedParamsWithDots($object).')");'."\n".
                    $this->createBindParamForObjects($object)."\n".
                    $this->createSetterValuesForBindParams($object)."\n".
                    "\t"."\t".'$stmt->execute();'."\n".
                    "\t".'}'."\n";
        return $function;
    }

    private function createSetsFromObject($class){
      $params = new StringBuilder();
      for ($i = 0; $i < count($class["parameters"]); $i++){
        $params->append('set');
        $params->append(Helpers::strToUCFirst($class["parameters"][$i]));
        $params->append('($result[\'' . $class["parameters"][$i] . '\'])'); 

        if(count($class["parameters"])-1 === $i){
          $params->append(";");
        }else{
          $params->append("\n");
          $params->append("->");
        }
      }
      return $params;
    }

    private function createGetAllFunctions($object)
    {
        $function = "\t".'public function findAll(){'."\n".
                        "\t"."\t".'try{'."\n".
                            "\t"."\t"."\t".'$query = $this->getPdo()->query("SELECT * FROM '.$object['name'].';");'."\n".
                            "\t"."\t"."\t".'$array = array();'."\n".
                            "\t"."\t"."\t".'while ($result = $query->fetch(PDO::FETCH_ASSOC)) {'."\n".
                                "\t"."\t"."\t"."\t".'$'.$object['name'].' = (new '.ucfirst($object['name']).'())->'.
                                $this->createSetsFromObject($object)."\n".
                                "\t"."\t"."\t"."\t".'array_push($array, $'.$object['name'].');'."\n".
                            "\t"."\t"."\t".'}'."\n".
                            "\t"."\t"."\t".'return $array;'."\n".
                        "\t"."\t".'} catch(PDOException $e) {'."\n".
                            "\t"."\t"."\t".'echo "Error: " . $e->getMessage();'."\n".
                        "\t"."\t".'}'."\n".
                    "\t".'}'."\n";
        return $function;
    }
    
    private function createUpdateFunction($object)
    {
        $function = "\t".'public function update($object){'."\n".
                    "\t"."\t".'try{'."\n".
                    "\t"."\t"."\t".'$stmt = $this->getPdo()->prepare("UPDATE '.$object['name'].' SET '.$this->createParamsForUpdate($object)[1]."\n".
                    "\t"."\t"."\t"."\t"."\t"."\t".' WHERE '.$this->createParamsForUpdate($object)[0].'");'."\n".
                    $this->createBindParamForObjects($object, true)."\n".
                    $this->createSetterValuesForBindParams($object, true)."\n".
                    "\t"."\t"."\t".'$stmt->execute();'."\n".
                    "\t"."\t".'} catch(PDOException $e) {'."\n".
                    "\t"."\t"."\t".'echo "Error: " . $e->getMessage();'."\n".
                    "\t"."\t".'}'."\n".
                    "\t".'}'."\n";
        return $function;
    }

    private function createDeleteFunction($object)
    {
        $function = "\t".'public function delete($objeto){'."\n".
                    "\t"."\t".'try{'."\n".
                    "\t"."\t"."\t".'if ($objeto instanceof '.$object['name'].') {'."\n".
                    "\t"."\t"."\t"."\t".'$stmt = $this->getPdo()->prepare("DELETE FROM '.$object['name'].' WHERE '.$this->createParamsForUpdate($object)[0].'");'."\n".
                    $this->createBindParamsOnlyForId($object)."\n".
                    $this->createSetterGetterOnlyForId($object)."\n".
                    "\t"."\t"."\t"."\t".'$stmt->execute();'."\n".
                    "\t"."\t"."\t".'}'."\n".
                    "\t"."\t".'} catch(PDOException $e) {'."\n".
                    "\t"."\t"."\t".'echo "Error: " . $e->getMessage();'."\n".
                    "\t"."\t".'}'."\n".
                    "\t".'}'."\n";
        return $function;
    }

    private function createInterface()
    {
        $str =  '<?php'."\n".
                'namespace app\interfaces; ' . "\n" .
                'interface IDAO{'."\n".
                "\t".'public function insert($object);'."\n".
                "\t".'public function findAll();'."\n".
                "\t".'public function update($object);'."\n".
                "\t".'public function delete($object);'."\n".
                '}'."\n".
                '?>';
        FileBuilder::buildPHPClassFileOrDir(
            "../../project/app/interfaces/IDAO", 
            $str
        );  
    }

    public function createDaoObjects()
    {
        $str = '';
        $this->createInterface();
        $this->createPdo();


        foreach ($this->json['objects'] as $key => $value) {
            $namespaces = new StringBuilder();
            $namespaces->append("namespace ");
            $namespaces->append("app\model\dao; ");
            $namespaces->append("\n");
    
            $namespaces->append("use ");
            $namespaces->append("app\model\dto\\");        
            $namespaces->append(Helpers::strToUCFirst($value['name']));
            $namespaces->append(";");
            $namespaces->append("\n");

            $namespaces->append("use ");
            $namespaces->append("app\conexao\Conexao");  
            $namespaces->append(";");      
            $namespaces->append("\n");

            $namespaces->append("use ");
            $namespaces->append("app\interfaces\IDAO");  
            $namespaces->append(";");      
            $namespaces->append("\n");

            $namespaces->append("use ");
            $namespaces->append("PDO;");  
            $namespaces->append("\n");
            $namespaces->append("\n");


            $str =  '<?php'."\n". $namespaces .
                    'class '. ucfirst($value['name']). 'DAO extends Conexao implements IDAO{'."\n".
                    $this->createInsertFunctions($value).
                    $this->createGetAllFunctions($value).
                    $this->createUpdateFunction($value).
                    $this->createDeleteFunction($value).
                    $this->createFindByIdMethodBody($value).
                    '}'."\n".
                    '?>';

            FileBuilder::buildPHPClassFileOrDir(
                "../../project/app/model/dao/" . ucfirst($value['name']).'DAO', 
                $str
            ); 

        }
    }
}


?>