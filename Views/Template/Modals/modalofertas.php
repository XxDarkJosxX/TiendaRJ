<!-- Modal -->

<div class="modal fade" id="modalformofertas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerregister">
        <h5 class="modal-title" id="titlemodal">Nueva Oferta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formofertas" name="formofertas" enctype="multipart/form-data">
          <input class="d-none" id="idoferta" name="idoferta" type="hidden" value="0">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Producto</label>
              <select class="form-control" data-live-search="true" id="txtproducto" name="txtproducto" placeholder="Producto">
              </select>
              <small class="text-danger d-none" id="validateproducto"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Porcentaje</label>
              <input type="number" class="form-control" id="txtporcentaje" name="txtporcentaje" minlength="1" maxlength="3" onkeypress="return validateNumber(event)" placeholder="Porcentaje de oferta">
              <small class="text-danger d-none" id="validateporcentaje"></small>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Fecha Inicio</label>
              <input type="date" class="form-control" id="txtfechaini" name="txtfechaini" value="<?php echo date("Y-m-d"); ?>" readonly>
              <small class="text-danger d-none" id="validatefechaini"></small>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Fecha Final</label>
              <input type="date" class="form-control" id="txtfechafin" name="txtfechafin" min="<?php echo date("Y-m-d"); ?>">
              <small class="text-danger d-none" id="validatefechafin"></small>
            </div>
          </div>
          <div class="form-row" id="selected">
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