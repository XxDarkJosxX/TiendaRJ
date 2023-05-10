<?php 

    class CatalogoModel extends Mysql{

        public $intidproducto;
        public $intidcategoria;
        public $intidoferta;
        public $strproducto;
        public $intprecio;
        public $intcantidad;
        public $strfoto;
        public $strdescripcion;
        public $intstatus;
        public $intidtalla;

        public function __construct() {

            parent::__construct();
        }


        public function selectproductos(){
            $sql = "SELECT tp.IdProducto, tp.IdCategoria, tp.Nombre, tp.foto, tp.Descripcion, tp.Estado, tc.Tipo, tof.Porcentaje
        FROM tproductos tp
            INNER JOIN tcategorias tc ON tp.IdCategoria = tc.IdCategoria
            LEFT JOIN tofertas tof ON tp.IdProducto = tof.IdProducto AND tof.Estado != 2
        WHERE tp.Estado != 0";
        $request = $this->selectall($sql);
        return $request;
        }

        public function selectcategoias(){
            $sql= "SELECT * FROM  tcategorias WHERE Estado != 0 AND Estado != 2";
            $request=$this->selectall($sql);
            return $request;
        }
        
        public function selectproducto(int $id){
            $this->intidproducto=$id;
            $sql= "SELECT tp.IdProducto, tp.IdCategoria, tp.Nombre, tp.foto, tp.Descripcion, tp.Estado, tc.Tipo 
            FROM tproductos tp, tcategorias tc
            WHERE tp.Estado != 0 AND tp.IdCategoria = tc.IdCategoria AND tp.Estado != 2 AND tp.IdProducto =$this->intidproducto";
            $request=$this->select($sql);
            return $request;
        }

        public function selecttallas(int $idproducto){
   
            $this->intidproducto=$idproducto;
         
            
            $sql = "SELECT ttp.IdTalla, tt.Nombre, ttp.Precio
            FROM ttallasprecio ttp
            INNER JOIN ttallas tt ON ttp.IdTalla = tt.IdTalla 
            INNER JOIN tproductos tp ON ttp.IdProducto = tp.IdProducto
            WHERE ttp.IdProducto = $this->intidproducto";
            $request = $this->selectall($sql);
            return $request;
        }


        public function selectpreciotalla($idproducto,$idtalla){
            $this->intidproducto=$idproducto;
            $this->intidtalla=$idtalla;
            
            $sql = "SELECT ttp.IdPrecioTalla, ttp.Precio, tt.Nombre, tto.Porcentaje
            FROM ttallasprecio ttp  
            INNER JOIN ttallas tt ON ttp.IdTalla = tt.IdTalla 
            INNER JOIN tproductos tp ON ttp.IdProducto = tp.IdProducto
            LEFT JOIN tofertas tto ON ttp.IdProducto = tto.IdProducto
            WHERE ttp.IdTalla = $this->intidtalla AND ttp.IdProducto = $this->intidproducto";
            $request = $this->select($sql);
            return $request;
        }

        
        public function selectoferta($idproducto){
            $this->intidproducto=$idproducto;
      
            
            $sql = "SELECT IdProducto, Cantidad, Porcentaje 
            FROM tofertas tof  
            WHERE IdProducto = $this->intidproducto AND Estado != 0 AND Estado != 2";
            $request = $this->select($sql);
            return $request;
        }

    }

?>