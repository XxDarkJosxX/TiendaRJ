<?php 
  headeradmin($data);
  getmodal('modalventas',$data);
?>
   
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?= $data['page_title']?>
          <?php  if($_SESSION['permisosmod']['w']){ ?>
            <button class="btn btn-primary btn-sm" type="button" onclick="openmodal()" style="margin-left: 20px;" >nuevo
            </button>    <?php } ?>
          </h1>
      
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#"> <?= $data['page_tag']?></a></li>
        </ul>
      </div>
      <div class="row">   
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body"><?= $data['page_title']?></div>
            
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableventas">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Cliente</th>
                      <th>Empleado</th>
                      <th>Fecha</th>
                      <th>Metodo de Pago</th>
                      <th>Cantidad Total</th>
                      <th>Precio Total</th>
                      <th>Estado de Venta</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    

    </main>

<?php 
  footeradmin($data);
?>