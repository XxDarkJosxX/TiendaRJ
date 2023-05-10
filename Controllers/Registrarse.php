<?php
class Registrarse extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function registrarse()
    {
        $data['page_id'] = 2;
        $data['page_tag'] = "Catalogo";
        $data['page_title'] = "Pagina Catalogo";
        $data['page_name'] = "registrarse";
        $data['page_js'] = "functionsregistrarse.js";
        $data['page_content'] = "Lorem Ipsum is simply dumamy text; aute irure dolor in reprehenderit.";
        session_start();
            if(!empty($_SESSION['login'])){
      
                $data['logincontentdata'] = "Bienvenido ".$_SESSION['userdata']['Nombre'];
            }else{
                $data['logincontentdata'] = "Iniciar sesion";
            }
        $this->views->getview($this, "registrarse", $data);
    }

    public function setregistrarse()
    {
        if ($_POST) {
            if (empty($_POST['txtnombre']) || empty($_POST['txtapellido']) || empty($_POST['txtcorreo'])) {
                $arrresponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $strci = strclean($_POST['txtci']);
                $strnombre = ucwords(strclean($_POST['txtnombre']));
                $strapellido = ucwords(strclean($_POST['txtapellido']));
                $strcorreo = strtolower(strclean($_POST['txtcorreo']));
                $strdireccion = strclean($_POST['txtdireccion']);
                $inttelefono = intval(strclean($_POST['txttelefono']));
                $strpassword =  empty($_POST['txtcontrasenia']) ? passgenerator() : $_POST['txtcontrasenia'];
                $strpasswordencript = hash("SHA256", $strpassword);
                $requestusuario = $this->model->insertcliente($strci, $strnombre, $strapellido, $strcorreo, $strdireccion, $inttelefono, $strpasswordencript);

                if ($requestusuario > 0) {
                    $arrresponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente');
                    $nombreuser = $strnombre . ' ' . $strapellido;
                    $stremail = $strcorreo;
                    $datausuario = array(
                        'nombreuser' => $nombreuser,
                        'email' => $stremail,
                        'password' => $strpassword,
                        'asunto' => 'Bienvenido a tu tienda en línea'
                    );
                    sendEmail($datausuario, 'emailbienvenida');
                } else {
                    if ($requestusuario == -1) {
                        $arrresponse = array('status' => false, 'msg' => '!Atencion! El usuario ya existe');
                    } else
                        $arrresponse = array('status' => true, 'msg' => 'No se almaceno los datos');
                }
            }
            echo json_encode($arrresponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
