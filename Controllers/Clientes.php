<?php 
    class Clientes extends Controllers{
        public function __construct() {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url()."/login");
            }
            getpermisos(3);
        }
        public function clientes(){

            if(empty($_SESSION['permisosmod']['r'])){
                header('Location: '.base_url()."/dashboard");
            }

            $data['page_tag'] = "Clientes";
            $data['page_title']= " Administracion de Clientes";
            $data['page_name'] = "clientesadmin";
            $data['page_js'] = "functionsclientes.js";
            $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit."; 
            $this->views->getview($this,"clientes",$data);
        }



		  public function getclientes(){
            $arrdata= $this->model->selectclientes();
     
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
                if($_SESSION['permisosmod']['u']){
                    $btnedit='<button class="btn btn-primary btn-sm btneditstyle btneditusuario" rl="'.$arrdata[$i]['IdUsuario'].'" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
                }
                if($_SESSION['permisosmod']['d']){
                    $btndelete='<button class="btn btn-danger btn-sm btndelstyle btndelusuario" rl="'.$arrdata[$i]['IdUsuario'].'" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
                }
                if($i == (count($arrdata)-1)){
                    $script='<script type="text/javascript">fnteditcliente();fntdelcliente(); </script>';
                }


                $arrdata[$i]['options']= '<div class="text-center"> '. $btnview.' '.$btnedit.' '.$btndelete.' '.$script.' </div>';

            }
            echo json_encode($arrdata,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setclientes(){
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

					if($idUsuario == 0)
					{
						$option = 1;
						$strpassword =  empty($_POST['txtcontrasenia']) ? passgenerator() : $_POST['txtcontrasenia'];
						$strpasswordencript=hash("SHA256",$strpassword);
                        $requestusuario = $this->model->insertcliente(
                        $intidrol=2,
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
						$requestusuario = $this->model->updatecliente(
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

        public function getcliente($idusuario){
            //dep($_POST);
            $intiduser=intval(strclean($idusuario));

            if ($intiduser>0){
                $arrdata = $this->model->selectcliente($intiduser);
                if(empty($arrdata)){
                    $arrresponse= array('status'=>false,'msg'=>'Datos no encontrados');
                }else{
                    $arrresponse= array('status'=>true,'data'=>$arrdata);
                }
                echo json_encode($arrresponse,JSON_UNESCAPED_UNICODE);
            }
            die();
         }


         public function delcliente(){
            if($_POST){
                
                $intidusuario=intval($_POST['idusuario']);
                
                $requestdelete=$this->model->deletecliente($intidusuario);

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