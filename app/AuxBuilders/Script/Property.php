<?php

  namespace app\AuxBuilders\Script;
  
  class Property{

    private $name;
    private $visibility;

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