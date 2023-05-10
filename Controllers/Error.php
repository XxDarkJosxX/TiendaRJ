<?php 
    class Errors extends Controllers{

        public function __construct() {
            parent::__construct();
        }

        public function notfound() {
            $this->views->getView($this,"error");
        }
    }
    $notfound = new Errors();
    $notfound->notfound();
?>