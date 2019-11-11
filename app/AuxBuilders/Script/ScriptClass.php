<?php

  namespace app\AuxBuilders\Script;
  
  class ScriptClass{
    
    private $name;
    private $namespace;
    private $methods = [];
    private $properties = [];
    private $uses = [];
    private $extends;
    
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

    public function getExtends(){
      return $this->extends;
    }

    public function setExtends($extends){
      $this->extends = $extends;
      return $this;
    }

    public function addUse($use){
      $this->uses[] = $use;
      return $this;
    }

    public function getUses(){
      return $this->uses;
    }

    public function setUses($uses){
      $this->uses = $uses;
      return $this;
    }

    public function getNamespace(){
      return $this->namespace;
    }

    public function setNamespace($namespace){
      $this->namespace = $namespace;
      return $this;
    }
  }