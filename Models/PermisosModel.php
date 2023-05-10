<?php 

    class PermisosModel extends Mysql{

        public $intidpermiso;
        public $intidrol;
        public $intidmodulo;
        public $rv;
        public $wv;
        public $uv;
        public $dv;
        public function __construct() {

            parent::__construct();
        }
        
        public function selectmodulos(){
            $sql= "SELECT * FROM tmodulos WHERE Estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function selectpermisos(int $idrol){
            $this->intidrol=$idrol;
            $sql= "SELECT * FROM tpermisos WHERE IdRol = $this->intidrol";
            $request=$this->selectall($sql);
            return $request;
        }

        public function insertPermisos(int $idmodulo, int $idrol, $r,$w,$u,$d){
            
        
            $this->intidrol=$idrol;
            $this->intidmodulo=$idmodulo;
            $this->rv=$r;
            $this->wv=$w;
            $this->uv=$u;
            $this->dv=$d;

          
                $queryinsert="INSERT INTO tpermisos(IdModulo,IdRol,r,w,u,d) VALUES (?,?,?,?,?,?)";
                $arrdata = array($this->intidmodulo,$this->intidrol,$this->rv,$this->wv,$this->uv,$this->dv);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
          
            return $return;

        }


        public function deletepermisos(int $idrol){
            
            $this->intidrol=$idrol;
    

            $querydelete="DELETE FROM tpermisos WHERE IdRol = $this->intidrol";
            $request=$this->delete($querydelete);
            return $request;

        }

        public function selectrol(int $idrol){
            $this->intidrol= $idrol;
            $sql="SELECT * FROM troles WHERE IdRoles = $this->intidrol";
            $request=$this->select($sql);
            return $request;
        }

        public function permisosmodulo(int $idrol){
            $this->intidrol= $idrol;
            $sql= "SELECT tp.IdRol, tp.IdModulo, tm.Nombre, tp.r, tp.w, tp.u, tp.d
            FROM tpermisos tp
            INNER JOIN tmodulos tm
            ON tp.IdModulo = tm.IdModulo
            WHERE tp.IdRol = $this->intidrol";
            $request=$this->selectall($sql);
            $arrpermisos = array();
            
            for ($i=0; $i < count($request); $i++) { 
                $arrpermisos[$request[$i]['IdModulo']]=$request[$i];
            }
            return $arrpermisos;

        }

    }

?>