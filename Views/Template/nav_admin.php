<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/Images/UserIcon.png" width="50px" height="50px" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userdata']['Nombre'] ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userdata']['Tipo'] ?></p>
        </div>
      </div>
      
      <ul class="app-menu">

        <?php if(!empty($_SESSION['permisos'][1]['r']) ){?>
        <li>
          <a class="app-menu__item" href="<?= base_url()?>/dashboard"><i class="app-menu__icon fa-solid fa-chart-pie"></i><span class="app-menu__label">Dashboard</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(!empty($_SESSION['permisos'][2]['r']) || !empty($_SESSION['permisos'][6]['r']) ){?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa-solid fa-users-gear"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa-solid fa-caret-right"></i></a>
          <ul class="treeview-menu">
            <?php if(!empty($_SESSION['permisos'][2]['r'])) { ?>
            <li><a class="treeview-item" href="<?= base_url()?>/usuarios"><i class="app-menu__icon fa-solid fa-users-gear"></i>Usuarios</a></li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][6]['r'])) { ?>
            <li><a class="treeview-item" href="<?= base_url()?>/roles"><i class="app-menu__icon fa-regular fa-id-card"></i>Roles</a></li>
            <?php } ?>
            <!--<li><a class="treeview-item" href="<?= base_url()?>/permisos"><i class="icon fa fa-circle-o"></i> Permisos</a></li>-->
          </ul>
        </li>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][3]['r'])){?>
        <li>
          <a class="app-menu__item" href="<?= base_url()?>/clientes">
          <i class="app-menu__icon fa-solid fa-users"></i>
          <span class="app-menu__label">Clientes</span>
          </a>
        </li>

        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][7]['r'])  || !empty($_SESSION['permisos'][13]['r']) ){?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa-solid fa-shirt"></i><span class="app-menu__label">Productos</span><i class="treeview-indicator fa-solid fa-caret-right"></i></a>
          <ul class="treeview-menu">
            <?php if(!empty($_SESSION['permisos'][7]['r'])) { ?>
            <li><a class="treeview-item" href="<?= base_url()?>/categorias"><i class="app-menu__icon fa-solid fa-table-list"></i>Categorias</a></li>
            <?php } ?>
            <?php if(!empty($_SESSION['permisos'][4]['r'])) { ?>
            <li><a class="treeview-item" href="<?= base_url()?>/productos"><i class="app-menu__icon fa-solid fa-shirt"></i> Productos</a></li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][13]['r'])) { ?>
            <li><a class="treeview-item" href="<?=base_url()?>/ofertas"><i class="app-menu__icon fa-solid fa-hand-holding-dollar"></i>Ofertas</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][8]['r']) || !empty($_SESSION['permisos'][9]['r']) || !empty($_SESSION['permisos'][10]['r'])){?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa-solid fa-keyboard"></i><span class="app-menu__label">Inventario</span><i class="treeview-indicator fa-solid fa-caret-right"></i></a>
          <ul class="treeview-menu">
            <?php if(!empty($_SESSION['permisos'][8]['r'])) { ?>
            <li><a class="treeview-item" href="<?= base_url()?>/proveedores"><i class="app-menu__icon fa-solid fa-user-tag"></i>Proveedores</a></li>
            <?php } ?>
            <?php if(!empty($_SESSION['permisos'][9]['r'])) { ?>
            <li><a class="treeview-item" href="<?= base_url()?>/materiales"><i class="app-menu__icon fa-solid fa-bangladeshi-taka-sign"></i> Materiales</a></li>
            <?php } ?>
            <?php if(!empty($_SESSION['permisos'][10]['r'])) { ?>
            <li><a class="treeview-item" href="<?= base_url()?>/compras"><i class="app-menu__icon fa-solid fa-bag-shopping"></i>Compras</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][11]['r'])) { ?>
        <li>
          <a class="app-menu__item" href="<?= base_url()?>/ventas">
          <i class="app-menu__icon fa-solid fa-cart-shopping"></i><span class="app-menu__label">Ventas</span>
          </a>
        </li> 
        <?php } ?> 
        
        <?php if(!empty($_SESSION['permisos'][12]['r'])) { ?>
        <li>
          <a class="app-menu__item" href="<?= base_url()?>/contratos">
          <i class="app-menu__icon fa-solid fa-file-pdf"></i><span class="app-menu__label">Contratos</span>
          </a>
        </li>
        <?php } ?> 

        <li>
          <a class="app-menu__item" href="<?= base_url()?>/pedidos">
          <i class="app-menu__icon fa-solid fa-tags"></i><span class="app-menu__label">Pedidos</span>
          </a>
        </li>

      

        <li>
          <a class="app-menu__item" href="<?= base_url()?>">
          <i class="app-menu__icon fa-solid fa-right-from-bracket"></i><span class="app-menu__label">Volver</span>
          </a>
        </li>
      </ul>
    </aside>