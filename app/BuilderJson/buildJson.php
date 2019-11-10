<?php

namespace app\BuilderJson;

use app\BuilderJson\model\Objects;

class BuildJson {
    
    private $sql_file;

    public function __construct($sql_file) {
        $this->sql_file = $sql_file;
    }

    public function getScript(){
        $script = file_get_contents($this->sql_file);
        $script = strtolower($script);
        return $script;
     }
    
    public function getObjects(){
        $script = $this->getScript();
        $tables_names = $this->getTablesNames();
        $parameters = $this->getParameters();
        foreach ($parameters as $key => $value) {
            if (sizeof($value->getParameters())==0) {
                unset($parameters[$key]);
            }
        }
        $parameters = array_values($parameters);
        $array_of_objects = array();
        foreach ($tables_names as $key => $value) {
           
            $object = new Objects($value, $parameters[$key]->getParameters());
            array_push($array_of_objects, $object);
        }
        return $array_of_objects;
     }

    public function getTablesNames(){
        $script = $this->getScript();
        $array = array();
        $script = explode('create table ', $script);
        unset($script[0]);
        $script = array_values($script);
        foreach ($script as $key => $value) {
            $table_name = explode(' ', $value);
            array_push($array, $table_name[0]);
        }
        return $array;
     }
    public function getParameters(){
        $script = $this->getScript();
        $array = array();
        $array_objects = array();
        $script = explode(' (', $script);
        unset($script[0]);
        $script = array_values($script);
        foreach ($script as $key => $value) {
            $value = explode(',', $value);
            unset($value[array_key_last($value)]);
            $value = array_values($value);
            $script[$key] = $value;
        }
        foreach ($script as $key => $value) {
            foreach ($value as $key => $parameter) {
                $parameter = trim($parameter);
                $parameter = explode(' ', $parameter);
                array_push($array, $parameter[0]);
            }
            $object = new Objects('', $array);
            $array = array();
            array_push($array_objects, $object);
        }
        return $array_objects;
     }

    public function getNameProject(){
        $script = $this->getScript();
        if (strpos($script, 'create database') !== FALSE) {
            $script = explode('create database', $script);
            $script = trim($script[1]);
            $script = explode(';', $script);
            return $script[0];
        }elseif (strpos($script, 'use') !== FALSE) {
            $script = explode('use', $script);
            $script = trim($script[1]);
            $script = explode(';', $script);
            return $script[0];
        }else {
            return '';
        }
     }

    public function getJson()
    {
        $objs = '';
        foreach ($this->getObjects() as $key => $value) {
            if (sizeof($this->getObjects())-1==($key)) {
                $objs .= $value->createJsonObjects();
            }else{
                $objs .= $value->createJsonObjects().',';
            }
        }
        $data = '{
            "project name": "'.$this->getNameProject().'",'.
            '"objects":['. $objs.
            ']'.
        '}';
        $json_string = json_decode($data);
        $fp = fopen('results.json', 'w');
        fwrite($fp, $data);
        fclose($fp);
     }
    
}



?>