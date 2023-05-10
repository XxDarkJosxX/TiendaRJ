<!-- Modal -->
<div class="modal fade" id="modalformusuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerregister">
        <h5 class="modal-title" id="titlemodal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form autocomplete="off" class="form-horizontal" id="formusuarios" name="formusuarios" enctype="multipart/form-data">
          <input id="idusuario" name="idusuario" type="hidden" value="">
          <p class="text-primary">Todos los campos son obligatorios.</p>

          <div class="form-row">
         
            <div class="form-group col-md-6">
              <label class="control-label">Cedula de Identidad </label>
              <input class="form-control" id="txtci" name="txtci"  type="text" placeholder="Cedula de Identidad" required="">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">NIT</label>
              <input class="form-control" id="txtnit" name="txtnit"  type="text" placeholder="NIT">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label class="control-label">Nombre</label>
              <input class="form-control" id="txtnombre" name="txtnombre" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" type="text" placeholder="Nombre del Usuario" required="">
            </div>
            <div class="form-group col-md-4">
              <label class="control-label">Apellidos</label>
              <input class="form-control" id="txtapellido" name="txtapellido" minlength="4" maxlength="20" pattern="[a-zA-Z ]{4,20}" type="text" placeholder="Apellido del Usuario" required="">
            </div>
            <div class="form-group col-md-4">
              <label class="control-label">Correo</label>
              <input type="text" class="form-control" id="txtcorreo" name="txtcorreo" minlength="8" maxlength="50" pattern="[a-zA-Z0-9$@.-]{8,50}" placeholder="Correo" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Direccion</label>
              <input class="form-control" id="txtdireccion" name="txtdireccion"  type="text" placeholder="Direccion" >
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Numero telefonico</label>
              <input class="form-control" id="txttelefono" name="txttelefono"  type="text" placeholder="Numero de Celular" required="">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Nombre tributario</label>
              <input class="form-control" id="txtnombretributario" name="txtnombretributario"  type="text" placeholder="Nombre Tributario">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Rol</label>
              <select class="form-control" data-live-search="true" id="txtrol" name="txtrol" placeholder="Rol">
              </select>
            </div>
           
          </div>

          <div class="form-row">
             <div class="form-group col-md-6">
              <label class="control-label">Contraseña</label>
              <input type="text" class="form-control" id="txtcontrasenia" name="txtcontrasenia" minlength="8" maxlength="20" pattern="[a-zA-Z0-9@.-]{8,20}" placeholder="Contraseña">
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelect1">Estado</label>
              <select class="form-control" id="liststatus" name="liststatus" placeholder="Estado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>
          </div><br>
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





<!-- Modal -->
<div class="modal fade" id="modalviewuser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header headerregister">
        <h5 class="modal-title" id="titlemodal">Datos del Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Identificación:</td>
              <td id="celIdentificacion">Pendiente</td>
            </tr>
          
            <tr>
              <td>Nombres:</td>
              <td id="celNombre">Pendiente</td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celApellido">Pendiente</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celTelefono">Pendiente</td>
            </tr>
            <tr>
              <td>Email (Usuario):</td>
              <td id="celEmail">Pendiente</td>
            </tr>
            <tr>
              <td>Direccion:</td>
              <td id="celDireccion">Pendiente</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado">Pendiente</td>
            </tr>
            <tr>
              <td>Nit:</td>
              <td id="celNit">Pendiente</td>
            </tr>
            <tr>
              <td>Nombre Fiscal:</td>
              <td id="celNombrefiscal">Pendiente</td>
            </tr>
          
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  </div>
</div>

