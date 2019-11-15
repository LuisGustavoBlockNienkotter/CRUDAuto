<?php

    namespace core;

    class Route{

        private $routes;

        public function __construct(array $routes){
            $this->setRoutes($routes);
            $this->execController();
        }

        public function getRequest(){
            $obj = new \stdClass;

            foreach ($_GET as $key => $value){
                @$obj->get->$key = $value;
            }

            foreach ($_POST as $key => $value){
                @$obj->post->$key = $value;
            }
            
            return $obj;
        }

        private function setRoutes($routes){
            $r= [];
            $newRoutes = [];
            foreach($routes as $route){
                $explode = explode('@', $route[1]);
                $r = [$route[0], $explode[0], $explode[1]];
                $newRoutes[] = $r;
            }   
            $this->routes = $newRoutes;
        }
        
        private function getURL(){
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }

        private function getControllerAndAction(){
            $param = [];
            $founded = false;
            $url = $this->getURL();
            $urlArray = explode('/', $url); 

            foreach($this->routes as $route){
                $arrayRoute = explode('/', $route[0]);
                $param = [];
                for ($i = 0; $i < count($arrayRoute); $i++){
                    // Se o Count de valores passados da URL atual for igual ao da rota no array e se
                    // o valor da rota do array tiver { então é um parâmetro
                    if((strpos($arrayRoute[$i], "{") !== false) && (count($urlArray) == count($arrayRoute))){
                        $arrayRoute[$i]  = $urlArray[$i]; // passa o valor presente na URL para o array da rota
                        $param[]        = $urlArray[$i]; // add o parametro no array param
                    }
                    $route[0] = implode($arrayRoute, '/'); // junta todos os elementos com / denovo
                }
                if($url == $route[0]){ // se a rota atual for igual a gerada então foi encontrado
                    $controller = $route[1];
                    $action     = $route[2];

                    return [$controller, $action, $param];
                }else{
                    
                }
            }
        }
  
        private function execController(){
           
            $configs = $this->getControllerAndAction();
            if($configs){
                $controllerName           = $configs[0];
                $nameMethodController     = $configs[1];
                $parameterArray          = $configs[2];
    
                $controller = ControllerUtil::newController($controllerName);
                
                switch(count($parameterArray)){
                    case 1:
                        $controller->$nameMethodController($parameterArray[0], $this->getRequest());
                        break;
                    case 2:
                        $controller->$nameMethodController($parameterArray[0], $parameterArray[1], $this->getRequest());
                        break;
                    case 3:
                        $controller->$nameMethodController($parameterArray[0], $parameterArray[1], $parameterArray[2], $this->getRequest());
                        break;
                    default:
                        
                        $controller->$nameMethodController($this->getRequest());
                        break;
                }
            }else{
                ControllerUtil::page404();
            }

        
        }
        
    }

?>