<?php

  namespace helpers;

  class Helpers{

    public static function strToControllerName($tableName){
      return ucfirst(strtolower($tableName)) . "Controller";
    }

    public static function strToDAOName($tableName, $firstCharacterUpperCase = false){
      return $firstCharacterUpperCase ? ucfirst(strtolower($tableName)) . "DAO" : strtolower($tableName) . "DAO";
    }

    public static function strToBOName($tableName, $firstCharacterUpperCase = false){
      return $firstCharacterUpperCase ? ucfirst(strtolower($tableName)) . "BO" : strtolower($tableName) . "BO";
    }

    public static function strToLoweredCase($tableName){
      return strtolower($tableName);
    }

    public static function strToPlural($tableName){
      return strtolower($tableName) . "s";
    }

    public static function strToUCFirst($tableName){
      return ucfirst(strtolower($tableName));
    }

    public static function indentTest($script, $i = 0){
      $withoutTabs = preg_replace('/\t/', '', $script);
      $array = preg_split("/\r\n|\n|\r/", $withoutTabs);
      return @self::indent($array, $i);
    }

    public static function indent($arr, $indent){
      for ($i = 0; $i < count($arr); $i++){
        $chars = str_split($arr[$i]);
        if($chars[count($chars)-1] == '{'){
          for ($j = 0; $j < $indent; $j++){
            $arr[$i] = "\t" . $arr[$i];
          }
          self::indent($arr[$i+1], $indent++);
        }else{
          if($chars[count($chars)-1] == '}'){
            $indent--;
            for ($j = 0; $j < $indent; $j++){
              $arr[$i] = "\t" . $arr[$i];
            }
            self::indent($arr[$i+1], $indent);
          }else{
            for ($j = 0; $j < $indent; $j++){
              $arr[$i] = "\t" . $arr[$i];
            }
          }
        }
      }
      return implode("\n", $arr);
    }




  }

?>