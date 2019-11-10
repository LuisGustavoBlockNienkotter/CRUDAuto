<?php

  namespace app\AuxBuilders\Script;
  
  class ScriptClass{
    
    private $name;
    private $methods = [];
    private $properties = [];
    
    public function getName(){
        return $this->name;
    }
 
    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function addMember($member){
      if($member instanceof Method){
        $this->methods[] = $member;
      }else{
        if($member instanceof Property){
          $this->properties[] = $member;
        }
      }
      return $this;
    }
    
    public function getProperties(){
        return $this->properties;
    }

    public function setProperties($properties){
        $this->properties = $properties;
        return $this;
    }

    public function getMethods(){
        return $this->methods;
    }

    public function setMethods($methods){
        $this->methods = $methods;
        return $this;
    }
  }