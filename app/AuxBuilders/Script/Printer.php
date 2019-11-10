<?php

  namespace app\AuxBuilders\Script;
  
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

      return "<?php\n"  
      .  "\tclass " 
      .  $class->getName()  
      .  "{\n" 
      .    $members 
      .  "\n\t}\n" 
      .  "?>";
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
  
  }

?>