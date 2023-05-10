<?php
//Moises
class ComprasModel extends Mysql
{
    public $intidcompra;
    public $intidusuario;
    public $intidproveedor;
    public $intidmateria;
    public $inttotal;
    public $datefecha;
    public $intstatus;

    public function __construct()
    {
        parent::__construct();
    }
    
    public function selectcompras()
    {
        $sql = "SELECT tcompra.IdCompra, tcompra.IdUsuario, tusuarios.Nombre 
        as NombreU, tcompra.IdProveedor, tproveedores.Nombre 
        as NombreP, tcompra.IdMaterialPr, tmaterialpr.Nombre 
        as NombreM, tcompra.Total, tcompra.Fecha, tcompra.Descripcion, tcompra.Estado 
        FROM tcompra 
        INNER JOIN tusuarios ON tcompra.IdUsuario = tusuarios.IdUsuario 
        INNER JOIN tproveedores ON tcompra.IdProveedor = tproveedores.IdProveedor 
        INNER JOIN tmaterialpr ON tcompra.IdMaterialPr = tmaterialpr.IdMaterialPr";
        $request = $this->selectall($sql);
        return $request;
    }

    public function selectcompra(int $idcompra)
    {
        $this->intidcompra = $idcompra;
        $sql = "SELECT * FROM tcompra tc WHERE tc.IdCompra = $this->intidcompra";
        $request = $this->select($sql);
        return $request;
    }

    /**
     * Insertar Compra
     */
    public function insertcompra(int $idusuario, int $idproveedor, int $idmateria, int $total, string $fecha, string $descripcion ,int $status)
    {

        $return = 0;
        $this->intidusuario = $idusuario;
        $this->intidproveedor = $idproveedor;
        $this->intidmateria = $idmateria;
        $this->inttotal = $total;
        $this->datefecha = $fecha;
        
        $this->strdescripcion=$descripcion;

        $this->intstatus = $status;


        //$sql= "SELECT * FROM tcompras WHERE Nombre='{$this->strproducto}'";
        //$requestinsert = $this->selectall($sql);

        //if(empty($requestinsert)){
         $queryinsert = "INSERT INTO tcompra(IdUsuario, IdProveedor,	IdMaterialPr, Total, Fecha, Descripcion, Estado) VALUES (?,?,?,?,?,?,?)";
        $arrdata = array($this->intidusuario, $this->intidproveedor, $this->intidmateria, $this->inttotal, $this->datefecha,$this->strdescripcion, $this->intstatus);
        $requestinsert = $this->insert($queryinsert, $arrdata);
        //}else{
        //    $return=-1;
        //}
        return $requestinsert;
    }
    
    /**
     * Actualizar Compra
     */
    public function updatecompra($intidcompra, $intidusuario, $intidproveedor, $intidmateriaPr, $inttotal,  $strdescripcion, $intestado)
    {
        $this->intidcompra = $intidcompra;
        $this->intidusuario = $intidusuario;
        $this->intidproveedor = $intidproveedor;
        $this->intidmateriaPr = $intidmateriaPr;
        $this->inttotal = $inttotal;
        $this->strdescripcion = $strdescripcion;
        $this->intestado = $intestado;
        $queryupdate = "UPDATE tcompra SET IdUsuario = ?, IdProveedor = ?, IdMaterialPr = ?, Total = ?,Descripcion = ?, Estado = ? WHERE IdCompra = $this->intidcompra";
        $arrdata = array($this->intidusuario, $this->intidproveedor, $this->intidmateriaPr, $this->inttotal, $this->strdescripcion, $this->intestado);
        $requestupdate = $this->update($queryupdate, $arrdata);
        return $requestupdate;
    }
    /////////////////////////////////////////
    public function deleteusaurio(int $idusuarios)
    {

        $this->intidusuario = $idusuarios;

        $querydelete = "UPDATE tusuarios SET Estado=? WHERE IdUsuario = $this->intidusuario";
        $arrdata = array(0);
        $requestdelete = $this->update($querydelete, $arrdata);

        //$querydelete="DELETE FROM rol  WHERE idrol = $this->intidrol";
        //$arrdata = array(0);
        //$requestdelete= $this->delete($querydelete,$arrdata);

        if ($requestdelete) {
            $requestdelete = 'ok';
            $return = $requestdelete;
        } else {
            $request = 'error';
            $return = $request;
        }
        /*
            }else{
                $return='existe';
            }
            */
        return $return;
    }
    //
    public function deleterol(int $idrol)
    {

        $this->intidrol = $idrol;


        $sql = "SELECT * FROM tusuarios WHERE IdRoles=$this->intidrol";
        $requestdelete = $this->selectall($sql);

        if (empty($requestdelete)) {
            $querydelete = "UPDATE troles SET Estado=? WHERE IdRoles = $this->intidrol";
            $arrdata = array(0);
            $requestdelete = $this->update($querydelete, $arrdata);

            //$querydelete="DELETE FROM rol  WHERE idrol = $this->intidrol";
            //$arrdata = array(0);
            //$requestdelete= $this->delete($querydelete,$arrdata);

            if ($requestdelete) {
                $requestdelete = 'ok';
                $return = $requestdelete;
            } else {
                $request = 'error';
                $return = $request;
            }
        } else {
            $return = 'existe';
        }

        return $return;
    }



    public function selectusuarios($idusuario)
    {
        $this->intidusuario = $idusuario;
        $sql = "SELECT * FROM tusuarios WHERE Estado != 0 AND IdUsuario = $this->intidusuario";
        $request = $this->select($sql);
        return $request;
    }

    public function selectproveedores()
    {

        $sql = "SELECT * FROM tproveedores WHERE Estado != 0";
        $request = $this->selectall($sql);
        return $request;
    }
    public function selectmaterias()
    {

        $sql = "SELECT * FROM tmaterialpr WHERE Estado != 0";
        $request = $this->selectall($sql);
        return $request;
    }
}
