<?php 

    function base_url() {
        return BASE_URL;
    }
    
    function media()
    {
        return BASE_URL."/Assets";
    }
    
    function headeradmin($data=""){
        $viewheader= "Views/Template/header_admin.php";
        require_once($viewheader);
    }

    function footeradmin($data=""){
        $viewfooter= "Views/Template/footer_admin.php";
        require_once($viewfooter);
    }

    function headerprincipal($data=""){
        $viewheader= "Views/Template/header_principal.php";
        require_once($viewheader);
    }

    function footerprincipal($data=""){
        $viewfooter= "Views/Template/footer_principal.php";
        require_once($viewfooter);
    }


     function getmodal(string $namemodal, $data){
        $viewmodal= "Views/Template/Modals/{$namemodal}.php";
        require_once($viewmodal);
    }
    

    function dep($data)
    {
        $format  = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }


    function sendemail($data,$template)
    {
        $emailDestino = $data['email'];
        $asunto = $data['asunto'];
        
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    }

    function getpermisos(int $idmodulo){
        require_once("Models/PermisosModel.php");
        $objpermisos=new PermisosModel;
        $idrol = $_SESSION['userdata']['IdRoles'];
        $arrpermisos= $objpermisos->permisosmodulo($idrol);
        $permisos='';
        $permisosmod='';

        if(count($arrpermisos)>0){
            $permisos=$arrpermisos;
            $permisosmod = isset($arrpermisos[$idmodulo]) ? $arrpermisos[$idmodulo]:"";
        }

        $_SESSION['permisos']=$permisos;
        $_SESSION['permisosmod']=$permisosmod;

    }

    function sessionuser(int $idser){
        require_once("Models/LoginModel.php");
        $objlogin= new LoginModel();
        $request= $objlogin->sessionlogin($idser);

        return $request;
    }

    function getFile(string $url, $data)
    {
        ob_start();
        require_once("Views/{$url}.php");
        $file = ob_get_clean();
        return $file;        
    }

    //Elimina exceso de espacios entre palabras
    function strclean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }

     //Genera una contraseña de 10 caracteres
     function passgenerator($length = 10)
     {
         $pass = "";
         $longitudPass=$length;
         $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
         $longitudCadena=strlen($cadena);

         for($i=1; $i<=$longitudPass; $i++)
         {
             $pos = rand(0,$longitudCadena-1);
             $pass .= substr($cadena,$pos,1);
         }
         return $pass;
     }

     //Genera un token
     function token()
     {
         $r1 = bin2hex(random_bytes(10));
         $r2 = bin2hex(random_bytes(10));
         $r3 = bin2hex(random_bytes(10));
         $r4 = bin2hex(random_bytes(10));
         $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
         return $token;
     }

     //Formato para valores monetarios
     function formatmoney($cantidad){
         $cantidad = number_format($cantidad,2,SPD,SPM);
         return $cantidad;
     }

?>