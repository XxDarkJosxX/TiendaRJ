<?php 

    class VentasModel extends Mysql{
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
        private $intestado;

        public function __construct() {

            parent::__construct();
        }
    
        public function selectventas(){
            $sql= "SELECT tv.IdVenta, tv.IdUsuario, tv.Fecha, tv.MetodoPago, tv.Total FROM tventas tv, tusuarios tu WHERE tv.IdUsuario = tu.IdUsuario";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectdetalleventas($idventa){
            $request=0;
            if($idventa != 0){
            $this->intidventa=$idventa;
            $sql= "SELECT 			        d.IdDetalleVenta,
											p.Nombre as Producto,
											d.Precio,
											d.Cantidad,
											d.Descuento
									FROM tdetalleventas d
									INNER JOIN tproductos p ON d.IdProducto = p.IdProducto
									WHERE d.IdVenta = $this->intidventa";
            $request=$this->selectall($sql);
            }
            return $request;
        }


        public function selectproductos(){
          
            $sql="SELECT * FROM tproductos WHERE Estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }
     
        public function selectclientes(){
          
            $sql="SELECT * FROM tusuarios WHERE Estado != 0  AND IdRoles = 2";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selecttallas(int $idproducto){
   
            $this->intidproducto=$idproducto;
         
            
            $sql = "SELECT ttp.IdTalla, tt.Nombre
            FROM ttallasprecio ttp
            INNER JOIN ttallas tt ON ttp.IdTalla = tt.IdTalla 
            INNER JOIN tproductos tp ON ttp.IdProducto = tp.IdProducto
            WHERE ttp.IdProducto = $this->intidproducto";
            $request = $this->selectall($sql);
            return $request;
        }

//========================================================Ventas==============================================================
        public function insertventa(int $idcliente,int $iduser,$total, int $cantidadtotal){
            
            $return = 0;
            $this->intidcliente=$idcliente;
            $this->intiduser=$iduser;
            $this->inttotal=$total;
            $this->inttotalcantidad=$cantidadtotal;
            $this->strfecha=date('Y-m-d');
            $this->strmetodopago="Pago en Efectivo";
        
            if($this->intiduser >= 0 && $this->inttotalcantidad >= 0 && $this->inttotal >= 0){

                $queryinsert="INSERT INTO tventas(IdUsuario,IdCliente,Fecha,MetodoPago,Total,CantidadTotal) 
                              VALUES (?,?,?,?,?,?)";
                $arrdata = array($this->intiduser,$this->intidcliente,$this->strfecha,$this->strmetodopago,$this->inttotal,$this->inttotalcantidad);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }
            return $return;

        }

        public function insertdtvventa(int $idventa, int $idproducto, int $cantidad, $precio, int $descuento){
                  
            $return = 0;
            
            $this->intidventa=$idventa;
            $this->intidproducto=$idproducto;
            $this->intsubcantidad=$cantidad;
            $this->intsubtotal= $precio;
            $this->intdescuento= $descuento;
        
            if($this->intidventa > 0 && $this->intidproducto > 0 && $this->intsubcantidad > 0 && $this->intsubtotal > 0){

                $queryinsert="INSERT INTO tdetalleventas(IdVenta,IdProducto,Cantidad,Precio,Descuento) 
                              VALUES (?,?,?,?,?)";
                $arrdata = array($this->intidventa,$this->intidproducto,$this->intsubcantidad,$this->intsubtotal,$this->intdescuento);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }
            return $return;
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

        public function selectventaestado(int $idventa){
            $this->intidventa=$idventa;
            $sql="SELECT IdVenta, Estado FROM tventas WHERE IdVenta =  $this->intidventa";
            $request=$this->select($sql);
            return $request;
        }
        
        public function updateventaestado(int $idventa, $estado){
            $this->intidventa=$idventa;
            $this->intestado=$estado;

            $queryupdate="UPDATE tventas SET Estado = ? WHERE IdVenta=$this->intidventa";
            $arrdata = array($this->intestado);
            $requestupdate= $this->update($queryupdate,$arrdata);
            $return=$requestupdate;
            return $return;
        }
  

    }

?>