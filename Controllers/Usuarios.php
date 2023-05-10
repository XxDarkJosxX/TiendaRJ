<?php 
    class Usuarios extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(2);
        }
        public function usuarios(){

            if(empty($_SESSION['permisosmod']['r'])){
                header('Location: '.base_url()."/dashboard");
            }

            $data['page_tag'] = "Usuarios";
            $data['page_title']= "Administracion de Usuarios";
            $data['page_name'] = "ProductosAdmin";
            $data['page_js'] = "functionsusuarios.js";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit."; 
            $this->views->getview($this,"usuarios",$data);
        }

        public function getusuarios(){
            $arrdata= $this->model->selectusuarios();
            for($i=0;$i< count($arrdata);$i++){
                $btnview='';
                $btnedit='';
                $btndelete='';
                $script='';

                if($arrdata[$i]['Estado']==1){
                    $arrdata[$i]['Estado']='<span class="badge badge-pill badge-success">Activo</span>';
                }else{
                    $arrdata[$i]['Estado']='<span class="badge badge-pill badge-danger">Inactivo</span>';
                }

                if($_SESSION['permisosmod']['r']){
                    $btnview='<button class="btn btn-info btn-sm btnviewsstyle btnviewusuario" onClick="fntviewcliente('.$arrdata[$i]['IdUsuario'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
                
                }

                if($_SESSION['permisosmod']['u'] && $arrdata[$i]['IdUsuario'] != 1 || $_SESSION['iduser'] == 1  || $arrdata[$i]['IdRoles'] == 1){
               
                        $btnedit='<button class="btn btn-primary btn-sm btneditstyle btneditusuario" rl="'.$arrdata[$i]['IdUsuario'].'" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
    
                 }
                if($_SESSION['permisosmod']['d'] && $arrdata[$i]['IdUsuario'] != 1 ){
                    $btndelete='<button class="btn btn-danger btn-sm btndelstyle btndelusuario" rl="'.$arrdata[$i]['IdUsuario'].'" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
                }
                if($i == (count($arrdata)-1)){
                    $script='<script type="text/javascript"> fnteditusuario();fntdelusuario();</script>';
                }
                

                $arrdata[$i]['options']= '<div class="text-center">'.$btnview.' '.$btnedit.' '.$btndelete.' '.$script.' </div>';

            }
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }

        
        //Moises
        public function setusuarios(){
           //dep($_POST);
           
           if($_POST){
				
            if(empty($_POST['txtnombre']) || empty($_POST['txtapellido']) || empty($_POST['txtcorreo']) )
            {
                $arrresponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{ 
                $idUsuario = intval($_POST['idusuario']);
                $strci = strclean($_POST['txtci']);
                $strnombre = ucwords(strclean($_POST['txtnombre']));
                $strapellido = ucwords(strclean($_POST['txtapellido']));
                $strcorreo = strtolower(strclean($_POST['txtcorreo']));
                $strdireccion = strclean($_POST['txtdireccion']);
                $inttelefono = intval(strclean($_POST['txttelefono']));
                $strnombretr = ucwords(strclean($_POST['txtnombretributario']));
                $intnit = intval(strclean($_POST['txtnit']));
                $intstatus = intval(strclean($_POST['liststatus']));

                $intidrol=intval($_POST['txtrol']);

                if($idUsuario == 0)
                {
                    $option = 1;
                    $strpassword =  empty($_POST['txtcontrasenia']) ? passgenerator() : $_POST['txtcontrasenia'];
                    $strpasswordencript=hash("SHA256",$strpassword);
                    $requestusuario = $this->model->insertusuario(
                    $intidrol=$intidrol,
                    $strci,
                    $strnombre, 
                    $strapellido, 
                    $strcorreo, 
                    $strdireccion,
                    $inttelefono, 
                    $strnombretr,
                    $intnit,
                    $strpasswordencript, 
                    $intstatus
                 );
                }else{
                    $option = 2;
                    $strpassword =  empty($_POST['txtcontrasenia']) ? "" : hash("SHA256",$_POST['txtcontrasenia']);
                    $requestusuario = $this->model->updateusuario(
                    $intidrol=$intidrol,
                    $idUsuario,
                    $strci,
                    $strnombre, 
                    $strapellido, 
                    $strcorreo, 
                    $strdireccion,
                    $inttelefono, 
                    $strnombretr,
                    $intnit,
                    $strpassword, 
                    $intstatus

                    );

                }
                if($requestusuario > 0){

                    if($option == 1 ){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Guardados Correctamente');
                        $nombreuser= $strnombre.' '.$strapellido;
                        $stremail= $strcorreo;
                        $datausuario = array(
                            'nombreuser'=>$nombreuser,
                            'email'=>$stremail,
                            'password'=>$strpassword,
                            'asunto'=>'Bienvenido a tu tienda en línea'
                         
                        );
                        sendEmail($datausuario,'emailbienvenida');

                    }
                    if($option == 2 ){
                        $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                    }
                    
               }else{
                    if($requestusuario == -1){
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

        public function getusuario($idusuario){
            //dep($_POST);
            $intiduser=intval(strclean($idusuario));

            if ($intiduser>0){
                $arrdata = $this->model->selectusuario($intiduser);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
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


        public function getselectroles(){

            $htmloptions="";
            $arrdata = $this->model->selectroles();
            if(count($arrdata) > 0){
                for($i=0;$i < count($arrdata); $i++){
                    $htmloptions.='<option value="'.$arrdata[$i]['IdRoles'].'">'.$arrdata[$i]['Tipo'].'</option>';
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
    

        public function perfil(){
            $data['page_tag'] = "Perfil";
            $data['page_title']= "Perfil de Usuario";
            $data['page_name'] = "perfil";
            $data['page_js'] = "functionsusuarios.js";
            $this->views->getview($this,"perfil",$data);
        }
         
        public function setperfil(){
            
            if($_POST){
                if(empty($_POST['txtci']) ||  empty($_POST['txtnombre']) ||  empty($_POST['txtapellido'])  ){
                    $arrresponse= array('status'=>false,'msg'=>'Datos Incorrectos');
                    
                }else{

                    $intidusuario=$_SESSION['iduser'];
                    $strci=strclean($_POST['txtci']);
                    $strnombre=strclean($_POST['txtnombre']);
                    $strapellido=strclean($_POST['txtapellido']);
          
                    $inttelefono=strclean($_POST['txttelefono']);

              
                    $requestusuario=$this->model->updateperfil($intidusuario,$strci,$strnombre,$strapellido,$inttelefono);
                    
                   
                    if($requestusuario > 0){
                            sessionuser($_SESSION['iduser']);
                            $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                    
                        
                   }else{
                        if($requestusuario == -1){
                            $arrresponse= array('status'=>false,'msg'=>'!Atencion! El usuario ya existe');
                        }else
                        $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
                   }
    
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
           }
           
           die();
        }

        public function setdatosficales(){
            if($_POST){
                if(empty($_POST['txtnit']) ||  empty($_POST['txtnombrefiscal'])  ){
                    $arrresponse= array('status'=>false,'msg'=>'Datos Incorrectos');
                    
                }else{

                    $intidusuario=$_SESSION['iduser'];
                    $intnit=strclean($_POST['txtnit']);
                    $strnombretr=strclean($_POST['txtnombrefiscal']);
                    $strdireccion=strclean($_POST['txtdireccion']);
          

              
                    $requestusuario=$this->model->updatedatostr($intidusuario,$intnit,$strnombretr,$strdireccion);
                    
                   
                    if($requestusuario > 0){
                            sessionuser($_SESSION['iduser']);
                            $arrresponse= array('status'=>true,'msg'=>'Datos Actualizados Correctamente');
                    
                        
                   }else{
                        if($requestusuario == -1){
                            $arrresponse= array('status'=>false,'msg'=>'!Atencion! El usuario ya existe');
                        }else
                        $arrresponse= array('status'=>true,'msg'=>'No se almaceno los datos');
                   }
    
               }
               echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
           }
           
           die();  dep($_POST);
            die;
        }


        public function resetpassword($email){
       
          
                    $token= token();
                    $stremail = strtolower(strclean($email));
                    
                    $arrdata = $this->model->getuseremail($stremail);
                    if(empty($arrdata)){
                        $arrresponse= array('status'=>false,'msg'=>'Usuario no encontrado');
                    }else{
                        $idpersona = $arrdata['IdUsuario'];
                        $nombreuser= $arrdata['Nombre'].' '.$arrdata['Apellido'];

                        $urlrecuperar= base_url().'/Login/confirmuser/'.$stremail.'/'.$token;

                        $requestupdate = $this->model->settokenuser($idpersona,$token);

                        $datausuario = array(
                            'nombreuser'=>$nombreuser,
                            'email'=>$stremail,
                            'asunto'=>'Recuperar cuenta - '.NOMBRE_REMITENTE,
                            'urlrecuperacion'=>$urlrecuperar
                        );

                   
                        
                        if($requestupdate){
                            $sendemail= sendEmail($datausuario,'emailcambiopassword');
                            if($sendemail){
                                $arrresponse= array('status'=>true,'msg'=>'Se envio un email a tu correo para cambiar tu contraseña');
                            }
                            else{
                                $arrresponse= array('status'=>false,'msg'=>'No es posible realizar el proceso');
                            }
                        }
                        else{
                            $arrresponse= array('status'=>false,'msg'=>'No es posible realizar el proceso');
                        }
                    }
                //valiovrg
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            
            die();
        }

    }
?>