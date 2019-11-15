<?php

    namespace core;

    class Redirector{

        public static function toRoute($route){
            header("Location: $route");
        }
        
    }