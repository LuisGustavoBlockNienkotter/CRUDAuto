<?php

    namespace core;

    abstract class AbsController{

        protected $view;
        private $viewPath;
        private $viewLayoutPath;

        public function __construct(){
            $this->view = new \stdClass;
        }

        protected function requestView($viewPath, $viewLayoutPath = null){
            $this->viewPath = $viewPath;
            $this->viewLayoutPath = $viewLayoutPath;
            if($viewLayoutPath){
                $this->layoutContent();
            }else{
                $this->viewContent();
            }

        }

        protected function viewContent(){
            if(file_exists(__DIR__ . "/../app/view/{$this->caminhoDaView}.phtml")){
                require_once(__DIR__ . "/../app/view/{$this->caminhoDaView}.phtml");
            }else{
                echo "Error: View path not found!";
            }
        }

        protected function layoutContent(){
            if(file_exists(__DIR__ . "/../app/view/{$this->caminhoDoLayout}.phtml")){
                require_once(__DIR__ . "/../app/view/{$this->caminhoDoLayout}.phtml");
            }else{
                echo "Error: Layout path not found!";
            }
        }



    }


?>