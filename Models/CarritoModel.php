<?php 

    class CarritoModel extends Mysql{

        public $intidproducto;
        public $intidcategoria;
        public $intidoferta;
        public $strproducto;
        public $intprecio;
        public $intcantidad;
        public $strfoto;
        public $strdescripcion;
        public $intstatus;
        public $intidtallaprecio;
   

        public function __construct() {
            parent::__construct();
        }

        
        public function selectproducto(int $id, int $idtallaprecio){
            $this->intidproducto=$id;
            $this->intidtallaprecio=$idtallaprecio;
            $sql= "SELECT  ttp.IdPrecioTalla, tp.IdProducto, tp.IdCategoria, tp.Nombre,tp.foto, ttp.Precio, tt.Nombre as NombreT, tp.Cantidad, tp.foto, tp.Descripcion, tp.Estado, tc.Tipo, tto.Porcentaje
            FROM tproductos tp
            INNER JOIN tcategorias tc ON tp.IdCategoria = tc.IdCategoria
            INNER JOIN ttallasprecio ttp ON ttp.IdPrecioTalla = $this->intidtallaprecio
            INNER JOIN ttallas tt ON tt.IdTalla = ttp.IdTalla
            LEFT JOIN tofertas tto ON tp.IdProducto = tto.IdProducto
            WHERE tp.Estado != 0 AND tp.Estado != 2 AND tp.IdProducto =$this->intidproducto";
            $request=$this->select($sql);
            return $request;
        }


      
    }

?>