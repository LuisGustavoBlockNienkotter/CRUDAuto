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




  }

?>