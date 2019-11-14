<?php
  namespace app\CreateView;

  require_once('../../vendor/autoload.php');

  use app\AuxBuilders\File\FileBuilder;

  class ViewBuilder{

    public function createViews(){
      $this->createHomeIndexPage();
      $this->createProdutoIndexPage();
    }

    public function createHomeIndexPage(){
      $indexHtml = '<html>
      <head>
      </head>
      <body>
        <h1> HELLO WORLD ! </h1>
      </body>
      </html>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/index", 
        $indexHtml,
        "phtml"
      );
    }    
    
    public function createProdutoIndexPage(){
      $indexHtml = '<html>
      <head>
      </head>
      <body>
        <?php foreach ($this->view->produto as $produto): ?>
        <h1> <?php echo $produto->getDescricao(); ?> </h1>
        <?php endforeach; ?>
      </body>
      </html>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/produto/index", 
        $indexHtml,
        "phtml"
      );
    }

  }

?>