<?php

    class Controllers{

        public function __construct() {
            $this->views = new Views();
            $this->loadmodel();
        }

        public function loadmodel(){
            
            $model = get_class($this)."Model";
            $routclass = "Models/".$model.".php";
            if(file_exists($routclass)){
                require_once $routclass;
                $this->model = new $model;
            }
        }
    }


?>