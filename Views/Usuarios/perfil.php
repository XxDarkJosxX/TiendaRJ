<?php 
  headeradmin($data);
  getmodal('modalperfil',$data);
?>
<main class="app-content">
      <div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="<?= media(); ?>/Images/UserIcon.png"  >
              <h4><?= $_SESSION['userdata']['Nombre'].' '.$_SESSION['userdata']['Apellido'] ?></h4>
              <p><?= $_SESSION['userdata']['Tipo'] ?></p>
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Datos Personales</a></li>
              <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Datos Fiscales</a></li>
              <li class="nav-item"><a class="nav-link" href="#user-password" data-toggle="tab">Cambiar Contraseña</a></li>
           
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">

            <div class="tab-pane active" id="user-timeline">
              <div class="timeline-post" style="margin-bottom:0px !important">
                <div class="post-media">
                  <div class="content">
                    <h5>Datos Personales <button class="btn btn-sm btn-info" style="margin-left: 20px;" type="button" onclick="openmodalperfil();"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button> </h5>
                  </div>
                </div>
                    <table class="table table-bordered">
                    <tbody>
                        <tr>
                        <td style="width:150px;">Identificación:</td>
                        <td><?= $_SESSION['userdata']['ci']; ?></td>
                        </tr>
                        <tr>
                        <td>Nombres:</td>
                        <td ><?= $_SESSION['userdata']['Nombre']; ?></td>
                        </tr>
                        <tr>
                        <td>Apellidos:</td>
                        <td><?= $_SESSION['userdata']['Apellido']; ?></td>
                        </tr>
                        <tr>
                        <td>Teléfono:</td>
                        <td><?= $_SESSION['userdata']['Telefono']; ?></td>
                        </tr>
                        <tr>
                        <td>Email (Usuario):</td>
                        <td><?= $_SESSION['userdata']['Correo']; ?></td>
                        </tr>
                    </tbody>
                    </table>
              </div>
            </div>

            <div class="tab-pane fade" id="user-settings">
              <div class="tile user-settings">
                <h4 class="line-head">Datos Fiscales</h4>
                    <form id="formdatafiscal" name="formdatafiscal">
                        <div class="row mb-4">
                            <div class="col-md-6">

                            
                            <label>Identificación Tributaria</label>
                            <input class="form-control" type="text" id="txtnit" name="txtnit" value="<?= $_SESSION['userdata']['Nit']; ?>" placeholder="Número de Identifican Tributaria">
                            </div>
                            <div class="col-md-6">
                            <label>Nombre fiscal</label>
                            <input class="form-control" type="text" id="txtnombrefiscal" name="txtnombrefiscal" value="<?= $_SESSION['userdata']['NombreFiscal']; ?>" placeholder="Nombre Tributario">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                            <label>Dirección fiscal</label>
                            <input class="form-control" type="text" id="txtdireccion" name="txtdireccion" value="<?= $_SESSION['userdata']['Direccion']; ?>">
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-md-12">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
                            </div>
                        </div>
                    </form>
              </div>
            </div>

            <div class="tab-pane fade" id="user-password">
              <div class="tile user-settings">
                <h4 class="line-head">Solicitud de Cambio de Contraseña</h4>
                    <form id="formresetpassword" name="formresetpassword">
                        <div class="row mb-4">
                            <div class="col-md-6">
                            <label>Email</label>
                            <input class="form-control" type="text" id="txtemailreset" name="txtemailreset" value="<?= $_SESSION['userdata']['Correo']; ?>" disabled>
                            </div>
                         
                        </div>
                        <div class="row mb-10">
                            <div class="col-md-12">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Soliciar Cambio</button>
                            </div>
                        </div>
                    </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>

<?php 
  footeradmin($data);
?>