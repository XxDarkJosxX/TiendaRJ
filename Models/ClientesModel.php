<?php 

	class ClientesModel extends Mysql
	{
        private $strci;
        private $strnombre; 
        private $strapellido;
        private $strcorreo;
        private $strdireccion;
        private $inttelefono;
        private $strnombretr;
        private $intnit;
        private $strpassword; 
        private $intstatus;
		private $intidusuario;

        private $intidrol;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertcliente(int $idrol,string $ci, string $nombre, string $apellido, string $email, string $direccion, int $telefono,string $nombretr,int $nit, string $password,  int $status){
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
                    WHERE Correo = '{$this->strcorreo}' or ci = '{$this->strci}' OR Nit = '{$this->intnit}' ";
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

		public function selectclientes(){
            $sql= "SELECT 
			tu.IdUsuario, 
			tu.IdRoles, 
			tu.Nombre, 
			tu.Apellido, 
			tu.Correo, 
			tu.Contrasenia, 
			tu.Estado, 
			tr.Tipo 
            FROM tusuarios tu, troles tr 
            WHERE tu.Estado != 0 AND tu.IdRoles = tr.IdRoles AND tu.IdRoles=2";
            $request=$this->selectall($sql);
            return $request;
        }
		
		public function selectcliente(int $iduser){
            $this->intiduser= $iduser;
            $sql= "SELECT * FROM tusuarios WHERE IdRoles=2 AND IdUsuario = $this->intiduser AND Estado != 0";
            $request=$this->select($sql);
            return $request;
        }

		public function updatecliente(int $idcliente,string $ci, string $nombre, string $apellido, string $email, string $direccion, int $telefono,string $nombretr,int $nit, string $password,  int $status){
            
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
            

            $sql= "SELECT * FROM tusuarios WHERE Nombre='{$this->strnombre}' AND Apellido='{$this->strapellido}' AND IdUsuario != $this->intidusuario";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                
                if( $this->strpassword == ''){

                    $queryupdate="UPDATE tusuarios SET ci=?,Nit=?,Nombre=?,NombreFiscal=?,Apellido=?,Telefono=?,Correo=?,Direccion=?,Estado=? WHERE IdUsuario=$this->intidusuario";
                    $arrdata = array(
			
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
					$queryupdate="UPDATE tusuarios SET ci=?,Nit=?,Nombre=?,NombreFiscal=?,Apellido=?,Telefono=?,Correo=?,Direccion=?,Contrasenia=?,Estado=? WHERE IdUsuario=$this->intidusuario";
                    $arrdata = array(
			
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


	


		public function deletecliente(int $idusuarios){
            
            $this->intidusuario=$idusuarios;
    
            $querydelete="UPDATE tusuarios SET Estado=? WHERE IdUsuario = $this->intidusuario";
            $arrdata = array(0);
            $requestdelete= $this->update($querydelete,$arrdata);

   

                if($requestdelete){
                    $requestdelete='ok';
                    $return=$requestdelete;
                }else{
                    $request='error';
                    $return=$request;
                }
    
            return $return;

        }

	}
 ?>