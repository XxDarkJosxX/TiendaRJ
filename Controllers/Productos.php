<?php 
    class Productos extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(4);
        }
        public function productos(){

            $data['page_id'] = 4;
            $data['page_tag'] = "Productos";
            $data['page_title']= "Adminitracion de Productos";
            $data['page_name'] = "ProductosAdmin";
            $data['page_js'] = "functionsproductos.js";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit."; 
            $this->views->getview($this,"productos",$data);
        }

        public function getproductos(){
            $arrdata= $this->model->selectproductos();
            for($i=0;$i< count($arrdata);$i++){
                $btnedittalla='';
                $btnedit='';
                $btndelete='';
                $script='';
                if($arrdata[$i]['Estado']==1){
                    $arrdata[$i]['Estado']='<span class="badge badge-pill badge-success">Activo</span>';
                }else{
                    $arrdata[$i]['Estado']='<span class="badge badge-pill badge-danger">Inactivo</span>';
                }

                
                if($_SESSION['permisosmod']['u']){
                    $btnedit='<button class="btn btn-primary btn-sm btneditstyle btneditproducto" rl="'.$arrdata[$i]['IdProducto'].'" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
                    $btnedittalla='<button class="btn btn-info btn-sm  btnedittalla" rl="'.$arrdata[$i]['IdProducto'].'" title="Editar" type="button"><i class="fa-solid fa-shirt"></i></button>';
                }
                if($_SESSION['permisosmod']['d']){
                    $btndelete='<button class="btn btn-danger btn-sm btndelstyle btndelproducto" rl="'.$arrdata[$i]['IdProducto'].'" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
                }
                if($i == (count($arrdata)-1)){
                    $script='<script type="text/javascript"> fnteditproducto(); fntdelproducto(); fntedittalla();</script>';
                }


                $arrdata[$i]['options']= '<div class="text-center"> '.$btnedit.' '.$btnedittalla.' '.$btndelete.' '.$script.' </div>';

          

                $arrdata[$i]['foto']='<div class="text-center"><img src="Assets/Images/productos/'.$arrdata[$i]['foto'].'" height="40"></div>';

            }
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        

        public function setproductos(){
           //dep($_POST);
           
           if($_POST){
                if(empty($_POST['txtcategoria']) ||   empty($_POST['txtnombre']) ||  empty($_POST['txtdescripcion'])){
                    $arrresponse= array('status'=>false,'msg'=>'Datos Incorrectos');
                   
                }else{

                    $intidproducto=intval($_POST['idproducto']);
                    $intidcategoria=intval($_POST['txtcategoria']);
                    $strproducto=strclean($_POST['txtnombre']);
                    $strfoto=$_FILES['txtimagen']['name'];
                    $strdescripcion=strclean($_POST['txtdescripcion']);
                    $intstatus=intval($_POST['liststatus']);

                    
                    $temp=$_FILES['txtimagen']['tmp_name'];


                    if($intidproducto == 0){
                        $requestproducto=$this->model->insertproducto($intidcategoria,$strproducto,$strfoto,$strdescripcion,$intstatus);
                        $option=1;
                   }
                   if($intidproducto != 0){
                        $requestproducto=$this->model->updateproducto($intidproducto,$intidcategoria,$strproducto,$strfoto,$strdescripcion,$intstatus);
                        $option=2;
                   }

                    
                    if(!file_exists('Assets/Images/productos/'.$strfoto)){
                        move_uploaded_file($temp,'Assets/Images/productos/'.$strfoto);
                    }

                    if($requestproducto > 0){

                        if($option == 1 ){
                            $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                        }
                        if($option == 2 ){
                            $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                        }
                        
                   }else{
                        if($requestproducto == -1){
                            $arrresponse= array('status'=>false,'msg'=>'!Atencion! El producto ya existe');
                        }else
                        $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
                   }
    
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
           }
           
           die();
        }


        public function settallasprecio(){
          
            if($_POST){

                $intidproducto=$_POST['idproductotalla'];
                $intidtalla = [];
                $intprecio = [];
                $intcantidad = [];
                $aux=0;
    
                for ($i=1; $i < 7; $i++) { 
                    $nameidtalla= 'txttallavalue'. "$i";
                    $nameprecio= 'txtprecio'. "$i";
                    $namecantidad= 'txtcantidad'. "$i";
                  
                    if($_POST[$nameprecio] != ""){
                        
                        $intidtalla[$aux] = $_POST[$nameidtalla];
                        $intprecio[$aux] = $_POST[$nameprecio];
                        $intcantidad[$aux] = $_POST[$namecantidad];
                        $aux++;
                    }
                   
                }

                if(count($intidtalla) != 0){
                    $requestdelete = $this->model->deletetallasprecio($intidproducto);
                    if($requestdelete){
                        for ($i=0; $i < count($intidtalla); $i++) {
                            $arrdata= $this->model->inserttallaprecio($intidtalla[$i], $intidproducto, $intprecio[$i], $intcantidad[$i] );
                            
                        }
                    }
                }else{
                    $requestdelete = $this->model->deletetallasprecio($intidproducto);
                    $arrdata =$requestdelete;
                }

             
            }

            if($arrdata){
                $arrresponse= array('status'=>true,'msg'=>'Tallas Modificadas correctamente');
            }else{
                $arrresponse= array('status'=>false,'msg'=>'Algo Salio Mal');
            }

            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
        }

        public function getproducto($idproducto){
            //dep($_POST);
            $intidproductos=intval(strclean($idproducto));

            if ($intidproductos>0){
                $arrdata = $this->model->selectproducto($intidproductos);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }

         public function delproducto(){
            if($_POST){
                $intidproducto=intval($_POST['idproducto']);
                $requestdelete=$this->model->deleteproducto($intidproducto);
                if($requestdelete == 'ok'){
                    $arrresponse= array('status'=>true,'msg'=>'Datos Eliminados Correctamente');
                
                }else{
                    if($requestdelete == 'existe'){
                        $arrresponse= array('status'=>false,'msg'=>'No es Posible Eliminar un rol asociado a un usuario');
                    }else
                        $arrresponse= array('status'=>true,'msg'=>'No se elimino los datos');
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }


         public function getselectcategorias(){

            $htmloptions="";
            $arrdata = $this->model->selectcategorias();
            if(count($arrdata) > 0){
                for($i=0;$i < count($arrdata); $i++){
                    $htmloptions.='<option value="'.$arrdata[$i]['IdCategoria'].'">'.$arrdata[$i]['Tipo'].'</option>';
                }
            }
            echo $htmloptions;
            die();

         }


         public function gettallas($idproducto){

            $arrdata= $this->model->selecttallas($idproducto);
        
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();

         }
    }
?>