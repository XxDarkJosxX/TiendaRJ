<?php 

    class ProductosModel extends Mysql{

        public $intidproducto;
        public $intidcategoria;
        public $intidoferta;
        public $strproducto;
        public $intprecio;
        public $intcantidad;
        public $strfoto;
        public $strdescripcion;
        public $intstatus;
        private $intidtalla;

        public function __construct() {

            parent::__construct();
        }
        
        public function selectproductos(){
            $sql= "SELECT tp.IdProducto, tp.IdCategoria, tp.Nombre, tp.foto, tp.Descripcion, tp.Estado, tc.Tipo FROM tproductos tp, tcategorias tc WHERE tp.Estado != 0 AND tp.IdCategoria = tc.IdCategoria";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selecttallas($idproducto){
            $this->strproducto=$idproducto;


            $sql= "SELECT IdTalla, Nombre
                    FROM ttallas
                    ORDER BY IdTalla ASC";
            $requesttallas=$this->selectall($sql);

            $sql= "SELECT tt.IdTalla, tt.Nombre, ttp.Precio, ttp.Cantidad
                    FROM ttallas tt
                    LEFT JOIN ttallasprecio ttp ON ttp.IdTalla = tt.IdTalla
                    WHERE ttp.IdProducto =  $this->strproducto
                    ORDER BY tt.IdTalla ASC";
            $requestpreciotalla=$this->selectall($sql);


            $request = array('tallas' => $requesttallas,
								'preciotallas' => $requestpreciotalla
								 );
            
            return $request;
        }

        

        public function insertproducto(int $categoria, string $producto, $foto,string $descripcion, int $status){
            
            $return = 0;
            $this->intidcategoria=$categoria;
            $this->strproducto=$producto;
            $this->strfoto=$foto;
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM tproductos WHERE Nombre='{$this->strproducto}'";
            $requestinsert = $this->selectall($sql);

            if(empty($requestinsert)){
                $queryinsert="INSERT INTO tproductos(IdCategoria, Nombre, foto, Descripcion, Estado) VALUES (?,?,?,?,?)";
                $arrdata = array($this->intidcategoria,$this->strproducto,$this->strfoto,$this->strdescripcion,$this->intstatus);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }else{
                $return=-1;
            }
            return $return;

        }


        public function deletetallasprecio(int $idproducto){
            $this->intidproducto=$idproducto;

            $querydelete="DELETE FROM ttallasprecio WHERE IdProducto =  $this->intidproducto";
            $request= $this->delete($querydelete);
            return $request;
        }

        public function inserttallaprecio(int $idtalla, int $idproducto, $precio, int $cantiad){
            $return = 0;
            $this->intidtalla=$idtalla;
            $this->intidproducto=$idproducto;
            $this->intprecio=$precio;
            $this->intcantidad=$cantiad;
            
            $queryinsert="INSERT INTO ttallasprecio(IdTalla, IdProducto, Precio, Cantidad) 
                          VALUES (?,?,?,?)";
            $arrdata = array($this->intidtalla,$this->intidproducto,$this->intprecio,$this->intcantidad);
            $requestinsert= $this->insert($queryinsert,$arrdata);
            $return = $requestinsert;
            return $return;
        }

        public function updateproducto(int $idproducto ,int $categoria,string $producto, $foto,string $descripcion, int $status){
            
            $this->intidproducto=$idproducto;
            $this->intidcategoria=$categoria;
           
            $this->strproducto=$producto;
            $this->strfoto=$foto;
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM tproductos WHERE Nombre='$this->strproducto' AND IdProducto != $this->intidproducto";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                if($this->strfoto == ''){
                    $queryupdate="UPDATE tproductos SET IdCategoria=?,Nombre=? ,Descripcion=?,Estado=? WHERE IdProducto=$this->intidproducto";
                    $arrdata = array($this->intidcategoria,$this->strproducto,$this->strdescripcion,$this->intstatus);
                   
                }else{
                    $queryupdate="UPDATE tproductos SET IdCategoria=?,Nombre=?,foto=?,Descripcion=?,Estado=? WHERE IdProducto=$this->intidproducto";
                    $arrdata = array($this->intidcategoria,$this->strproducto,$this->strfoto,$this->strdescripcion,$this->intstatus);
                }

                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
                
            }else{
                $return=-1;
            }
            
            return $return;

        }

        public function deleteproducto(int $idproducto){
            
            $this->intidproducto=$idproducto;
    

            //$sql= "SELECT * FROM tusuarios WHERE IdRoles=$this->intidrol";
            //$requestdelete = $this->selectall($sql);
            
            //if(empty($requestdelete)){
                $querydelete="UPDATE tproductos SET Estado=? WHERE IdProducto = $this->intidproducto";
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
                
            //}else{
               // $return='existe';
            //}
            
            return $return;

        }

        public function selectproducto(int $idproducto){
            $this->intidproducto= $idproducto;
            $sql= "SELECT * FROM tproductos tp, tcategorias tc WHERE tp.IdCategoria = tc.IdCategoria AND tp.IdProducto = $this->intidproducto";
            $request=$this->select($sql);
            return $request;
        }

        public function selectcategorias(){
          
            $sql="SELECT * FROM tcategorias WHERE Estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

     

    }

?>