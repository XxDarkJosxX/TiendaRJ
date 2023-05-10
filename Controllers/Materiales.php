<?php 
    class Materiales extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url());
            }
            getpermisos(9);
        }
        public function materiales(){

            $data['page_id'] = 3;
            $data['page_tag'] = "Materiales";
            $data['page_title']= "Administracion de Materiales";
            $data['page_name'] = "MaterialesAdmin";
            $data['page_js'] = "functionmateriales.js";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit."; 
            $this->views->getview($this,"materiales",$data);
        }

        public function getmateriales(){
            $arrdata= $this->model->selectmateriales();
            
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
                    $btnedit='<button class="btn btn-primary btn-sm btneditstyle btneditmateria" rl="'.$arrdata[$i]['IdMaterialPr'].'" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
                }
                if($_SESSION['permisosmod']['d']){
                    $btndelete='<button class="btn btn-danger btn-sm btndelstyle btndelmateria" rl="'.$arrdata[$i]['IdMaterialPr'].'" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
                }
                if($i == (count($arrdata)-1)){
                    $script='<script type="text/javascript"> fnteditmateria();fntdelmateria();</script>';
                }


                $arrdata[$i]['options']= '<div class="text-center"> '.$btnedit.' '.$btndelete.' '.$script.' </div>';


            }
            
            //<span class="badge badge-pill badge-success">Success</span>
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }


        public function setmateriales(){
           //dep($_POST);
           $intidmaterial=intval($_POST['idmaterial']);
           $strmaterial=strclean($_POST['txtnombre']);
           $strdescripcion=strclean($_POST['txtdescripcion']);
           $intstatus=intval($_POST['liststatus']);
           

           if($intidmaterial == 0){
                $requestrol=$this->model->insertmaterials($strmaterial,$strdescripcion,$intstatus);
                $option=1;
           }
           if($intidmaterial != 0){
                $requestrol=$this->model->updatematerials( $intidmaterial,$strmaterial,$strdescripcion,$intstatus);
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
                    $arrresponse= array('status'=>false,'msg'=>'!Atencion! El Material ya existe');
                }else
                $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
           }
           
           
           echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
           die();
           
        }

        public function getmaterial($id){
            //dep($_POST);
            $intidmaterial=intval(strclean($id));

            if ($intidmaterial>0){
                $arrdata = $this->model->selectmaterial($intidmaterial);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }

         public function delmateria(){
            if($_POST){
                $intidmateria=intval($_POST['idmaterial']);
                $requestdelete=$this->model->deletemateria($intidmateria);
                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente'.$requestdelete);
                
                }else{
                    $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos'.$requestdelete);
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }


    }
?>