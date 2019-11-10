<?php

  namespace app\AuxBuilders\File;

  class FileBuilder{
    
  private static function buildFolder($local){
    mkdir($local);
  }
  public static function buildPHPClassFileOrDir($local, $conteudo){
      $explode = array_filter(explode("/", $local));
      $dir = "";
      $numItems = count($explode);
      foreach($explode as $key => $arquivo){
          if($key == $numItems-1){
              $diretorioArquivo = $dir . $arquivo;
              self::buildPHPClassFile($diretorioArquivo, $conteudo);
          }else{
              $dir .= $arquivo . DIRECTORY_SEPARATOR;  
              self::buildFolder($dir);
          }
      }
  }

  public static function buildPHPClassFile($local, $conteudo){
    file_put_contents($local . ".php", $conteudo);
  }

  }

?>