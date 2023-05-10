<?php 
//Moises
    class UsuariosModel extends Mysql{

        public $intidusuario;
        public $intidrol;
        public $strnombre;
        public $strapellido;
        public $strcorreo;
        public $strcontrasenia;
        public $intstatus;
        public $inttelefono;
        public $intci;
        public $strdireccion;
        public $intnit;
        public $strnombretr;
  

        public function __construct() {

            parent::__construct();
        }
        //YO
        public function selectusuarios(){
            $sql= "SELECT tu.IdUsuario, tu.IdRoles, tu.Nombre, tu.Apellido, tu.Correo, tu.Contrasenia, tu.Estado, tr.Tipo 
            FROM tusuarios tu, troles tr 
            WHERE tu.Estado != 0 AND tu.IdRoles = tr.IdRoles AND tr.Estado != 0 AND tr.IdRoles != 2";
            $request=$this->selectall($sql);
            return $request;
        }

        public function insertusuario(int $idrol,string $ci, string $nombre, string $apellido, string $email, string $direccion, int $telefono,string $nombretr,int $nit, string $password,  int $status){
            $this->intidrol = $idrol;
			$this->strci = $ci;
			$this->strnombre = $nombre;
			$this->strapellido = $apellido;
			$this->strcorreo = $email;
			$this->strdireccion = $direccion;
			$this->inttelefono = $telefono;
			$this->strnombretr = $nombretr;
            $this->intnit = $nit;
            $this->strpassword = $password;
			$this->intstatus = $status;
            
			$return = 0;

			$sql = "SELECT * FROM tusuarios 
                    WHERE Correo = '{$this->strcorreo}' OR ci = '{$this->strci}' OR Nit = '{$this->intnit}' ";
			$request = $this->selectall($sql);

			if(empty($request))
			{
				$query  = "INSERT INTO tusuarios(IdRoles,ci,Nit,Nombre,NombreFiscal,Apellido,Telefono,Correo,Direccion,Contrasenia,Estado) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrdata = array($this->intidrol,
        						$this->strci,
        						$this->intnit,
        						$this->strnombre,
        						$this->strnombretr,
                                $this->strapellido,
        						$this->inttelefono,
        						$this->strcorreo,
        						$this->strdireccion,
                                $this->strpassword,
                                $this->intstatus,
                            );
	        	$request = $this->insert($query,$arrdata);
	        	$return = $request;
			}else{
                $return=-1;
            }
            
            return $return;
        }

        public function updateusuario(int $rol,int $idcliente,string $ci, string $nombre, string $apellido, string $email, string $direccion, int $telefono,string $nombretr,int $nit, string $password,  int $status){
            
             
			$this->intidusuario = $idcliente;
			$this->strci = $ci;
			$this->strnombre = $nombre;
			$this->strapellido = $apellido;
			$this->strcorreo = $email;
			$this->strdireccion = $direccion;
			$this->inttelefono = $telefono;
			$this->strnombretr = $nombretr;
            $this->intnit = $nit;
            $this->strpassword = $password;
			$this->intstatus = $status;

            $this->intidrol=$rol;
            

            $sql= "SELECT * FROM tusuarios WHERE Nombre='{$this->strnombre}' AND Apellido='{$this->strapellido}' AND IdUsuario != $this->intidusuario";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                
                if( $this->strpassword == ''){

                    $queryupdate="UPDATE tusuarios SET IdRoles=?, ci=?,Nit=?,Nombre=?,NombreFiscal=?,Apellido=?,Telefono=?,Correo=?,Direccion=?,Estado=? WHERE IdUsuario=$this->intidusuario";
                    $arrdata = array(
                                $this->intidrol,
        						$this->strci,
        						$this->intnit,
        						$this->strnombre,
        						$this->strnombretr,
                                $this->strapellido,
        						$this->inttelefono,
        						$this->strcorreo,
        						$this->strdireccion,
                           
                                $this->intstatus,
                            );

                    
                }else{
					$queryupdate="UPDATE tusuarios SET IdRoles=?, ci=?,Nit=?,Nombre=?,NombreFiscal=?,Apellido=?,Telefono=?,Correo=?,Direccion=?,Contrasenia=?,Estado=? WHERE IdUsuario=$this->intidusuario";
                    $arrdata = array(
                                $this->intidrol,
        						$this->strci,
        						$this->intnit,
        						$this->strnombre,
        						$this->strnombretr,
                                $this->strapellido,
        						$this->inttelefono,
        						$this->strcorreo,
        						$this->strdireccion,
                                $this->strpassword,
                                $this->intstatus,
                            );
                }
                
                

                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
                
            }else{
                $return=-1;
            }
            
            return $return;

        }


        public function updateperfil(int $iduser,int $ci,string $nombre,string $apellido,int $telefono){
            
            $this->intidusuario=$iduser;
            $this->intci=$ci;
            $this->strnombre=$nombre;
            $this->strapellido=$apellido;
            
            $this->inttelefono= $telefono;
          

            $sql= "SELECT * FROM tusuarios WHERE Nombre='{$this->strnombre}' AND Apellido='{$this->strapellido}' AND IdUsuario != $this->intidusuario";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                
              

                    $queryupdate="UPDATE tusuarios SET ci=?,  Nombre=?,Apellido=? ,Telefono=? WHERE IdUsuario=$this->intidusuario";
                    $arrdata = array($this->intci,$this->strnombre,$this->strapellido,$this->inttelefono);

         

                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
                
            }else{
                $return=-1;
            }
            
            return $return;

        }

        public function updatedatostr(int $iduser, int $nit,string $nombretr,string $direccion){
            
            $this->intidusuario=$iduser;
            $this->intnit=$nit;
            $this->strnombretr=$nombretr;
            $this->strdireccion=$direccion;
      
         
          

            $sql= "SELECT * FROM tusuarios WHERE Nit='{$this->intnit}'AND IdUsuario != $this->intidusuario";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                
                    $queryupdate="UPDATE tusuarios SET Nit=?,  NombreFiscal=?,Direccion=? WHERE IdUsuario=$this->intidusuario";
                    $arrdata = array($this->intnit,$this->strnombretr,$this->strdireccion);

         

                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
                
            }else{
                $return=-1;
            }
            
            return $return;

        }


        public function getuseremail(string $email){
            $this->struser=$email;
         
            $sql= "SELECT IdUsuario, Nombre, Apellido, Estado FROM tusuarios WHERE Correo='$this->struser' AND Estado = 1";
            $request=$this->select($sql);
            return $request;
        }

        public function settokenuser(int $iduser, string $tokrn){
            $this->intiduser = $iduser;
            $this->strtoken= $tokrn;
            $queryupdate="UPDATE tusuarios SET Token = ? WHERE IdUsuario=$this->intiduser";
            $arrdata = array($this->strtoken);
            $requestupdate= $this->update($queryupdate,$arrdata);
            return $requestupdate;
                
        }


        /////////////////////////////////////////
        public function deleteusaurio(int $idusuarios){
            
            $this->intidusuario=$idusuarios;
    
            $querydelete="UPDATE tusuarios SET Estado=? WHERE IdUsuario = $this->intidusuario";
            $arrdata = array(0);
            $requestdelete= $this->update($querydelete,$arrdata);

                //$querydelete="DELETE FROM rol  WHERE idrol = $this->intidrol";
                //$arrdata = array(0);
                //$requestdelete= $this->delete($querydelete,$arrdata);

                if($requestdelete){
                    $requestdelete='ok';
                    $return=$requestdelete;
                }else{
                    $request='error';
                    $return=$request;
                }
                /*
            }else{
                $return='existe';
            }
            */
            return $return;

        }
        //
        public function deleterol(int $idrol){
            
            $this->intidrol=$idrol;
    

            $sql= "SELECT * FROM tusuarios WHERE IdRoles=$this->intidrol";
            $requestdelete = $this->selectall($sql);
            
            if(empty($requestdelete)){
                $querydelete="UPDATE troles SET Estado=? WHERE IdRoles = $this->intidrol";
                $arrdata = array(0);
                $requestdelete= $this->update($querydelete,$arrdata);

                //$querydelete="DELETE FROM rol  WHERE idrol = $this->intidrol";
                //$arrdata = array(0);
                //$requestdelete= $this->delete($querydelete,$arrdata);

                if($requestdelete){
                    $requestdelete='ok';
                    $return=$requestdelete;
                }else{
                    $request='error';
                    $return=$request;
                }
                
            }else{
                $return='existe';
            }
            
            return $return;

        }

        public function selectusuario(int $iduser){
            $this->intiduser= $iduser;
            $sql= "SELECT tu.IdUsuario, 
            tu.IdRoles, 
            tu.ci, 
            tu.Nit, 
            tu.Nombre, 
            tu.NombreFiscal, 
            tu.Apellido, 
            tu.Telefono, 
            tu.Correo, 
            tu.Direccion, 
            tu.Contrasenia, 
            tu.Estado, 
            tr.Tipo
            FROM tusuarios tu, troles tr WHERE tu.IdRoles = tr.IdRoles AND tu.IdUsuario = $this->intiduser";
            $request=$this->select($sql);
            return $request;
        }

        public function selectroles(){
          
            $sql="SELECT * FROM troles WHERE Estado != 0 AND IdRoles != 2";
            $request=$this->selectall($sql);
            return $request;
        }

     

    }

?>