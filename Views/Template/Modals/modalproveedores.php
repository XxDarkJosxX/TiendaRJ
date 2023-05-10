<!-- Modal -->
<div class="modal fade" id="modalformproveedor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header headerregister">
        <h5 class="modal-title" id="titlemodal">Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="tile">
          <div class="tile-body">
            <form id="formproveedor" name="formproveedor">
              <div class="form-row">
                <input id="idproveedor" name="idproveedor" type="hidden" value="">

                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Nombre</label>
                  
                    <input class="form-control" id="txtnombre" name="txtnombre" type="text" placeholder="Nombre del Proveedor" required="">
                  
                </div>

                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Ciudad</label>
                  
                    <input class="form-control" id="txtciudad" name="txtciudad" type="text" placeholder="Ciudad del proveedor" required="">
                  
                </div>

                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Correo</label>
                  
                    <input class="form-control" id="txtcorreo" name="txtcorreo" type="text" placeholder="Correo del proveedor" required="">
                  
                </div>

                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Telefono</label>
                  
                    <input class="form-control" id="txttelefono" name="txttelefono" type="text" placeholder="Telf del proveedor" required="">
                  
                </div>

                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Departamento</label>
                  
                    <input class="form-control" id="txtpais" name="txtpais" type="text" placeholder="Pais del proveedor" required="">
                  
                </div>

                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Rubro</label>
                  
                    <input class="form-control" id="txtrubro" name="txtrubro" type="text" placeholder="Rubro del proveedor" required="">
                  
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Direccion</label>
                  
                    <input class="form-control" id="txtdireccion" name="txtdireccion" type="text" placeholder="Direccion del proveedor" required="">
                  
                </div>

                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Provincia</label>
                  
                    <input class="form-control" id="txtprovincia" name="txtprovincia" type="text" placeholder="Provincia del proveedor" required="">
                  
                </div>


                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label">Descripcion</label>
                  
                    <textarea class="form-control" id="txtdescripcion" name="txtdescripcion" rows="2" placeholder="Descripcion del proveedor"></textarea>
                  
                </div>

                <div class="form-group col-md-6">
                  <label class="col-sm-4 control-label" for="exampleSelect1">Estado</label>
                  
                    <select class="form-control" id="liststatus" name="liststatus" placeholder="Estado">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>

                    </select>
                  
                </div>
              </div>
              <div class="tile-footer">
                <button id="btnactionform" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btntext">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>