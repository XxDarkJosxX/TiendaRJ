<?php 

    class RolesModel extends Mysql{

        public $intidrol;
        public $strrol;
        public $strdescripcion;
        public $intstatus;


        public function __construct() {

            parent::__construct();
        }
        
        public function selectroles(){
            $sql= "SELECT * FROM troles WHERE Estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function insertrol(string $rol, string $descripcion, int $status){
            
            $return = 0;
            $this->strrol=$rol;
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM troles WHERE Tipo='{$this->strrol}'";
            $requestinsert = $this->selectall($sql);
            if(empty($requestinsert)){
                $queryinsert="INSERT INTO troles(Tipo,Estado,Descripcion) VALUES (?,?,?)";
                $arrdata = array($this->strrol,$this->intstatus,$this->strdescripcion);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }else{
                $return=-1;
            }
            return $return;

        }

        public function updaterol(int $idrol, string $rol, string $descripcion, int $status){
            
            $this->intidrol=$idrol;
            $this->strrol=$rol;
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM troles WHERE Tipo='$this->strrol' AND IdRoles != $this->intidrol";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                $queryupdate="UPDATE troles SET Tipo=?,Estado=? ,Descripcion=?WHERE IdRoles=$this->intidrol";
                $arrdata = array($this->strrol,$this->intstatus,$this->strdescripcion);
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
            }else{
                $return=-1;
            }
            
            return $return;

        }

        public function deleterol(int $idrol){
            
            $this->intidrol=$idrol;
    

            $sql= "SELECT * FROM tusuarios WHERE IdRoles=$this->intidrol";
            $requestdelete = $this->selectall($sql);
            
            if(empty($requestdelete)){
                $querydelete="UPDATE troles SET Estado=? WHERE IdRoles = $this->intidrol";
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

        public function selectrol(int $idrol){
            $this->intidrol= $idrol;
            $sql="SELECT * FROM troles WHERE IdRoles = $this->intidrol";
            $request=$this->select($sql);
            return $request;
        }

     

    }

?>