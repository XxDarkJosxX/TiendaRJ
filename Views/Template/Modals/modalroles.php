<!-- Modal -->
<div class="modal fade" id="modalformrol" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerregister"> 
        <h5 class="modal-title" id="titlemodal">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tile">
           
            <div class="tile-body">
              <form id="formrol" name="formrol">
              <input id="idrol" name="idrol" type="hidden" value="">
                
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" id="txtnombre" name="txtnombre" type="text" placeholder="Nombre del Rol" required="">
                </div>
         
                <div class="form-group">
                  <label class="control-label">Descripcion</label>
                  <textarea class="form-control" id="txtdescripcion" name="txtdescripcion" rows="2" placeholder="Descripcion de Rol"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="liststatus" name="liststatus" placeholder="Estado">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                      
                    </select>
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

