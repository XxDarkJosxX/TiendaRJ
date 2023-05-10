<?php 
    class Compras extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(10);
        }
        public function compras(){

            $data['page_tag'] = "Compras";
            $data['page_title']= "Administracion de Compras";
            $data['page_name'] = "Compras";
            $data['page_js'] = "functioncompras.js";
            $this->views->getview($this,"compras",$data);
        }

        public function getcompras()
        {
            $arrdata = $this->model->selectcompras();
            for ($i = 0; $i < count($arrdata); $i++) {
                $btnedit='';
                $btndelete='';
                $script='';
                if ($arrdata[$i]['Estado'] == 1) {
                    $arrdata[$i]['Estado'] = '<span class="badge badge-pill badge-success">Activo</span>';
                } else {
                    $arrdata[$i]['Estado'] = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                }


                if($_SESSION['permisosmod']['u']){
                    $btnedit='<button class="btn btn-primary btn-sm btneditstyle btneditcompra" rl="' . $arrdata[$i]['IdCompra'] . '" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
                }
                if($_SESSION['permisosmod']['d']){
                    $btndelete='<button class="btn btn-danger btn-sm btndelstyle btndelcompra" rl="' . $arrdata[$i]['IdCompra'] . '" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
                }
                if($i == (count($arrdata)-1)){
                    $script='<script type="text/javascript"> fnteditcompra(); </script></div>';
                }


                $arrdata[$i]['options']= '<div class="text-center"> '.$btnedit.' '.$btndelete.' '.$script.' </div>';

            }
            echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
            die();
        }

        
        //Moises
        public function setcompras(){
          // dep('Hello');
           $fechahoy = date('Y-m-d');
           if($_POST){
                if(empty($_POST['idusuario']) ||  empty($_POST['idproveedor']) || empty($_POST['idmateriapr']) ||  empty($_POST['txttotal'])){
                    $arrresponse= array('status'=>false,'msg'=>'Datos Incorrectos');
                   
                }else{  // dep('Hello');

                    $intidcompra=intval($_POST['idcompra']);
                    $intidusuario = $_SESSION['userdata']['IdUsuario'];
                    $intidproveedor=intval($_POST['idproveedor']);
                    $intidmateriapr=intval($_POST['idmateriapr']);
                    
                    $strdescripcion = strclean($_POST['txtdescripcion']);

                    $inttotal= strclean($_POST['txttotal']);
                    $datefecha= $fechahoy;
                    $intstatus=intval($_POST['liststatus']);

                    if($intidcompra == 0){
                        $requestcompra=$this->model->insertcompra($intidusuario,$intidproveedor,$intidmateriapr,$inttotal,$datefecha,$strdescripcion,$intstatus);
                        $option=1;
                   }
                
                   if ($intidcompra != 0) {
                    $requestcompra = $this->model->updatecompra($intidcompra,$intidusuario,$intidproveedor,$intidmateriapr,$inttotal,$strdescripcion,$intstatus);
                    $option = 2;
                    }
                    

                    if($requestcompra > 0){

                        if($option == 1 ){
                            $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                        }
                        if($option == 2 ){
                            $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                        }
                        
                   }else{
                        if($requestcompra == -1){
                            $arrresponse= array('status'=>false,'msg'=>'!Atencion! El usuario ya existe');
                        }else
                        $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
                   }
    
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
           }
           
           die();
        }
        //FIn Moises

        //se deve corregir la seleccion de todos los objetos a solo loa necesarios en este caso el estado 

         public function getcompra($idcompra)
    {
        //dep($_POST);
        $intidcompra = intval(strclean($idcompra));

        if ($intidcompra > 0) {
            $arrdata = $this->model->selectcompra($intidcompra);
            if (empty($arrdata)) {
                $arrresponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrresponse = array('status' => true, 'data' => $arrdata);
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

         public function delrol(){
            if($_POST){
                $intidrol=intval($_POST['idrol']);
                $requestdelete=$this->model->deleterol($intidrol);
                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente'.$requestdelete);
                
                }else{
                    if($requestdelete == 'existe'){
                        $arrresponse= array('status'=>false,'msg'=>'No es Posible Eliminar un rol asociado a un usuario'.$requestdelete);
                    }else
                        $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos'.$requestdelete);
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }


         public function getselectusuarios(){

            $intidusuario = $_SESSION['userdata']['IdUsuario'];
        
            $arrdata = $this->model->selectusuarios($intidusuario);
           
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();

         }

         public function getselectproveedor(){

            $htmloptions="";
            $arrdata = $this->model->selectproveedores();
            if(count($arrdata) > 0){
                for($i=0;$i < count($arrdata); $i++){
                    $htmloptions.='<option value="'.$arrdata[$i]['IdProveedor'].'">'.$arrdata[$i]['Nombre'].'</option>';
                }
            }
            echo $htmloptions; 
            die();

         }  
         public function getselectmateria(){

            $htmloptions="";
            $arrdata = $this->model->selectmaterias();
            if(count($arrdata) > 0){
                for($i=0;$i < count($arrdata); $i++){
                    $htmloptions.='<option value="'.$arrdata[$i]['IdMaterialPr'].'">'.$arrdata[$i]['Nombre'].'</option>';
                }
            }
            echo $htmloptions; 
            die();

         }

            //////////////////////////////////////////////////////////////////////////
            public function delusuario(){
                if($_POST){
                    
                    $intidusuario=intval($_POST['idusuario']);
                    
                    $requestdelete=$this->model->deleteusaurio($intidusuario);
    
                    if($requestdelete == 'ok'){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente'.$requestdelete);
                    
                    }else{
                        if($requestdelete == 'existe'){
                            $arrresponse= array('status'=>false,'msg'=>'No es Posible Eliminar un rol asociado a un usuario'.$requestdelete);
                        }else
                            $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos'.$requestdelete);
                   }
                   echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
                }
                die();
            }
    


         


    }
?>