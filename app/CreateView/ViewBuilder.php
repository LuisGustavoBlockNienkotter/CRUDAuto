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
      $this->createHeaderPage();
      $this->createBaseHtmlPage();
      $this->createInsertPages();
      $this->createObjectsPages();
    }

    public function createBaseHtmlPage(){
      $indexHtml = '<!DOCTYPE html>
      <html lang="pt-br">
          <head>
              <meta charset="utf-8">
          </head>
          <body>
              <?php require_once __DIR__ . "' . DIRECTORY_SEPARATOR . 'header.phtml" ?>
      
              <?php $this->viewContent() ?>

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
                            <ul class="select-header">
                                <li>** TABELAS **</li>';
      foreach ($this->json['objects'] as $key => $object) {
          $html .= '<li><a href="/'.$object['name'].'">'.$object['name'].'</a></li>';
      }
      $html .= '</ul>
              </div>
          </div>
        </header>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/header", 
        $html,
        ".phtml"
      );
    }

    public function createHomeIndexPage(){
      $indexHtml = '<html>
      <head>
      </head>
      <body>
      </body>
      </html>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/index", 
        $indexHtml,
        ".phtml"
      );
    }    
    
    public function createObjectsPages()
    {
      foreach ($this->json['objects'] as $key => $object) {
        $html = '
                <html>'.
                $this->createHeadFromHtml().
                '<body>
                  <?php require_once __DIR__ . "'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'header.phtml" ?>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                      <a href="' . $object['name'] .'/cadastrar" class="btn btn-primary">
                      <span class="fa fa-plus" aria-hidden="true"></span>
                      Incluir
                  </a>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-striped tabela-consulta">
                          <thead>
                              <tr>
                                  <th><?php echo "'.$object['name'].'"; ?></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                <?php foreach ($this->view->'.$object['name'].' as $'.$object['name'].'): ?>
                                <td> <?php echo $'.$object['name'].'->get'.ucfirst($object['parameters'][0]).'(); ?> </td>
                                <td> <?php echo $'.$object['name'].'->get'.ucfirst($object['parameters'][1]).'(); ?> </td>
                                <td class="acoes">
                                    <div>
                                      <a href="" id="botao-alterar" class="btn btn-primary">Alterar</a>
                                    </div>
                                    <div>
                                      <a href="" id="botao-alterar" class="btn btn-danger">Excluir</a>
                                    </div>
                                </td>
                                <?php endforeach; ?>
                              </tr>
                              <tr>
                                  <td colspan="3">Nenhum resultado encontrado</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  </div>
                </body>
              </html>';
              FileBuilder::buildPHPClassFileOrDir(
                "../../project/app/view/".$object['name'].'/index', 
                $html,
                ".phtml"
              );
      }
      
    }

    public function createInsertPages()
    {
      foreach ($this->json['objects'] as $key => $object) {
        $html = '
                <html>'.
                $this->createHeadFromHtml().
                '<body>
                  <div class="container">
                    <div class="container-form">'.
                      $this->createFormForInsertPages($object).
                    '</div>
                  </div>
                  </body>
                </html>';
              FileBuilder::buildPHPClassFileOrDir(
                "../../project/app/view/".$object['name']."/insert", 
                $html,
                ".phtml"
              );
      }
    }

    public function createFormForInsertPages($object)
    {
        $html = '<form method="POST" action="/'.$object['name'].'/insert">';
        foreach ($object['parameters'] as $key => $parameter) {
          $html .= '<label>'.$parameter.'</label>
                    <input type="text" name="'.$parameter.'" class="form-control">';
        }
        $html .= '<input type="submit">'  ;         
        $html .= '</form>';
        return $html;
    }

    public function createUpdatePages()
    {
      foreach ($this->json['objects'] as $key => $object) {
        $html = '<?'.
                $this->createPhpUseControllers($object).
                $this->createPhpGetAll($object).
                '?>
                <html>'.
                $this->createHeadFromHtml().
                '<body>
                  <?php require_once __DIR__ . "\header.html" ?>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <a href="" class="btn btn-primary">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                            Incluir
                        </a>
                      </div>
                    </div>
                    <div class="container-form">'.
                      $this->createFormForInsertPages($object).
                    '</div>
                  </div>
                  </body>
                </html>';
              FileBuilder::buildPHPClassFileOrDir(
                "../../project/app/view/".$object['name']."/inserir//", 
                $html,
                ".phtml"
              );
      }
    }

    public function createFormForUpdatePages($object)
    {
        $html = '<form method="POST" action="/'.$object['name'].'/insert">';
        foreach ($object['parameters'] as $key => $parameter) {
          $html .= '<label>'.$parameter.'</label>
                    <input type="text name="'.$parameter.'" class="form-control" value="">';
        }
        $html .= '</form>';
        return $html;
    }

    public function createHeadFromHtml()
    {
      $html = '<head>
                <meta charset="utf-8">
                <script src="../../libs/js/jquery.min.js"></script>
                <script src="../../libs/js/bootstrap.min.js"></script>
                <link rel="stylesheet" href="../../libs/mysheets/style.css">
                <link rel="stylesheet" href="../../libs/fonts/material-icon.css">
                <link rel="stylesheet" href="../../libs/stylesheets/bootstrap.min.css">
                <link rel="stylesheet" href="custom.css">
              </head>';
      return $html;
    }

    public function createPhpGetAll($object)
    {
      $php = '';
      return $php;
    }

    public function createPhpUseControllers($object)
    {
      $php = 'use ../controllers/'.lcfirst($object->name).'Controller;';
      return $php;
    }

  }

?>