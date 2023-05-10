<?php 

    class PedidosModel extends Mysql{

        private $intidproducto;
        private $inttotal;
        private $intsubtotal;
        private $intporcentaje;
        private $intidventa;
        private $intiduser;
        private $intidcliente;
        private $intdescuento;
        private $intsubcantidad;
        private $inttotalcantidad;
        private $strfecha;
        private $strmetodopago;

        public function __construct() {

            parent::__construct();
        }
        
        
        public function selectpedidosclientes(int $idcliente){
            $this->intidcliente=$idcliente;

            $sql= "SELECT  tv.IdVenta, tc.Nombre, tv.Fecha, tv.MetodoPago, tv.Total, tv.CantidadTotal, tv.Estado
            FROM tventas tv
            INNER JOIN tusuarios tc ON tv.IdCliente = tc.IdUsuario
            WHERE  tv.IdCliente =$this->intidcliente AND tc.IdRoles = 2";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectpedidosempleados(){
       

            $sql= "SELECT  tv.IdVenta, tc.Nombre AS Cliente,te.Nombre AS Empleado, tv.Fecha, tv.MetodoPago, tv.Total, tv.CantidadTotal, tv.Estado
            FROM tventas tv
            INNER JOIN tusuarios tc ON tv.IdCliente = tc.IdUsuario
            LEFT JOIN tusuarios te ON tv.IdUsuario = te.IdUsuario
           ";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectroluser(int $idcliente){

            $this->intidcliente=$idcliente;

            $sql= "SELECT  tu.IdRoles
            FROM tusuarios tu
            INNER JOIN troles tr ON tr.IdRoles = tu.IdRoles
            WHERE  tu.IdUsuario =$this->intidcliente";
            $request=$this->select($sql);
            return $request;
        }

    }

?>