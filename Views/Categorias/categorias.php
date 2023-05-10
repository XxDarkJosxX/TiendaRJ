<?php 
  headeradmin($data);
  getmodal('modalcategorias',$data);
?>
   
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="panelspace fa-solid fa-table-list"></i><?= $data['page_title']?>
          <?php  if($_SESSION['permisosmod']['w']){ ?>
            <button class="btn btn-primary btn-sm btnresponceadd" type="button" onclick="openmodal()" >Nuevo</button>
            <?php } ?>
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
                <table class="table table-hover table-bordered" id="tablecategorias">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Estatus</th>
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
   