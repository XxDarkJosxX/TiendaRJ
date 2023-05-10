<?php 
    class Proveedores extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(8);
        }
        public function proveedores(){

            $data['page_id'] = 17;
            $data['page_tag'] = "Proveedores";
            $data['page_title']= "Administracion de Proveedores";
            $data['page_name'] = "proveedoresadmin";
            $data['page_js'] = "functionsproveedores.js";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit."; 
            $this->views->getview($this,"proveedores",$data);
        }

        public function getproveedores(){
            $arrdata= $this->model->selectproveedores();
            
            for($i=0;$i< count($arrdata);$i++){
                $btnedit='';
                $btndelete='';
                $script='';
                if($arrdata[$i]['Estado']==1){
                    $arrdata[$i]['Estado']='<span class="badge badge-pill badge-success">Activo</span>';
                }else{
                    $arrdata[$i]['Estado']='<span class="badge badge-pill badge-danger">Inactivo</span>';
                }

                if($_SESSION['permisosmod']['u']){
                    $btnedit='<button class="btn btn-primary btn-sm btneditstyle btneditproveedor" rl="'.$arrdata[$i]['IdProveedor'].'" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
                }
                if($_SESSION['permisosmod']['d']){
                    $btndelete='<button class="btn btn-danger btn-sm btndelstyle btndelproveedor" rl="'.$arrdata[$i]['IdProveedor'].'" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
                }
                if($i == (count($arrdata)-1)){
                    $script='<script type="text/javascript"> fnteditproveedor();fntdelproveedor();</script>';
                }


                $arrdata[$i]['options']= '<div class="text-center"> '.$btnedit.' '.$btndelete.' '.$script.' </div>';


              

            }
            
            //<span class="badge badge-pill badge-success">Success</span>
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setproveedores(){
           //dep($_POST);
           $intidproveedor=intval($_POST['idproveedor']);
           $strnombre=strclean($_POST['txtnombre']);
           $strciudad=strclean($_POST['txtciudad']);
           $strcorreo=strclean($_POST['txtcorreo']);
           $inttelefono=intval($_POST['txttelefono']);

              
           $strpais=strclean($_POST['txtpais']);
           $strrubro=strclean($_POST['txtrubro']);
           $strdireccion=strclean($_POST['txtdireccion']);
           $strprovincia=strclean($_POST['txtprovincia']);

           $strdescripcion=strclean($_POST['txtdescripcion']);
           $intstatus=intval($_POST['liststatus']);
           
            if($intidproveedor == 0){
            $requestproveedor=$this->model->insertproveedor($strnombre,$strciudad,$strcorreo,$inttelefono,$strpais,$strrubro,$strdireccion,$strprovincia,$strdescripcion,$intstatus);
            $option=1;
            }

            if($intidproveedor != 0){
            $requestproveedor=$this->model->updateproveedor( $intidproveedor,$strnombre,$strciudad,$strcorreo,$inttelefono,$strpais,$strrubro,$strdireccion,$strprovincia,$strdescripcion,$intstatus);
            $option=2;
            }

           if($requestproveedor > 0){

                if($option == 1 ){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                }
                if($option == 2 ){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                }
                
           }else{
                if($requestproveedor == -1){
                    $arrresponse= array('status'=>false,'msg'=>'!Atencion! El proveedor ya existe');
                }else
                $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
           }
           
           
           echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
           die();
           
        }

        public function getproveedor($idproveedor){
            //dep($_POST);
            $intidproveedor=intval(strclean($idproveedor));

            if ($intidproveedor>0){
                $arrdata = $this->model->selectproveedor($intidproveedor);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }


         public function delproveedor(){
            if($_POST){
                
                $intidproveedor=intval($_POST['idproveedor']);
                
                $requestdelete=$this->model->deleteproveedor($intidproveedor);

                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente'.$requestdelete);
                
                }else{
                    if($requestdelete == 'existe'){
                        $arrresponse= array('status'=>false,'msg'=>'No es Posible Eliminar un Proveedor asociado a una Materia Prima'.$requestdelete);
                    }else
                        $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos'.$requestdelete);
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }


    }
?>