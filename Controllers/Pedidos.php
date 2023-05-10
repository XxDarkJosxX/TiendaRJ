<?php 
    class Pedidos extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }

        }
        public function pedidos(){

            $data['page_id'] = 1;
            $data['page_tag'] = "Pedidos";
            $data['page_title']= "Administracion de Pedidos";
       
            $data['page_name'] = "pedidos";
            $idcliente = $_SESSION['iduser'];
            $arrdata= $this->model->selectroluser($idcliente);
            
            if($arrdata["IdRoles"] != 2){
                $data['page_js'] = "functionspedempleado.js";
                $this->views->getview($this,"pedidosempleados",$data);
            }else{
                $data['page_js'] = "functionspedidos.js";
                $this->views->getview($this,"pedidosclientes",$data);
            }
            
            
        }
       

        public function getpedidosclientes(){
            $idcliente = $_SESSION['iduser'];
            $arrdata= $this->model->selectpedidosclientes($idcliente);
            if($arrdata){
                for($i=0;$i< count($arrdata);$i++){
                   
                    if($arrdata[$i]['Estado']==1){
                        $arrdata[$i]['Estado']='<span class="badge badge-pill badge-success">Compra Finalizada</span>';
                    }else{
                        $arrdata[$i]['Estado']='<span class="badge badge-pill badge-danger">Procesando Compra</span>';
                    }
                    $arrdata[$i]['options'] ='<div class="text-center"> 
                    <button class="btn btn-info btn-sm btnviewsstyle btnviewusuario" onClick="fntviewcliente('.$arrdata[$i]['IdVenta'].')" title="Ver usuario"><i class="far fa-eye"></i></button>
                    <a title="Generar PDF" href="'.base_url().'/factura/generarFactura/'.$arrdata[$i]['IdVenta'].'" target="_blanck" class="btn btn-danger btn-sm"> <i class="fas fa-file-pdf"></i> </a></div>';
    
                }
            }

            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getpedidosempleados(){
         
            $arrdata= $this->model->selectpedidosempleados();
            if($arrdata){
                for($i=0;$i< count($arrdata);$i++){
                    if($arrdata[$i]['Empleado'] == null){
                        $arrdata[$i]['Empleado'] = "Sin participación";
                    }
                    if($arrdata[$i]['Estado']==1){
                        $arrdata[$i]['Estado']='<span class="badge badge-pill badge-success">Envio Confirmado</span>';
                    }else{
                        $arrdata[$i]['Estado']='<span class="badge badge-pill badge-danger">Procesando Envio</span>';
                    }
                    $arrdata[$i]['options'] ='<div class="text-center"> <a title="Generar PDF" href="'.base_url().'/factura/generarFactura/'.$arrdata[$i]['IdVenta'].'" target="_blanck" class="btn btn-danger btn-sm"> <i class="fas fa-file-pdf"></i> </a></div>';
    
                }
            }

            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

    }
?>