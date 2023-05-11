<?php 
    class Login extends Controllers{
        public function __construct() {

            session_start();
       
            if(isset($_SESSION['login'])){
                header('Location: '.base_url()."/dashboard");
            }
            parent::__construct();
        }
        public function login(){

     
            $data['page_tag'] = "Login";
            $data['page_title']= "Login";
            $data['page_name'] = "login";
            $data['page_functions_js'] = "functionlogin.js";
            $this->views->getview($this,"login",$data);
        }


        public function loginuser(){
            //dep($_POST);
            if($_POST){
                if(empty($_POST['txtemail']) || empty($_POST['txtpassword']) ){
                    $arrresponse= array('status'=>false,'msg'=>'Error de Datos');
                }else{
                    $struser= strtolower(strclean($_POST['txtemail']));
                    $strpassword= hash("SHA256",$_POST['txtpassword']);



                    $arrayroluser= $this->model->logirol($struser);

                    if($arrayroluser['IdRoles'] != 2){

                        $requestuser= $this->model->loginuser($struser,$strpassword);
                    
                        if(empty($requestuser)){
                            
                            $emaildata = $this->model->getuseremail($struser);
    
                            if(!empty($emaildata)){
                                if(empty($_SESSION['attempts']) || $_SESSION['attempts'] == 0){
                                    $_SESSION['attempts']=1;
                                }else{
                                    $_SESSION['attempts']+=1;
        
                                    
                                }
        
                                if($_SESSION['attempts'] >= 3){
                                    $arrdata= $this->model->deactivateuser($struser);
                                    $arrresponse= array('status'=>false,'msg'=>'Usuario inactivo o suspendido'.$_SESSION['attempts']);
                                }else{
                                    $arrresponse= array('status'=>false,'msg'=>'El usuario o contraseña es incorrectos'.$_SESSION['attempts']);
                                }
                                
                            }else{
                                $arrresponse= array('status'=>false,'msg'=>'El usuario o contraseña es incorrectos'.$_SESSION['attempts']);
                            }
                           
                            
                        }else{
                            $arrdata=$requestuser;
                            if($arrdata['Estado']==1){
    
                                $_SESSION['iduser']=$arrdata['IdUsuario'];
                                $_SESSION['login']=true;
                                $arrdata= $this->model->sessionlogin($_SESSION['iduser']);
    
                                sessionuser($_SESSION['iduser']);
                          
                                $arrresponse= array('status'=>true,'msg'=>'ok');
                                $_SESSION['attempts']=0;
    
                            }else{
                                $arrresponse= array('status'=>false,'msg'=>'Usuario inactivo o suspendido');
                             
                            }
                        }
                    }else{
                        $requestuser= $this->model->logiclient($struser,$strpassword);
                        $_SESSION['attempts']=0;
                        if(empty($requestuser)){
                            $arrresponse= array('status'=>false,'msg'=>'El usuario o contraseña es incorrectos');
                        }else{
                            $arrdata=$requestuser;
                            if($arrdata['Estado']==1){
    
                                $_SESSION['iduser']=$arrdata['IdUsuario'];
                                $_SESSION['login']=true;
                                $arrdata= $this->model->sessionlogin($_SESSION['iduser']);
    
                                sessionuser($_SESSION['iduser']);
                          
                                $arrresponse= array('status'=>true,'msg'=>'ok');
    
                            }else{
                                $arrresponse= array('status'=>false,'msg'=>'Usuario inactivo o suspendido');
                            }
                        }
                    }
                    
                 

                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
    
            die();
        }

        public function resetpassword(){
            if($_POST){
                if(empty($_POST['txtemailreset'])){
                    $arrresponse= array('status'=>false,'msg'=>'Error en los campos');
                }else{
                    $token= token();
                    $stremail = strtolower(strclean($_POST['txtemailreset']));
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
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        public function confirmuser(string $params){
            if(empty($params)){
                header('Location: '.base_url());
            }else{
                $arrdata=explode(',',$params);
                $stremail = strclean($arrdata[0]);
                $strtoken = strclean($arrdata[1]);
                $requestresponse = $this->model->getuser($stremail,$strtoken);
                if(empty($requestresponse)){
                    header('Location: '.base_url());
                }else{
                    $data['page_tag'] = "Cambiar Contraseña";
                    $data['page_title']= "Login";
                    $data['page_name'] = "cambiarcontraseña";
                    $data['page_functions_js'] = "functionlogin.js"; 
                    $data['IdUsuario']=$requestresponse['IdUsuario'];
                    $data['Correo']= $stremail;
                    $data['Token']= $strtoken;
                    $this->views->getview($this,"cambiopassword",$data);
                }

            }
          
        }


        public function setpassword(){
            if(empty($_POST['iduser']) || empty($_POST['txtpasswordcam']) || empty($_POST['txtpasswordconfirm']) || empty($_POST['txtemail'])  || empty($_POST['txttoken'])){
                $arrresponse= array('status'=>false,'msg'=>'No es posible realizar el proceso');
            }else{
                $intiduser= intval( $_POST['iduser']);
                $strpassword=$_POST['txtpasswordcam'];
                $stremail=strclean( $_POST['txtemail']);
                $strtoken=strclean($_POST['txttoken']);
                $strpasswordconfirm=$_POST['txtpasswordconfirm'];

                if($strpassword != $strpasswordconfirm ){
                $arrresponse= array('status'=>false,'msg'=>'Las contraseñas no son iguales');
                }else{
                    $requestresponseuser = $this->model->getuser($stremail,$strtoken);
                    if(empty($requestresponseuser)){
                        $arrresponse= array('status'=>false,'msg'=>'Error de Datos');
                    }else{
                        $strpassword = hash("SHA256",$strpassword);
                        $requestpass=$this->model->insertpassword($intiduser,$strpassword);
                        if($requestpass){
                            $arrresponse= array('status'=>true,'msg'=>'Contraseña Actualizada Correctamente');
                        }
                        else{
                            $arrresponse= array('status'=>false,'msg'=>'No es posible realizar el proceso');
                        }
                    }
                }

            }
            echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            die();
        }

    }
?>