<?php 
    class Detalles extends Controllers{
        public function __construct() {
            parent::__construct();
        }
        public function detalles(){

            $data['page_id'] = 1;
            $data['page_tag'] = "Home";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "home";
            $data['page_js'] = "functionsdetalles.js";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit."; 
            $this->views->getview($this,"detalles",$data);
        }


    }
?>