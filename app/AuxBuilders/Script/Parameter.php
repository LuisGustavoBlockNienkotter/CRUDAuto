<?php

  namespace app\AuxBuilders\Script;
  
  class Parameter{

    private $name;
    
    public function getName(){
      return $this->name;
    }

    public function setName($name){
      $this->name = $name;
      return $this;
    }

  }

?>
