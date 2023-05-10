<?php 
  headeradmin($data);
 
?>
   
    <main class="app-content">
      <div class="app-title">
        <div>
        <h1><i class="panelspace fa-solid fa-gauge-simple-high"></i><?= $data['page_title']?>
  
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#"><?= $data['page_title']?></a></li>
        </ul>
      </div>
      
      <div class="row">
      
      
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/pedidos" class="linkw">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
              <div class="info">
                <h4>Pedidos</h4>
                <p><b><?= $data['pedidos'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
    
      </div>



      <div class="row">
        <div class="col-md-9">
          <div class="tile">
            <h3 class="tile-title">Últimos Pedidos</h3>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Empleado</th>
                  <th>Estado</th>
                  <th>Cantidad Total</th>
                  <th class="text-right">Monto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    if(count($data['lastOrders']) > 0 ){
                      foreach ($data['lastOrders'] as $pedido) {
                 ?>
                <tr>
                  <td><?= $pedido['IdVenta'] ?></td>
                  <td><?= $pedido['nombre'] ?></td>
                  <td>
                    <?php if($pedido['nombree'] != null){
                      echo $pedido['nombree'];
                    }else{
                      echo "Sin Participación";
                    } 
                    ?>
                  </td>
                  <td>
                    <?php if($pedido['Estado'] == 1){
                      echo '<span class="badge badge-pill badge-success">Envio Confirmado</span>';
                    }else{
                      echo '<span class="badge badge-pill badge-danger">Procesando Envio</span>';
                    } 
                    ?>
                  </td>
                  <td class="text-center"><?= $pedido['CantidadTotal'] ?></td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($pedido['Total']) ?></td>
                 
                </tr>
                <?php } 
                  } ?>

              </tbody>
            </table>
          </div>
        </div>
   

        
      </div>


    </main>

<?php 
  footeradmin($data);
?>
   