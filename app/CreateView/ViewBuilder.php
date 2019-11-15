<?php
  namespace app\CreateView;

  require_once('../../vendor/autoload.php');

  use app\AuxBuilders\File\FileBuilder;

  class ViewBuilder{

    public function createViews(){
      $this->createHomeIndexPage();
      $this->createProdutoIndexPage();
      $this->createBaseHtmlPage();
      $this->createHeaderPage();
      $this->createFooterPage();
    }

    public function createBaseHtmlPage(){
      $indexHtml = '<!DOCTYPE html>
      <html lang="pt-br">
          <head>
          
              <meta charset="utf-8">
      
          </head>
      
          <body>
              
              <?php require_once __DIR__ . "\\\header.phtml" ?>
      
              <?php $this->viewContent() ?>
      
              <?php require_once __DIR__ . "\\\footer.phtml" ?>
      
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
      $indexHtml = '<body>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="home.php"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Home
            </a>
          </li>	
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cadastros
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/produto/cadastrar">Produtos</a>
            </div>
          </li>			
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Visualizar
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/produtos">Produtos</a>
            </div>
          </li>
        </ul>
      </div>
      </nav>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/header", 
        $indexHtml,
        ".phtml"
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
        <h1> HELLO WORLD ! </h1>
      </body>
      </html>';
      FileBuilder::buildPHPClassFileOrDir(
        "../../project/app/view/index", 
        $indexHtml,
        ".phtml"
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
        ".phtml"
      );
    }

  }

?>