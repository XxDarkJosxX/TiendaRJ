<?php 

    class CategoriasModel extends Mysql{

        public $intidcategorias;
        public $strnombre;
        public $strdescripcion;
        public $intstatus;


        public function __construct() {

            parent::__construct();
        }
        
        public function selectcategorias(){
            $sql= "SELECT * FROM tcategorias WHERE Estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function insertcategoria(string $categoria, string $descripcion, int $status){
            
            $return = 0;
            $this->strnombre=$categoria;
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM tcategorias WHERE Tipo='{$this->strnombre}'";
            $requestinsert = $this->selectall($sql);

            if(empty($requestinsert)){
                $queryinsert="INSERT INTO tcategorias(Tipo,Estado,Descripcion) VALUES (?,?,?)";
                $arrdata = array($this->strnombre,$this->intstatus,$this->strdescripcion);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }else{
                $return=-1;
            }
            return $return;

        }

        public function updatecategoria(int $idcategoria, string $categoria, string $descripcion, int $status){
            
            $this->intidcategorias=$idcategoria;
            $this->strnombre=$categoria;
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM tcategorias WHERE Tipo='$this->strnombre' AND IdCategoria != $this->intidcategorias";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                $queryupdate="UPDATE tcategorias SET Tipo=?,Estado=? ,Descripcion=? WHERE IdCategoria=$this->intidcategorias";
                $arrdata = array($this->strnombre,$this->intstatus,$this->strdescripcion);
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
            }else{
                $return=-1;
            }
            
            return $return;

        }

        public function deletecategoria(int $idcategoria){
            
            $this->intidcategorias=$idcategoria;
    

            $sql= "SELECT * FROM tproductos WHERE IdCategoria=$this->intidcategorias";
            $requestdelete = $this->selectall($sql);
            
            if(empty($requestdelete)){
                $querydelete="UPDATE tcategorias SET Estado=? WHERE IdCategoria = $this->intidcategorias";
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

        public function selectcategoria(int $idcategoria){
            $this->intidcategorias= $idcategoria;
            $sql="SELECT * FROM tcategorias WHERE IdCategoria = $this->intidcategorias";
            $request=$this->select($sql);
            return $request;
        }

     

    }

?>