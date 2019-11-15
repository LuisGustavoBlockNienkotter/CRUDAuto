<?php

    namespace core;

    abstract class AbsController{

        protected $view;
        private $viewPath;
        private $layoutPath;

        public function __construct(){
            $this->view = new \stdClass;
        }

        protected function requestView($viewPath, $layoutPath = null){
            $this->viewPath = $viewPath;
            $this->layoutPath = $layoutPath;
            if($layoutPath){
                $this->layoutContent();
            }else{
                $this->viewContent();
            }

        }

        protected function viewContent(){
            if(file_exists(__DIR__ . "/../app/view/{$this->viewPath}.phtml")){
                require_once(__DIR__ . "/../app/view/{$this->viewPath}.phtml");
            }else{
                echo "Error: View path not found!";
            }
        }

        protected function layoutContent(){
            if(file_exists(__DIR__ . "/../app/view/{$this->layoutPath}.phtml")){
                require_once(__DIR__ . "/../app/view/{$this->layoutPath}.phtml");
            }else{
                echo "Error: Layout path not found!";
            }
        }



    }


?>