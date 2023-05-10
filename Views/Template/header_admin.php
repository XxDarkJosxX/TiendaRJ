<!DOCTYPE html>
<html lang="es">
  <head>

    <meta name="description" content="Tienda Virtual Romeo y Julieta">  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#008688">
    <link rel="shortcut icon" href="<?= media();?>/img/logo.png">
    <title><?= $data['page_title']?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <link href="<?= media(); ?>/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="<?= media(); ?>/fontawesome/css/brands.css" rel="stylesheet">
    <link href="<?= media(); ?>/fontawesome/css/solid.css" rel="stylesheet">
    <!-- Font-icon css-->

  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?= base_url()?>/dashboard">Romeo & Julieta</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fa-solid fa-bars"></i></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
      
       
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <!--<li><a class="dropdown-item" href="<?= base_url()?>/opciones"><i class="fa fa-cog fa-lg"></i> Opciones</a></li>-->
            <li style="margin-top: 10px !important;"><a class="dropdown-item" href="<?= base_url()?>/usuarios/perfil"><i class="app-menu__icon fa-solid fa-user-pen"></i>Perfil</a></li>
            <li><a class="dropdown-item" href="<?= base_url()?>/logout"><i class="app-menu__icon fa-solid fa-right-from-bracket"></i>Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>


    <?php require_once("nav_admin.php") ?>