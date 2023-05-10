<?php 

    class PagosModel extends Mysql{

        private $intidproducto;
        private $inttotal;
        private $intsubtotal;
        private $intporcentaje;
        private $intidventa;
        private $intiduser;
        private $intdescuento;
        private $intsubcantidad;
        private $inttotalcantidad;
        private $strfecha;
        private $strmetodopago;

        private $intallaprecio;
        private $cantidaddescuento;


        public function __construct() {

            parent::__construct();
        }
        

        
        public function insertventa(int $iduser,$total, int $cantidadtotal){
            
            $return = 0;
            
            $this->intiduser=$iduser;
            $this->inttotal=$total;
            $this->inttotalcantidad=$cantidadtotal;
            $this->strfecha=date('Y-m-d');
            $this->strmetodopago="PayPal";
        
            if($this->intiduser >= 0 && $this->inttotalcantidad >= 0 && $this->inttotal >= 0){

                $queryinsert="INSERT INTO tventas(IdCliente,Fecha,MetodoPago,Total,CantidadTotal) 
                              VALUES (?,?,?,?,?)";
                $arrdata = array($this->intiduser,$this->strfecha,$this->strmetodopago,$this->inttotal,$this->inttotalcantidad);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }
            return $return;

        }

        public function selectcantidad(int $idtallaprecio){
            $this->intallaprecio = $idtallaprecio;
            $queryselectcantidad="SELECT Cantidad  FROM ttallasprecio WHERE IdPrecioTalla = $this->intallaprecio";
            $request=$this->select($queryselectcantidad);
            return $request;
        }

        public function insertdtvventa(int $idventa, int $idproducto, int $cantidad, $precio, int $descuento, int $cantidaddes, int $idtallaprecio){
                  
            $return = 0;
            
            $this->intidventa=$idventa;
            $this->intidproducto=$idproducto;
            $this->intsubcantidad=$cantidad;
            $this->intsubtotal= $precio;
            $this->intdescuento= $descuento;
            $this->intallaprecio = $idtallaprecio;
            $this->cantidaddescuento = $cantidaddes;
        
            if($this->intidventa > 0 && $this->intidproducto > 0 && $this->intsubcantidad > 0 && $this->intsubtotal > 0){

         

                if( $this->cantidaddescuento){
                    if(  $this->cantidaddescuento > 0){

                        $queryupdate="UPDATE ttallasprecio SET Cantidad=?
                        WHERE IdPrecioTalla=$this->intallaprecio";

                        $arrdatau = array($this->cantidaddescuento);
                        $requestupdate= $this->update($queryupdate,$arrdatau);
                    }
                }

                $queryinsert="INSERT INTO tdetalleventas(IdVenta,IdProducto,Cantidad,Precio,Descuento) 
                              VALUES (?,?,?,?,?)";
                $arrdata = array($this->intidventa,$this->intidproducto,$this->intsubcantidad,$this->intsubtotal,$this->intdescuento);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }
            return $return;
        }
    }

?>