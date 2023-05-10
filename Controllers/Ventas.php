<?php 
    class Ventas extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(11);
           
        }
        public function ventas(){

    
            $data['page_tag'] = "Ventas";
            $data['page_title']= "Administracion de Ventas";
            $data['page_name'] = "VentasAdmin";
            $data['page_js'] = "functionsventas.js";
            
            $this->views->getview($this,"ventas",$data);
        }



        public function setventa($idcliente){
            if(!empty($_SESSION['cart_contents'])){

                $cart = $_SESSION['cart_contents'];
           
                $total_items =$_SESSION['cart_contents']["total_items"];
                $cart_total =$_SESSION['cart_contents']["cart_total"];
                $intidcliente= $idcliente;
                $iduser= $_SESSION['iduser'];
                unset($cart['total_items']);
                unset($cart['cart_total']);
          
                $requestinsertventa=$this->model->insertventa($intidcliente,$iduser,$cart_total,$total_items);
           
              

                if(!empty($requestinsertventa)){
                    foreach($cart as $item){
                        $requestdtvventa=$this->model->insertdtvventa($requestinsertventa,$item['id'],$item['qty'],$item['price'],$item['porcentaje']);
                    }
                    $this->destroy();
                    
                }
               
            }
        }

        public function destroy(){
            $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
            unset($_SESSION['cart_contents']);
          
        }


        public function getventas(){
            $arrdata= $this->model->selectpedidosempleados();
            if($arrdata){
                for($i=0;$i< count($arrdata);$i++){
                    $btnview='';
                    $btnedit='';
                    $btndelete='';
                    $script='';

                    if($arrdata[$i]['Empleado'] == null){
                        $arrdata[$i]['Empleado'] = "Sin participación";
                    }
                    if($arrdata[$i]['Estado']==1){
                        $arrdata[$i]['Estado']='<span class="badge badge-pill badge-success">Compra Finalizada</span>';
                    }else{
                        $arrdata[$i]['Estado']='<span class="badge badge-pill badge-danger">Procesando Campra</span>';
                    }
                    if($_SESSION['permisosmod']['r']){
                        $btnview='<button class="btn btn-info btn-sm btnviewsstyle btnviewusuario" onClick="fntviewcliente('.$arrdata[$i]['IdVenta'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
                    }
                    
                    if($_SESSION['permisosmod']['u']){
                        $btnedit=' <button class="btn btn-primary btn-sm btneditstyle btnediventa" rl="'.$arrdata[$i]['IdVenta'].'" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
                    }
                 

                    if($i == (count($arrdata)-1)){
                        $script='<script type="text/javascript"> fnteditventa(); </script>';
                    }

                    
                    $arrdata[$i]['options']= '<div class="text-center"> '.$btnview.' '.$btnedit.' '.$script.' </div>';               


                 
    
                }
            }

            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getdetalleventas($idventa){
            $intidventa = intval($idventa);
            $arrdata= $this->model->selectdetalleventas($intidventa);
            
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getventaestado($idventa){
            $intidventa = intval($idventa);
            $arrdata= $this->model->selectventaestado($intidventa);
            
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setestadoventa(){
          
            $intventaestado=intval($_POST['liststatusventa']);
            $intidventa=intval($_POST['idventa']);
            $arrdata= $this->model->updateventaestado($intidventa,$intventaestado);

            if($arrdata){
                $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
            }
            else{
                $arrresponse= array('status'=>false,'msg'=>'No se almaceno los datos');
            }
            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            
            die();
        }


        public function getselectproductos(){

            $htmloptions="";
            $arrdata = $this->model->selectproductos();
            if(count($arrdata) > 0){
                for($i=0;$i < count($arrdata); $i++){
                    $htmloptions.='<option value="'.$arrdata[$i]['IdProducto'].'">'.$arrdata[$i]['Nombre'].'</option>';
                }
            }
            echo $htmloptions;
            die();

        }
    

        public function getselectclientes(){

            $htmloptions="";
            $arrdata = $this->model->selectclientes();
            if(count($arrdata) > 0){
                for($i=0;$i < count($arrdata); $i++){
                    $htmloptions.='<option value="'.$arrdata[$i]['IdUsuario'].'">'.$arrdata[$i]['Nombre'].'</option>';
                }
            }
            echo $htmloptions;
            die();

        }
        
        public function gettallas($idproducto){
            //dep($_POST);
            $htmloptions="";
            $arrdata= $this->model->selecttallas($idproducto);

            if($arrdata){
                if(count($arrdata) > 0){
                    for($i=0;$i < count($arrdata); $i++){
                        $htmloptions.='<option value="'.$arrdata[$i]['IdTalla'].'">'.$arrdata[$i]['Nombre'].'</option>';
                    }
                }
                echo $htmloptions;
            }else{
                echo "";
            }
            
            die();

         }
    
    }

?>