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
      $this->createHtaccess();
    }

    public function createHtaccess(){
      $htaccess = new StringBuilder();
      $htaccess->append('RewriteEngine ON');
      $htaccess->append("\n");
      $htaccess->append('RewriteCond %{REQUEST_FILENAME} !-f');
      $htaccess->append("\n");
      $htaccess->append('RewriteCond %{REQUEST_FILENAME} !-d');
      $htaccess->append("\n");
      $htaccess->append('RewriteRule ^(.*)$ index.php [NC,L,QSA]');
      
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/public/.htaccess", 
        $htaccess,
        ''
      );
    }

    public function createMainIndex(){
      $mainIndex = new StringBuilder();
      $mainIndex->append('<?php');
      $mainIndex->append("\n");
      $mainIndex->append('require_once "../vendor/autoload.php";');
      $mainIndex->append("\n");
      $mainIndex->append('require_once "../core/bootstrap.php";');
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/public/index", 
        $mainIndex
      );
    }

  }

?>