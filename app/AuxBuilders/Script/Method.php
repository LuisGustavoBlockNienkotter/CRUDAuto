<?php

  namespace app\AuxBuilders\Script;

  class Method{

    private $name;
    private $parameters = [];
    private $body;
    private $static;
    private $visibility;

    public function setParameters($parameters){
      $this->parameters = $parameters;
      return $this;
    }

    public function getParameters(){
      return $this->parameters;
    }

    public function addParameter($parameter){
      $this->parameters[] = $parameter;
      return $this;
    }

    public function getBody(){
        return $this->body;
    }

    public function setBody($body){
        $this->body = $body;
        return $this;
    }
    public function getStatic(){
        return $this->static;
    }

    public function setStatic($static){
        $this->static = $static;
        return $this;
    }

    public function getName(){
      return $this->name;
    }
    public function setName($name){
      $this->name = $name;
      return $this;
    }
    public function getVisibility(){
      return $this->visibility;
    }

    public function setVisibility($visibility){
      $this->visibility = $visibility;
      return $this;
    }
  }

?>