<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?= media();?>/img/logo.png">
    <title>Romeo & Julieta</title>
     <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/mainprincipal.css">
    <link rel="stylesheet" href="<?= media(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= media(); ?>/css/baguetteBox.min.css">
    <link rel="stylesheet" href="<?= media(); ?>/css/smoothproducts.min.css">
    <link rel="stylesheet" href="<?= media(); ?>/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">

    <link href="<?= media(); ?>/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="<?= media(); ?>/fontawesome/css/brands.css" rel="stylesheet">
    <link href="<?= media(); ?>/fontawesome/css/solid.css" rel="stylesheet">

</head>

<body>
 
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">

        <div class="container">
        <a class="navbar-brand logo" href="<?= base_url(); ?>">
                <img class="mx-auto d-block img-logo" src="Assets/img/logo.png" alt="Slide Image">
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="<?= base_url(); ?>">Inicio</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="<?= base_url(); ?>/nosotros">Nosotros</a></li>
                    <!--<li class="nav-item" role="presentation"><a class="nav-link" href="<?= base_url(); ?>/ofertas">Ofertas</a></li>-->
                    <!--<li class="nav-item" role="presentation"><a class="nav-link" href="<?= base_url(); ?>/catalogo">Recientes</a></li>-->
                    <li class="nav-item" role="presentation"><a class="nav-link" href="<?= base_url(); ?>/catalogo">Catalogo</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="<?= base_url(); ?>/carrito">Carrito</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="<?= base_url(); ?>/contacto">Contacto</a></li>

                    <li class="nav-item" role="presentation"><a style="border-radius: 900px !important;" class="btn btn-sm btn-info" href="<?= base_url(); ?>/login"><?= $data['logincontentdata'] ?></a></li>

                    <?php
                    
                    if(empty( $_SESSION['login'])){
                        ?>
                        <li class="nav-item" role="presentation"><a style="border-radius: 900px !important;" class="btn btn-sm btn-info" href="<?= base_url(); ?>/registrarse">Registrarse</a></li>
      
                        <?php
                        }
                    ?>  <br>  
                    
                </ul>
            </div>
        </div>
    </nav>