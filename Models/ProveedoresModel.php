<?php 

    class ProveedoresModel extends Mysql{

        public $intidproveedor;
        public $strnombre;
        public $strciudad;
        public $strcorreo;
        public $inttelefono;
        public $strdescripcion;
        public $intstatus;

        public function __construct() {

            parent::__construct();
        }
        
        public function selectproveedores(){
            $sql= "SELECT * FROM tproveedores WHERE Estado != 0";
            $request=$this->selectall($sql);
            return $request;
        }

        public function insertproveedor(string $nombre, string $ciudad, string $correo, string $telefono, string $pais,string $rubro ,string $direccion,string $provincia,string $descripcion, int $status){
            
            $return = 0;
            $this->strnombre=$nombre;
            $this->strciudad=$ciudad;
            $this->strcorreo=$correo;
            $this->inttelefono=$telefono;

               
            $this->strpais=$pais;
            $this->strrubro=$rubro;
            $this->strdireccion=$direccion;
            $this->strprovincia=$provincia;

            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM tproveedores WHERE Nombre='{$this->strnombre}'";
            $requestinsert = $this->selectall($sql);
            if(empty($requestinsert)){
                $queryinsert="INSERT INTO tproveedores(Nombre,Ciudad,Correo,Telefono,Departamento,Rubro,Direccion,Provincia,Descripcion,Estado) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $arrdata = array($this->strnombre,$this->strciudad,$this->strcorreo,$this->inttelefono,
                $this->strpais,
                $this->strrubro,
                $this->strdireccion,
                $this->strprovincia,
                $this->strdescripcion,$this->intstatus);
                $requestinsert= $this->insert($queryinsert,$arrdata);
                $return = $requestinsert;
            }else{
                $return=-1;
            }
            return $return;

        }

        public function updateproveedor(int $idproveedor, string $nombre, string $ciudad, string $correo, string $telefono, string $pais,string $rubro ,string $direccion,string $provincia,string $descripcion, int $status){
            
            $this->intidproveedor=$idproveedor;
            $this->strnombre=$nombre;
            $this->strciudad=$ciudad;
            $this->strcorreo=$correo;
            $this->inttelefono=$telefono; 
            
            $this->strpais=$pais;
            $this->strrubro=$rubro;
            $this->strdireccion=$direccion;
            $this->strprovincia=$provincia;
            
            $this->strdescripcion=$descripcion;
            $this->intstatus=$status;

            $sql= "SELECT * FROM tproveedores WHERE Nombre='$this->strnombre' AND IdProveedor != $this->intidproveedor";
            $requestupdate = $this->selectall($sql);
            
            if(empty($requestupdate)){
                $queryupdate="UPDATE tproveedores SET Nombre=?,Ciudad=?,Correo=?,Telefono=?,Departamento=?,Rubro=?,Direccion=?,Provincia=? ,Descripcion=?,Estado=? WHERE IdProveedor=$this->intidproveedor";
                $arrdata = array($this->strnombre,$this->strciudad,$this->strcorreo,$this->inttelefono,
                $this->strpais,
                $this->strrubro,
                $this->strdireccion,
                $this->strprovincia,
                $this->strdescripcion,$this->intstatus);
                $requestupdate= $this->update($queryupdate,$arrdata);
                $return=$requestupdate;
            }else{
                $return=-1;
            }
            
            return $return;

        }

              ///eliminar proveedor
              public function deleteproveedor(int $idproveedor){
            
                $this->intidproveedor= $idproveedor;
        
        
                //$sql= "SELECT * FROM tmateriapr  WHERE IdProveedor=$this->intidproveedor";
                //$requestdelete = $this->selectall($sql);
                
                 if(empty($requestdelete)){
                    $querydelete="UPDATE tproveedores SET Estado=? WHERE IdProveedor = $this->intidproveedor";
                     $arrdata = array(0);
                    $requestdelete= $this->update($querydelete,$arrdata);
        
                    //$querydelete="DELETE FROM tproveedores  WHERE idproveedor = $this->intidproveedor";
                   // $arrdata = array(0);
                   // $requestdelete= $this->delete($querydelete,$arrdata);
        
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

        public function selectproveedor(int $idproveedor){
            $this->intidproveedor= $idproveedor;
            $sql="SELECT * FROM tproveedores WHERE IdProveedor = $this->intidproveedor";
            $request=$this->select($sql);
            return $request;
        }

     

    }

?>