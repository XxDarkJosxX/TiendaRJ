<?php 

    class LoginModel extends Mysql{

        public $intiduser;
        public $stremail;
        public $struser;
        public $strpassword;
        public $strtoken;

        public $intestado;

        public function __construct() {

            parent::__construct();
        }



        public function logirol(string $user){
            $this->struser=$user;
            $sql= "SELECT IdRoles FROM tusuarios WHERE Nombreusuario='$this->struser' OR Correo='$this->struser'";
            $request=$this->select($sql);
            return $request;
        }

        public function loginuser(string $user, string $password){
            $this->struser=$user;
            $this->strpassword=$password;
            $sql= "SELECT IdUsuario, Estado FROM tusuarios WHERE Nombreusuario='$this->struser' AND Contrasenia= '$this->strpassword' AND Estado != 0";
            $request=$this->select($sql);
            return $request;
        }

        public function logiclient(string $user, string $password){
            $this->struser=$user;
            $this->strpassword=$password;
            $sql= "SELECT IdUsuario, Estado FROM tusuarios WHERE Correo='$this->struser' AND Contrasenia= '$this->strpassword' AND Estado != 0";
            $request=$this->select($sql);
            return $request;
        }



        public function sessionlogin(int $iduser){
            $this->intiduser=$iduser;
         
            $sql= "SELECT tu.IdUsuario, tu.IdRoles, tr.Tipo, tu.Nombre, tu.Apellido, tu.Correo, tu.ci, tu.Nit, tu.NombreFiscal, tu.Telefono, tu.Direccion, tu.Estado
            FROM tusuarios tu
            INNER JOIN troles tr
            ON tu.IdRoles = tr.IdRoles
            WHERE tu.IdUsuario = $this->intiduser";
            $request=$this->select($sql);
            $_SESSION['userdata']= $request;
            return $request;
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

        public function getuser(string $email, string $token){
            $this->struser=$email;
            $this->strtoken= $token;
            $sql= "SELECT IdUsuario FROM tusuarios WHERE Correo='$this->struser' AND Token= '$this->strtoken' AND Estado = 1";
            $request=$this->select($sql);
            return $request;
            

        }


        public function insertpassword(int $iduser, string $password){
            $this->intiduser = $iduser;
            $this->strpassword= $password;
            $queryupdate="UPDATE tusuarios SET Contrasenia=?, Token = ? WHERE IdUsuario=$this->intiduser";
            $arrdata = array($this->strpassword,"");
            $requestupdate= $this->update($queryupdate,$arrdata);
            return $requestupdate;

        }

        public function deactivateuser(string $email){
            $this->stremail = $email;
            $this->intestado = 2;
            $queryupdate="UPDATE tusuarios SET Estado = ? WHERE Correo='$this->stremail'";
            $arrdata = array($this->intestado);
            $requestupdate= $this->update($queryupdate,$arrdata);
            return $requestupdate;
        }
        
    }

?>