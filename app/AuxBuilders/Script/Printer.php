<?php

  namespace app\AuxBuilders\Script;

  require_once(__DIR__ . '/../../../vendor/autoload.php');

  use app\AuxBuilders\Strings\StringBuilder;
  use helpers\Helpers;
  
  class Printer{

    public function printClass(ScriptClass $class) : string{

      $properties = [];
      foreach ($class->getProperties() as $prop){
        $properties[] = $prop->getVisibility() . 
                      " "  .
                      "$" . $prop->getName() .
                      ";";
      }

      $methods = [];
      foreach ($class->getMethods() as $method){
        $methods[] = $this->printFunction($method);
      }

      $members = implode("\n", $properties) . 
                 "\n" . 
                 implode("\n", $methods);

      $uses = $class->getUses();
      $classScript = new StringBuilder();   
      $classScript->append("<?php");
      $classScript->append("\n");   
      $classScript->append("\n"); 
      $class->getNamespace() ? $classScript->append($this->printNamespace($class->getNamespace())) : $classScript->append("");
      $classScript->append("\n"); 
      $classScript->append($this->printUses($uses));
      $classScript->append("\n");   
      $classScript->append("\n");         
      $classScript->append("class ");
      $classScript->append($class->getName());
      $class->getExtends() ? $classScript->append(" extends " . $class->getExtends()) : $classScript->append("");
      $classScript->append("{");
      $classScript->append("\n");    
      $classScript->append($members);   
      $classScript->append("\n");  
      $classScript->append("}");
      $classScript->append("\n");      
      $classScript->append("?>");    

      return Helpers::indentTest($classScript);
    }

    public function printFunction(Method $method): string{
      return 
        $method->getVisibility()
        . " "
        . 'function '
        . $method->getName()
        . $this->printParameters($method) 
        . "{\n\t" . $method->getBody() . "\n}";
    }
    
    protected function printParameters(Method $function): string{
      $params = [];
      $list = $function->getParameters();
      foreach ($list as $param) {
        $params[] = "$" . $param->getName();
      }
      return "(" . implode(', ', $params) . ")";
    }

    protected function printUses($uses) : string{
      $traits = [];
      foreach ($uses as $use) {
        $traits[] = "use " . $use . ";";
      }
      return implode("\n", $traits);
    }

    protected function printNamespace($namespace) : string{
      return "namespace " . $namespace . ";";
    }

  }

?>