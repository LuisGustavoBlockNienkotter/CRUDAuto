<?php

  namespace app\AuxBuilders\File;

  class FileBuilder{
    
  private static function buildFolder($local){
    if (!file_exists($local)){
      mkdir($local, 0700);
    }
  }
  public static function buildPHPClassFileOrDir($local, $conteudo, $extensao = ".php"){
      $explode = array_filter(explode("/", $local));
      $dir = "";
      $numItems = count($explode);
      foreach($explode as $key => $arquivo){
          if($key == $numItems-1){
              $diretorioArquivo = $dir . $arquivo;
              self::buildPHPClassFile($diretorioArquivo, $conteudo, $extensao);
          }else{
              $dir .= $arquivo . DIRECTORY_SEPARATOR;  
              self::buildFolder($dir);
          }
      }
  }

  public static function buildPHPClassFile($local, $conteudo, $extensao = ".php"){
    file_put_contents($local . $extensao, $conteudo);
  }

  }

?>