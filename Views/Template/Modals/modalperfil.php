<div class="modal fade" id="modalformperfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerupdate">
        <h5 class="modal-title" id="titlemodal">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formperfil" name="formperfil" enctype="multipart/form-data">
         
          <p class="text-primary">Todos los campos son obligatorios.</p>

          <div class="form-row">
         
            <div class="form-group col-md-6">
              <label class="control-label">Cedula de Identidad </label>
              <input value="<?= $_SESSION['userdata']['ci']; ?>" class="form-control" id="txtci" name="txtci"  type="text" placeholder="Cedula de Identidad" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Nombre</label>
              <input value="<?= $_SESSION['userdata']['Nombre']; ?>" class="form-control" id="txtnombre" name="txtnombre" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" type="text" placeholder="Nombre del Usuario" required="">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Apellidos</label>
              <input value="<?= $_SESSION['userdata']['Apellido']; ?>" class="form-control" id="txtapellido" name="txtapellido" minlength="4" maxlength="20" pattern="[a-zA-Z ]{4,20}" type="text" placeholder="Apellido del Usuario" required="">
            </div>
          
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Correo</label>
              <input value="<?= $_SESSION['userdata']['Correo']; ?>" type="text" class="form-control" id="txtcorreo" name="txtcorreo" minlength="8" maxlength="50" pattern="[a-zA-Z0-9$@.-]{8,50}" placeholder="Correo" required="" readonly disabled>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Numero telefonico</label>
              <input value="<?= $_SESSION['userdata']['Telefono']; ?>" class="form-control" id="txttelefono" name="txttelefono"  type="text" placeholder="Numero de Celular" >
            </div>
          </div>

        

         <br>
          <div class="tile-footer">
            <button id="btnactionform" class="btn btn-primary" type="submit">
              <i class="fa fa-fw fa-lg fa-check-circle"></i>
              <span id="btntext">Guardar</span>
            </button>&nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="#" data-dismiss="modal">
              <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>
