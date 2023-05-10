<?php 

    class MaterialesModel extends Mysql{

        public $intidmateria;
        public $strnombre;
        public $strdescripcion;
        public $intstatus;


        public function __construct() {

            parent::__construct();
        }
        
        public function selectmateriales(){
            $sql= "SELECT * FROM tmaterialpr WHERE Estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function insertmaterials(string $material, string $descripcion, int $status){
            
            $return = 0;
            $this->strnombre=$material;
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM tmaterialpr WHERE Nombre='{$this->strnombre}'";
            $requestinsert = $this->selectall($sql);

            if(empty($requestinsert)){
                $queryinsert="INSERT INTO tmaterialpr(Nombre,Descripcion,Estado) VALUES (?,?,?)";
                $arrdata = array($this->strnombre,$this->strdescripcion,$this->intstatus);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }else{
                $return=-1;
            }
            return $return;

        }

        public function updatematerials(int $id, string $material, string $descripcion, int $status){
            
            $this->intidmateria=$id;
            $this->strnombre=$material;
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM tmaterialpr WHERE Nombre='$this->strnombre' AND IdMaterialPr != $this->intidmateria";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                $queryupdate="UPDATE tmaterialpr SET Nombre=?,Descripcion=?,Estado=? WHERE IdMaterialPr=$this->intidmateria";
                $arrdata = array($this->strnombre,$this->strdescripcion,$this->intstatus);
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
            }else{
                $return=-1;
            }
            
            return $return;

        }

        public function deletemateria(int $idmateria){
            
            $this->intidmateria=$idmateria;
    

           // $sql= "SELECT * FROM tmaterialpr WHERE 	IdMaterialPr =$this->intidmateria";
           // $requestdelete = $this->selectall($sql);
            
            //if(empty($requestdelete)){
                $querydelete="UPDATE tmaterialpr SET Estado=? WHERE IdMaterialPr  = $this->intidmateria";
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
                //$return='existe';
            //}
            
            return $return;

        }

        public function selectmaterial(int $idmaterial){
            $this->intidmateria= $idmaterial;
            $sql="SELECT * FROM tmaterialpr WHERE IdMaterialPr = $this->intidmateria";
            $request=$this->select($sql);
            return $request;
        }

     

    }

?>