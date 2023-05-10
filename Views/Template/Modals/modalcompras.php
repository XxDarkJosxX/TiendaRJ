<!-- Modal -->
<div class="modal fade" id="modalformcompra" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerregister">
        <h5 class="modal-title" id="titlemodal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formcompras" name="formcompras">
          <input id="idcompra" name="idcompra" type="hidden" value="">
          <p class="text-primary">Todos los campos son obligatorios.</p>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Usuario</label>
              <input class="form-control" id="idusuario" name="idusuario"  type="text" required="" disabled>
          
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Proveedor</label>
              <select class="form-control" data-live-search="true" id="idproveedor" name="idproveedor" placeholder="Proveedor">
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Materia Prima</label>
              <select class="form-control" data-live-search="true" id="idmateriapr" name="idmateriapr" placeholder="Materia Prima">
              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Total</label>
              <input class="form-control" id="txttotal" name="txttotal" type="text" placeholder="Total" required="">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Fecha</label>
              <input type="date" class="form-control" value="<?php $fechahoy = date('Y-m-d');
                                                              echo $fechahoy; ?>" disabled id="txtfecha" name="txtfecha" placeholder="Fecha">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Descripcion</label>
              <textarea class="form-control" id="txtdescripcion" name="txtdescripcion" minlength="2" pattern="[a-zA-Z ]{2,20}" rows="2" placeholder="Descripcion de Producto"></textarea>
            </div>

            <div class="form-group col-md-6">
              <label for="exampleSelect1">Estado</label>
              <select class="form-control" id="liststatus" name="liststatus" placeholder="Estado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>
          </div>

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