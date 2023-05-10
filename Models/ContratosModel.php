<?php

class ContratosModel extends Mysql
{

    public $intidcontrato;
    public $intidusuario;
    public $intidcliente;
    public $strdescripcion;
    public $strdate;
    public $strfilename;
    public $strurl;
    public $intsize;
    public $estado;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectcontratos()
    {
        $sql = "SELECT t.IdContrato, CONCAT_WS(' ',tu.Nombre, tu.Apellido) Usuario, CONCAT_WS(' ',tc.Nombre, tc.Apellido) Cliente, t.Descripcion, t.FileName, t.FileSize, t.FileUrl, t.Fecha, t.Estado
        FROM tcontrato t, tusuarios tu, tusuarios tc
        WHERE t.IdUsuario = tu.IdUsuario AND t.IdCliente = tc.IdUsuario AND t.Estado != 0";
        $request = $this->selectall($sql);
        return $request;
    }

    public function selectusuarios()
    {
        $sql = "SELECT * FROM tusuarios where IdRoles = 2 and Estado != 0";
        $request = $this->selectall($sql);
        return $request;
    }

    public function insertcontratos($idusuario_r, $idcliente_r, $strdescripcion_r, $datefecha_r, $filename_r, $download_r, $filetamanio_r, $status)
    {
        $return = 0;
        $this->intidusuario = $idusuario_r;
        $this->intidcliente = $idcliente_r;
        $this->strdescripcion = $strdescripcion_r;
        $this->strdate = $datefecha_r;
        $this->strfilename = $filename_r;
        $this->strurl = $download_r;
        $this->intsize = $filetamanio_r;
        $this->estado = $status;

        $sql = "SELECT * FROM tcontrato WHERE FileName = '{$this->strfilename}'";
        $requestinsert = $this->selectall($sql);

        if (empty($requestinsert)) {
            $queryinsert = "INSERT INTO tcontrato(IdUsuario, IdCliente, Descripcion, Fecha, FileName,  FileUrl, FileSize, Estado) VALUES (?,?,?,?,?,?,?,?)";
            $arrdata = array(
                $this->intidusuario,
                $this->intidcliente,
                $this->strdescripcion,
                $this->strdate,
                $this->strfilename,
                $this->strurl,
                $this->intsize,
                $this->estado
            );
            $requestinsert = $this->insert($queryinsert, $arrdata);
            $return = $requestinsert;
        } else {
            $return = -1;
        }
        return $return;
    }

    public function deletecontrato(int $idcontratos_r)
    {
        $this->intidcontrato = $idcontratos_r;
        $querydelete = "UPDATE tcontrato SET Estado=? WHERE IdContrato = $this->intidcontrato";
        $arrdata = array(0);
        $requestdelete = $this->update($querydelete, $arrdata);

        if ($requestdelete) {
            $requestdelete = 'ok';
            $return = $requestdelete;
        } else {
            $request = 'error';
            $return = $request;
        }

        return $return;
    }
}
