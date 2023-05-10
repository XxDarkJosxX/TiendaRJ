<?php
class Contratos extends Controllers
{

    public function __construct()       
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . "/login");
        }
        getpermisos(12);
    }

    public function contratos()
    {
        
        $data['page_tag'] = "Contratos";
        $data['page_title'] = "Administración de Contratos";
        $data['page_name'] = "ContratosAdmin";
        $data['page_js'] = "functionscontratos.js";
        $this->views->getview($this, "contratos", $data);
    }

    public function getcontratos()
    {
        $arrdata = $this->model->selectcontratos();

        for ($i = 0; $i < count($arrdata); $i++) {

            $btndownload = '';
            $btnedit = '';
            $btndelete = '';
            $script = '';

            $btndownload = '<a href="' . $arrdata[$i]['FileUrl'] . '" class="btn btn-sm btn-warning"><i class="fa-solid fa-download"></i></a>';
            
            $arrdata[$i]['FileSize'] = $this->show_filesize($arrdata[$i]['FileUrl'], 2);

           

            if ($_SESSION['permisosmod']['d']) {
                $btndelete = '<button class="btn btn-danger btn-sm btndelstyle btndelcontrato" rl="' . $arrdata[$i]['IdContrato'] . '" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
            }
            if ($i == (count($arrdata) - 1)) {
                $script = '<script type="text/javascript"> fntdelcontrato();</script>';
            }

            $arrdata[$i]['options'] = '<div class="text-center">' . $btndownload . ' ' . $btnedit . ' ' . $btndelete . ' ' . $script . ' </div>';
        }
        echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
        die();
    }

    function show_filesize($filename, $decimalplaces = 0) {
        $size = filesize($filename);
        $sizes = array('B', 'kB', 'MB', 'GB', 'TB');
        for ($i=0; $size > 1024 && $i < count($sizes) - 1; $i++) {
           $size /= 1024;
        }
        return round($size, $decimalplaces).' '.$sizes[$i];
    }

    public function getselectusuarios()
    {
        $htmloptions = "";
        $arrdata = $this->model->selectusuarios();
        if (count($arrdata) > 0) {
            for ($i = 0; $i < count($arrdata); $i++) {
                $htmloptions .= '<option value="' . $arrdata[$i]['IdUsuario'] . '">' . $arrdata[$i]['Nombre'] . " " . $arrdata[$i]['Apellido'] . '</option>';
            }
        }
        echo $htmloptions;
        die();
    }

    public function setcontratos()
    {
        // dep($_POST);
        $intidusuario = $_SESSION['userdata']['IdUsuario'];
        $datefecha = date('Y-m-d');
        $strstate = 1;

        $intidcontrato = intval($_POST['idcontrato']);
        $intidcliente = intval($_POST['idcliente']);
        $strdescripcion = strclean($_POST['txtdescripcion']);
        $filename = $_FILES['txtarchivo']['name'];
        $filetamanio = $_FILES['txtarchivo']['size'];
        $temp = $_FILES['txtarchivo']['tmp_name'];

        $fileurl = './Assets/archivos/contratos/' . $filename;

        if ($intidcontrato == 0) {
            $requestrol = $this->model->insertcontratos(
                $intidusuario,
                $intidcliente,
                $strdescripcion,
                $datefecha,
                $filename,
                $fileurl,
                $filetamanio,
                $strstate
            );
            $option = 1;
        }
        if ($intidcontrato != 0) {
            $option = 2;
        }

        if (!file_exists('./Assets/archivos/contratos/' . $filename)) {
            move_uploaded_file($temp, './Assets/archivos/contratos/' . $filename);
        }

        if ($requestrol > 0) {

            if ($option == 1) {
                $arrresponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente');
            }
            if ($option == 2) {
                $arrresponse = array('status' => true, 'msg' => 'Datos Repetidos');
            }
        } else {
            if ($requestrol == -1) {
                $arrresponse = array('status' => false, 'msg' => '!Atencion! Ya existe un contrato con este nombre');
            } else {
                $arrresponse = array('status' => true, 'msg' => 'No se almaceno los datos');
            }
        }

        echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delcontrato()
    {
        if ($_POST) {
            $intidcontrato = intval($_POST['idcontrato']);
            $requestdelete = $this->model->deletecontrato($intidcontrato);
            if ($requestdelete == 'ok') {
                $arrresponse = array('status' => true, 'msg' => 'Datos Eliminados Correctamente');
            } else {
                $arrresponse = array('status' => true, 'msg' => 'No se elimino los datos');
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
