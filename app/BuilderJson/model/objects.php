<?php

namespace app\BuilderJson\model;

class Objects
{
    private $name;
    private $parameters;

    public function __construct($name, $parameters) {
        $this->name = $name;
        $this->parameters = $parameters;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of parameters
     */ 
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Set the value of parameters
     *
     * @return  self
     */ 
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function createJsonObjects()
    {
        $object = '{'.
            '"name": "'.$this->getName().'",'.
            '"parameters":['. $this->createJsonParams(). ']'.
        '}';
        return $object;
     }

    public function createJsonParams()
    {
        $data = '';
        //var_dump($this->getParameters());
        foreach ($this->getParameters() as $key => $value) {
            if (sizeof($this->getParameters())-1==($key)) {
                $data .= '"'.strval($value).'"';
            }else{
                $data .= '"'.strval($value).'",';
            }
        }
        return $data;
     }
    public function __toString()
    {
        return "Object: ". $this->getName();
    }
}


?>