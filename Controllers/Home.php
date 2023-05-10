<?php 
    class Home extends Controllers{
        public function __construct() {
            parent::__construct();
        }
        public function home(){

            $data['page_id'] = 1;
            $data['page_tag'] = "Home";
            $data['page_title']= "Pagina Principal";
            $data['page_name'] = "home";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit.";
            session_start();

            if(!empty($_SESSION['login'])){
      
                $data['logincontentdata'] = "Bienvenido ". $_SESSION['userdata']['Nombre'];
            }else{
                $data['logincontentdata'] = "Iniciar sesion";
            }
            $this->views->getview($this,"home",$data);
            
        }


    }
?>