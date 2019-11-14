<?php

  namespace app\CreateControllers\CreatePublic;

  require_once('../../vendor/autoload.php');

  use app\AuxBuilders\File\FileBuilder;
  use app\AuxBuilders\Script\ScriptClass;
  use app\AuxBuilders\Script\Method;
  use app\AuxBuilders\Script\Parameter;
  use app\AuxBuilders\Script\Property;
  use app\AuxBuilders\Script\Printer;
  use app\AuxBuilders\Strings\StringBuilder;
  use helpers\Helpers;

  class PublicBuilder{

    public function createPublic(){

      $this->createMainIndex();
    }

    public function createHtaccess(){
      $htaccess = new StringBuilder();
      $htaccess->append('<?php');
      $htaccess->append('\n');
      $htaccess->append('require_once "../vendor/autoload.php";');
      $htaccess->append('require_once "../core/bootstrap.php";');
      FileBuilder::buildPHPClassFileOrDir(
        "../../../project/public/.htaccess", 
        $htaccess,
        ''
      );
    }

    public function createMainIndex(){
      $mainIndex = new StringBuilder();
      $mainIndex->append('<?php');
      $mainIndex->append('\n');
      $mainIndex->append('require_once "../vendor/autoload.php";');
      $mainIndex->append('require_once "../core/bootstrap.php";');
      echo 'oi';
      FileBuilder::buildPHPClassFileOrDir(
        "../../../project/public/index", 
        $mainIndex
      );
    }

  }

?>