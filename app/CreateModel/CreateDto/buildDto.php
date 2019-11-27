<?php

namespace app\CreateModel\CreateDto;

require_once(__DIR__ . '/../../../vendor/autoload.php');
use app\AuxBuilders\File\FileBuilder;

class BuildDto
{
    
    private $json;

    public function __construct($json) {
        $json_file = file_get_contents($json);
        $json_file = json_decode($json_file, true);
        $this->json = $json_file;
    }

    /**
     * Get the value of json
     */ 
    public function getJson()
    {
        return $this->json;
    }

    /**
     * Set the value of json
     *
     * @return  self
     */ 
    public function setJson($json)
    {
        $this->json = $json;

        return $this;
    }

    private function createStringParams($parameters)
    {
        $params = '';
        foreach ($parameters as $key => $value) {
            $params .= "\t".'private $'. $value. ';'."\n";
        }
        return $params;
    }

    private function createStringConstructor($parameters)
    {
        $cons = "\t".'public function __construct (';
        foreach ($parameters as $key => $value) {
            if (array_key_last($parameters) == $key) {
                $cons .=  '$'. $value;
            } else {
                $cons .=  '$'. $value .', ';
            }
        }
        $cons .= '){'."\n";
        foreach ($parameters as $key => $value) {
            $cons .=  "\t\t".'$this->'. $value . ' = $'. $value . ';'."\n";
        }
        $cons .= "\t".'}';
        return $cons;
    }

    private function createStringGettersSetters($parameters)
    {      
        $getters = '';
        $setters = '';
        foreach ($parameters as $key => $value) {
            $getters .= "\t".'public function get'. ucfirst($value).'(){'."\n".
                        "\t\t".'return $this->'. $value. ';'."\n".
                        "\t".'}'."\n";
        }
        foreach ($parameters as $key => $value) {
            $setters .= "\t".'public function set'. ucfirst($value).'($'.$value.'){'."\n".
                        "\t\t".'$this->'. $value. ' = $'. $value.';'."\n".
                        "\t\t".'return $this;'."\n".
                        "\t".'}'."\n";
        }
        return $getters.$setters;
    }

    private function createStringClass($name, $parameters)
    {      
        $str =  '<?php'.
                "\n" . 
                "namespace app\\model\\dto; " . 
                "\n"
                .'class '. ucfirst($name) . ' { '."\n".
                "\n".
                $this->createStringParams($parameters).
                "\n".
                // $this->createStringConstructor($parameters).
                // "\n".
                $this->createStringGettersSetters($parameters).
                "\n".
                '}'.
                "\n".
                '?>';
        return $str; 
    }

    public function createDtoObjects()
    {
        foreach ($this->json['objects'] as $key => $value) {
            $class = $this->createStringClass($value['name'], $value['parameters']);
            FileBuilder::buildPHPClassFileOrDir(
                "../../project/app/model/dto/" . $value['name'], 
                $class
            );  
        }   
    }
}


?>