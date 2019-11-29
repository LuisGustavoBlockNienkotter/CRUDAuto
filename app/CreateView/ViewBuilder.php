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
      @$this->createInsertPages();
      @$this->createObjectsPages();
      $this->createUpdatePages();
    }

    public function createBaseHtmlPage(){
      $indexHtml = '<!DOCTYPE html>
      <html lang="pt-br">
          <head>
              <meta charset="utf-8">
              <script src="../../libs/js/jquery.min.js"></script>
              <script src="../../libs/js/bootstrap.min.js"></script>
              <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
              <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
              <script src=\'https://kit.fontawesome.com/a076d05399.js\'></script>
              <link rel="stylesheet" href="../../libs/mysheets/style.css">
              <link rel="stylesheet" href="../../libs/fonts/material-icon.css">
              <link rel="stylesheet" href="../../libs/stylesheets/bootstrap.min.css">
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
              <link rel="stylesheet" href="custom.css">
          </head>
          <body>
              <?php require_once __DIR__ . "' . DIRECTORY_SEPARATOR . 'header.phtml" ?>
      
              <?php $this->viewContent() ?>

              
          </body>
      </html>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/baseHtml", 
        $indexHtml,
        ".phtml"
      );
    }

    public function createHeaderPage(){

      $html = '<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Auto CRUD</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(Página atual)</span></a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Listagem
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

      
      foreach ($this->json['objects'] as $key => $object) {
        $html .= '<a class="nav-link" href="/' . $object['name'] . '">'. ucfirst($object['name']) . '<span class="sr-only">(Página atual)</span></a>';
      }


      $html .= '        
      </div>
      </li>
        </ul>
      </div>
    </nav>';
      
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
        $tableHeader = '';
        foreach($object['parameters'] as $param){
          $tableHeader .= '<th>';
          $tableHeader .= ucfirst($param);
          $tableHeader .= '</th>';
        }
        $tableContent = '';
        foreach ($object['parameters'] as $content){
          $tableContent .= '<td align="center" style="vertical-align: middle;">';
          $tableContent .= '<?php echo $';
          $tableContent .= $object['name'];
          $tableContent .= '->get';
          $tableContent .= $content;
          $tableContent .= '(); ?> </td>';
        }

        $tableHeader .= '<th> Ações </th>';
        $html = '
                  <?php require_once __DIR__ . "'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'header.phtml" ?>

                    
                    <div style="margin-top: 20px" align="right" class="container">
                    <div  class="row">
                      <div class="col-md-12">
                      <a href="' . $object['name'] .'/cadastrar" class="btn btn-success">
                      <span class="fa fa-plus" aria-hidden="true"></span>
                      Incluir
                      </a>
                      </div>
                    </div>
                      <table style="margin-top: 10px" class="table table-striped tabela-consulta">
                          <thead>
                              <tr align="center">
                                  ' .  $tableHeader . '
                              </tr>
                          </thead>
                          <tbody>
                          
                  <div class="table-responsive">

                              <?php foreach ($this->view->'.$object['name'].' as $'.$object['name'].'): ?>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        Tem certeza que deseja deletar?
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NÃO</button>
                                        <a href="'.$object['name'].'/<?php echo $'.$object['name'].'->get'.ucfirst($object['parameters'][0]).'(); ?>/delete"><button type="button" class="btn btn-danger">SIM</button></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <tr>
                                  ' . $tableContent . '
                                  <td style="width: 100px" align="center" class="actions">
                                  <div class="justify-content-center d-flex flex-row">
                                      <div style="margin-bottom: 5px;">
                                        <a class="mr-3" href="'.$object['name'].'/<?php echo $'.$object['name'].'->get'.ucfirst($object['parameters'][0]).'(); ?>/findById" id="botao-alterar" class=""><i style="color: #c1c1c1" class=\'fas fa-pencil-alt\' style=\'font-size:28px\'></i></a>
                                      </div>
                                      <div>
                                        <a data-toggle="modal" data-target="#exampleModal"  id="botao-excluir" class=""><i style="color: #c1c1c1" class=\'fas fa-trash\' style=\'font-size:28px\'></i></a>
                                      </div>
                                  </div>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
                  </div>';
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
                  <div class="container">
                    <div class="container-form">'.
                      $this->createFormForInsertPages($object).
                    '</div>
                  </div>';
              FileBuilder::buildPHPClassFileOrDir(
                "../../project/app/view/".$object['name']."/insert", 
                $html,
                ".phtml"
              );
      }
    }

    public function createFormForInsertPages($object)
    {
        $html = '<form style="display: flex; flex-direction: column; width: 30%; margin: 0 auto;" method="POST" action="/'.$object['name'].'/insert">';
        $html .= "<h3> Cadastro de " . ucfirst($object['name']). " </h3>";
        foreach ($object['parameters'] as $key => $parameter) {
          $html .= '  <div class="form-group">';
          $html .= '<label>'.ucfirst($parameter).'</label>
                    <input type="text" name="'.$parameter.'" class="form-control" required>';
          $html .= '</div>';
        }
        $html .= '<button type="submit" class="btn btn-success">Salvar</button>'  ;         
        $html .= '</form>';
        return $html;
    }

    public function createUpdatePages()
    {
      foreach ($this->json['objects'] as $key => $object) {
        $html = '
  <div class="container">
    <div class="container-form">'.
      $this->createFormForUpdatePages($object).
    '</div>
  </div>';
  FileBuilder::buildPHPClassFileOrDir(
    "../../project/app/view/".$object['name']."/update", 
    $html,
    ".phtml"
  );
      }
    }
    
    public function createFormForUpdatePages($object)
    {
        $html = '<form style="display: flex; flex-direction: column; width: 30%; margin: 0 auto;" method="POST" action="/'.$object['name'].'/<?php echo $this->view->'.$object['name'].'[0]->get'.ucfirst($object['parameters'][0]).'(); ?>/update">';
        $html .= "<h3> Edição de " . ucfirst($object['name']). " </h3>";
        foreach ($object['parameters'] as $key => $parameter) {
          $html .= '  <div class="form-group">';
          $html .= '<label>'.ucfirst($parameter).'</label>
        <input type="text" name="'.$parameter.'" class="form-control" value="<?php echo $this->view->'.$object['name'].'[0]->get'.ucfirst($parameter).'(); ?>" required>';
        $html .= '  </div>';  
      }

        $html .= '<button type="submit" class="btn btn-success">Salvar</button>'  ;    
          
        $html .= '
</form>';
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
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <link rel="stylesheet" href="../custom.css">
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