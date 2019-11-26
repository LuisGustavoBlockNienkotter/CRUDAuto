<?php
  namespace app\CreateView;

  require_once('../../vendor/autoload.php');

  use app\AuxBuilders\File\FileBuilder;
  use app\AuxBuilders\Script\ScriptClass;
  use app\AuxBuilders\Script\Method;
  use app\AuxBuilders\Script\Parameter;
  use app\AuxBuilders\Script\Property;
  use app\AuxBuilders\Script\Printer;
  use app\AuxBuilders\Strings\StringBuilder;
  use helpers\Helpers;


  class ViewBuilder{

    private $json;
    private $printer;

    public function __construct($json) {
        $json_file = file_get_contents($json);
        $json_file = json_decode($json_file, true);
        $this->json = $json_file;
        $this->printer = new Printer();
    }

    public function createViews(){
      $this->createHomeIndexPage();
      $this->createBaseHtmlPage();
      @$this->createHeaderPage();
      $this->createFooterPage();
    }

    public function createBaseHtmlPage(){
      $indexHtml = '<!DOCTYPE html>
      <html lang="pt-br">
          <head>
              <meta charset="utf-8">
          </head>
          <body>
              <?php require_once __DIR__ . "' . DIRECTORY_SEPARATOR . 'header.html" ?>
      
              <?php $this->viewContent() ?>
      
              <?php require_once __DIR__ ."' . DIRECTORY_SEPARATOR  .'footer.phtml" ?>
      
              <script src="../../libs/js/jquery.min.js"></script>
              <script src="../../libs/js/bootstrap.min.js"></script>
              <link rel="stylesheet" href="../../libs/mysheets/style.css">
              <link rel="stylesheet" href="../../libs/fonts/material-icon.css">
              <link rel="stylesheet" href="../../libs/stylesheets/bootstrap.min.css">
      
          </body>
      </html>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/baseHtml", 
        $indexHtml,
        ".phtml"
      );
    }

    public function createHeaderPage(){
      $html = '<header class="objects-header">
                    <div class="row">
                        <div class="col-md-2 linha-header text-center">
                            <span class="titulo-painel-adminitrativo"><a href="">Painel Administrativo</a></span>
                        </div>
                        <div class="col-md-4">
                            <select class="select-header">
                                <option>** TABELAS **</option>';
      foreach ($this->json['objects'] as $key => $object) {
          $html .= '<option>'.$object['name'].'</option>';
      }
      $html .= '</select>
              </div>
          </div>
        </header>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/header", 
        $html,
        ".html"
      );
    }
    
    public function createFooterPage(){
      $footerHtml = '<h1>Footer</h1>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/footer", 
        $footerHtml,
        ".phtml"
      );
    }

    public function createHomeIndexPage(){
      $indexHtml = '<html>
      <head>
      </head>
      <body>
        <h1> MATHIAS ! </h1>
      </body>
      </html>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/index", 
        $indexHtml,
        ".phtml"
      );
    }    
    

  }

?>