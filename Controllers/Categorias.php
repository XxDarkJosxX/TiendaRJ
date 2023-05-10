<?php 
    class Categorias extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(7);
        }
        public function categorias(){

        
            $data['page_tag'] = "Categorias";
            $data['page_title']= "Administracion de Categorias";
            $data['page_name'] = "categoriasadmin";
            $data['page_js'] = "functionscategorias.js";
            $this->views->getview($this,"categorias",$data);
        }

        public function getcategorias(){
            $arrdata= $this->model->selectcategorias();
            
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
                    $btnedit='<button class="btn btn-primary btn-sm btneditstyle btneditcategoria" rl="'.$arrdata[$i]['IdCategoria'].'" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
                }
                if($_SESSION['permisosmod']['d']){
                    $btndelete='<button class="btn btn-danger btn-sm btndelstyle btndelcategoria" rl="'.$arrdata[$i]['IdCategoria'].'" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
                }
                if($i == (count($arrdata)-1)){
                    $script='<script type="text/javascript"> fnteditcategoria();fntdelcategoria();</script>';
                }


                $arrdata[$i]['options']= '<div class="text-center"> '.$btnedit.' '.$btndelete.' '.$script.' </div>';

            }
            
            //<span class="badge badge-pill badge-success">Success</span>
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setcategoria(){
           //dep($_POST);
           $intidcategoria=intval($_POST['idcategoria']);
           $strnombre=strclean($_POST['txtnombre']);
           $strdescripcion=strclean($_POST['txtdescripcion']);
           $intstatus=intval($_POST['liststatus']);
           

           if($intidcategoria == 0){
                $requestrol=$this->model->insertcategoria($strnombre,$strdescripcion,$intstatus);
                $option=1;
           }
           if($intidcategoria != 0){
                $requestrol=$this->model->updatecategoria( $intidcategoria,$strnombre,$strdescripcion,$intstatus);
                $option=2;
           }

           if($requestrol > 0){

                if($option == 1 ){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                }
                if($option == 2 ){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                }
                
           }else{
                if($requestrol == -1){
                    $arrresponse= array('status'=>false,'msg'=>'!Atencion! La categoria ya existe');
                }else
                $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
           }
           
           
           echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
           die();
           
        }

        public function getcategoria($idcategoria){
            //dep($_POST);
            $intidcategoria=intval(strclean($idcategoria));

            if ($intidcategoria>0){
                $arrdata = $this->model->selectcategoria($intidcategoria);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }

         public function delcategoria(){
            if($_POST){
                $intidcategoria=intval($_POST['idcategoria']);
                $requestdelete=$this->model->deletecategoria($intidcategoria);
                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente');
                
                }else{
                    if($requestdelete == 'existe'){
                        $arrresponse= array('status'=>false,'msg'=>'No es Posible Eliminar un categoria asociado a un producto');
                    }else
                        $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos');
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }


    }
?>