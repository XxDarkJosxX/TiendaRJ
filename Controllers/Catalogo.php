<?php 
    class Catalogo extends Controllers{
        public function __construct() {
            parent::__construct();
        }
        public function catalogo(){

            $data['page_id'] = 2;
            $data['page_tag'] = "Catalogo";
            $data['page_title']= "Pagina Catalogo";
            $data['page_name'] = "Catalogo";
            $data['page_js'] = "functionscatalogos.js";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit.";
            session_start();
            if(!empty($_SESSION['login'])){
      
                $data['logincontentdata'] = "Bienvenido ".$_SESSION['userdata']['Nombre'];
            }else{
                $data['logincontentdata'] = "Iniciar sesion";
            }
            $this->views->getview($this,"catalogo",$data);
        }

        public function getproductos(){
            $arrdata= $this->model->selectproductos();
            
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getcategorias(){
            $arrdata= $this->model->selectcategoias();
            
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

     


        public function getproducto($idproducto){
            //dep($_POST);
            $intidproducto=intval(strclean($idproducto));

            if ($intidproducto>0){
                $arrdata = $this->model->selectproducto($intidproducto);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }

         
        public function gettallas($idproducto){
            //dep($_POST);
            
            $arrdata= $this->model->selecttallas($idproducto);

            if($arrdata){
                echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode("",JSON_UNESCAPED_UNICODE);
            }
            
        
            die();

         }

         public function getpreciotalla($idpreciotallas){
            $idpreciotalla = explode(",", $idpreciotallas);
            $idproducto =$idpreciotalla[0];
            $idtalla = $idpreciotalla[1];

            if ($idproducto > 0 && $idtalla > 0){
                $arrdata = $this->model->selectpreciotalla($idproducto,$idtalla);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                
            }
            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            die();

         }

         
         public function getoferta($idproducto){
  

            if ($idproducto > 0){
                $arrdata = $this->model->selectoferta($idproducto);
                if(empty($arrdata)){
                    echo json_encode("",JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
                }
                
            }

            die();

         }


    }
?>