<?php

    class Pagos extends Controllers{

        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            if(empty($_SESSION["cart_contents"]["total_items"])){
                header('Location: '.base_url()."/catalogo");
               
            }else{
                if($_SESSION["cart_contents"]["total_items"] <= 0){
                    header('Location: '.base_url()."/catalogo");
                }
            }
          

        }

        public function pagos(){

            
            $data['page_tag'] = "pagos";
            $data['page_title']= "pagos";
            $data['page_name'] = "pagos";
            $data['page_js'] = "functionpagos.js";

            if(!empty($_SESSION['login'])){
      
                $data['logincontentdata'] = "Bienvenido ".$_SESSION['userdata']['Nombre'];
            }else{
                $data['logincontentdata'] = "Iniciar sesion";
            }
            $this->views->getview($this,"pagos",$data);
        }


        public function setventa($monto){
         
            if(!empty($_SESSION['cart_contents'])){

                $cart = $_SESSION['cart_contents'];
           
                $total_items =$_SESSION['cart_contents']["total_items"];
                $cart_total =$_SESSION['cart_contents']["cart_total"];
                $cart_totalUSD = $monto;
                $iduser= $_SESSION['iduser'];
                unset($cart['total_items']);
                unset($cart['cart_total']);
          
                $requestinsertventa=$this->model->insertventa($iduser,$cart_total,$total_items);
           
            

                if(!empty($requestinsertventa)){
                    foreach($cart as $item){
                        $requestselectc=$this->model->selectcantidad($item['idpreciotalla']);
                        $cantidad=intval( $requestselectc['Cantidad']);
                        $cantidaddes= $cantidad - 1;

                        $requestdtvventa=$this->model->insertdtvventa($requestinsertventa,$item['id'],$item['qty'],$item['price'],$item['porcentaje'], $cantidaddes,$item['idpreciotalla']);
                        $_SESSION['idpagoventa']=$requestinsertventa;
                    }
                    $this->destroy();
                    
                }
               
            }
        }


        public function destroy(){
            $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
            unset($_SESSION['cart_contents']);
          
        }

    }
?>