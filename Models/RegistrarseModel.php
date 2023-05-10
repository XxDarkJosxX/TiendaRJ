<?php
//Moises
class RegistrarseModel extends Mysql
{
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

    public function __construct()
    {
        parent::__construct();
    }

    public function insertcliente(
        string $ci,
        string $nombre,
        string $apellido,
        string $email,
        string $direccion,
        int $telefono,
        string $password
    ) {
        $return = 0;
        $this->intci = $ci;
        $this->strnombre = $nombre;
        $this->strapellido = $apellido;
        $this->strcorreo = $email;
        $this->strdireccion = $direccion;
        $this->inttelefono = $telefono;
        $this->strcontrasenia = $password;
        $this->intstatus = 1;
        $this->intidrol = 2;

        $sql = "SELECT * FROM tusuarios 
                    WHERE Correo = '{$this->strcorreo}' or ci = '{$this->intci}' ";
        $request = $this->selectall($sql);

        if (empty($request)) {
            $query  = "INSERT INTO tusuarios(IdRoles,ci,Nombre,NombreFiscal,Apellido,Telefono,Correo,Direccion,Contrasenia,Estado, Token)
                VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            $arrdata = array(
                $this->intidrol,
                $this->intci,
                $this->strnombre,
                null,
                $this->strapellido,
                $this->inttelefono,
                $this->strcorreo,
                $this->strdireccion,
                $this->strcontrasenia,
                $this->intstatus,
                null
            );
            $request = $this->insert($query, $arrdata);
            $return = $request;
        } else {
            $return = -1;
        }
        return $return;
    }
}
