<?php
class Ofertas extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . "/login");
        }
        getpermisos(13);
    }
    public function ofertas()
    {

        $data['page_tag'] = "Ofertas";
        $data['page_title'] = "Administración de Ofertas";
        $data['page_name'] = "Ofertas";
        $data['page_js'] = "functionsofertas.js";
        $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit.";
        $this->views->getview($this, "ofertas", $data);
    }
    public function getofertas()
    {
        $arrdata = $this->model->selectofertas();

        for ($i = 0; $i < count($arrdata); $i++) {

            $btnedit = '';
            $btndelete = '';
            $script = '';

            if ($arrdata[$i]['Estado'] == 1) {
                $arrdata[$i]['Estado'] = '<span class="badge badge-pill badge-success">Activo</span>';
            } else {
                $arrdata[$i]['Estado'] = '<span class="badge badge-pill badge-danger">Inactivo</span>';
            }

            if ($_SESSION['permisosmod']['u']) {
                $btnedit = '<button class="btn btn-primary btn-sm btneditstyle btneditofertas" rl="' . $arrdata[$i]['IdOfertas'] . '" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>';
            }

            if ($_SESSION['permisosmod']['d']) {
                $btndelete = '<button class="btn btn-danger btn-sm btndelstyle btndelofertas" rl="' . $arrdata[$i]['IdOfertas'] . '" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>';
            }
            if ($i == (count($arrdata) - 1)) {
                $script = '<script type="text/javascript"> fnteditofertas();fntdelofertas();</script>';
            }

            $arrdata[$i]['options'] = '<div class="text-center">' . $btnedit . ' ' . $btndelete . ' ' . $script . ' </div>';

            // $arrdata[$i]['options'] = '<div class="text-center">
            //     <button class="btn btn-primary btn-sm btneditstyle btneditofertas" rl="' . $arrdata[$i]['IdOferta'] . '" title="Editar" type="button"><i class="fas fa-pencil-alt"></i></button>
            //     <button class="btn btn-danger btn-sm btndelstyle btndelofertas" rl="' . $arrdata[$i]['IdOferta'] . '" title="Eliminar" type="button"><i class="fas fa-trash-alt"></i></button>
            //     <script type="text/javascript"> fnteditofertas();fntdelofertas();</script>
            //     </div>';
        }
        echo json_encode($arrdata, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function setofertas()
    {
        //dep($_POST);
        $intidoferta = intval($_POST['idoferta']);
        $intidproducto = strclean($_POST['txtproducto']);
        $intporcentaje = intval($_POST['txtporcentaje']);
        $strfechaini = $_POST['txtfechaini'];
        $strfechafin = $_POST['txtfechafin'];
        $intstatus = intval($_POST['liststatus']);

        if ($intidoferta == 0) {
            $requestrol = $this->model->insertofertas($intidproducto, $intporcentaje, $strfechaini, $strfechafin,  $intstatus);
            $option = 1;
        }
        if ($intidoferta != 0) {
            $requestrol = $this->model->updateofertas($intidoferta, $intidproducto, $intporcentaje, $strfechaini, $strfechafin,  $intstatus);
            $option = 2;
        }

        if ($requestrol > 0) {

            if ($option == 1) {
                $arrresponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente');
            }
            if ($option == 2) {
                $arrresponse = array('status' => true, 'msg' => 'Datos Actualizados Correctamente');
            }
        } else {
            if ($requestrol == -1) {
                $arrresponse = array('status' => false, 'msg' => '!Atencion! La oferta ya existe');
            } else {
                $arrresponse = array('status' => true, 'msg' => 'No se almaceno los datos');
            }
        }

        echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getselectproductos()
    {

        $htmloptions = "";
        $arrdata = $this->model->selectproductos();
        if (count($arrdata) > 0) {
            for ($i = 0; $i < count($arrdata); $i++) {
                $htmloptions .= '<option value="' . $arrdata[$i]['IdProducto'] . '">' . $arrdata[$i]['Nombre'] . '</option>';
            }
        }
        echo $htmloptions;
        die();
    }

    public function getoferta($idofertas)
    {
        //dep($_POST);
        $intidofertas = intval(strclean($idofertas));

        if ($intidofertas > 0) {
            $arrdata = $this->model->selectoferta($intidofertas);
            if (empty($arrdata)) {
                $arrresponse = array('status' => false, 'msg' => 'Datos no encontrados');
            } else {
                $arrresponse = array('status' => true, 'data' => $arrdata);
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delofertas()
    {
        if ($_POST) {
            $intidofertas = intval($_POST['idofertas']);
            $requestdelete = $this->model->deleteofertas($intidofertas);
            if ($requestdelete == 'ok') {
                $arrresponse = array('status' => true, 'msg' => 'Datos Eliminados Correctamente' . $requestdelete);
            } else {
                $arrresponse = array('status' => true, 'msg' => 'No se elimino los datos' . $requestdelete);
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setofertaEstado($idoferta)
    {
        $requestupdate = $this->model->updateofertaEstado($idoferta);
        if ($requestupdate == 'ok') {
            $arrresponse = array('status' => true, 'msg' => 'Datos Actualizados Correctamente' . $requestupdate);
        } else {
            $arrresponse = array('status' => true, 'msg' => 'No se elimino los datos' . $requestupdate);
        }
        echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}
