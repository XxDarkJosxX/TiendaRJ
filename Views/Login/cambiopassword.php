<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?=media()?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?=media()?>/css/style.css">
  <!-- Font-icon css-->
  <title></title>


</head>

<body>
  <div class="content">
    <div class="d-flex flex-column vh-100">
      <div class="d-flex flex-grow-1 justify-content-center align-items-center">
      <section class="login-content">
        <div class="login-box flipped card col-xl-3 col-lg-4 col-md-6 col-10">
          <div class="card-body my-4">

            <form id="formcambiarpass" name="formcambiarpass" class="forget-form" action="index.html">
                <input type="hidden" id="iduser" name="iduser" value="<?= $data['IdUsuario'] ?>" required>
                <input type="hidden" id="txtemail" name="txtemail" value="<?= $data['Correo'] ?>" required>
                <input type="hidden" id="txttoken" name="txttoken" value="<?= $data['Token'] ?>" required>
                <div class="col-12 my-4">
                <div class="text-center">
                    <h3 class="fw-bold">Cambiar Contraseña</h3>
            
                </div>
                <hr>
                <div class="mb-3">
                    <div class="form-group">
                    <input id="txtpasswordcam" name="txtpasswordcam" class="form-control" type="password" placeholder="Nueva Contraseña">
                    </div>

                    <div class="form-group">
                    <input id="txtpasswordconfirm" name="txtpasswordconfirm" class="form-control" type="password" placeholder="Confirmar Contraseña">
                    </div>

                </div>
                <div class="mb-3">
                    <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Reiniciar</button>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>
                        Iniciar Sesion</a></p>
                </div>
                </div>
            </form> 
          </div>

        </div>
        </section>
      </div>
    </div>
  </div>






  <!-- Essential javascripts for application to work-->

  <script>
    const baseurl = "<?=base_url();?>";
  </script>

  <script src="<?=media()?>/js/jquery-3.3.1.min.js"></script>
  <script src="<?=media()?>/js/popper.min.js"></script>
  <script src="<?=media()?>/js/bootstrap.min.js"></script>
  <script src="<?=media()?>/js/main.js"></script>
  <script src="<?=media()?>/js/fontawesome.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?=media()?>/js/plugins/pace.min.js"></script>

  <script type="text/javascript" src="<?=media()?>/js/plugins/sweetalert.min.js"></script>

  <script src="<?=media()?>/js/<?=$data['page_functions_js']?>"></script>

  <script type="text/javascript">
    // Login Page Flipbox control
  </script>
</body>

</html>