<!-- Modal -->
<div class="modal fade" id="modalformproducts" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerregister"> 
        <h5 class="modal-title" id="titlemodal">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   
              <form autocomplete="off" class="form-horizontal" id="formproducts" name="formproducts" enctype="multipart/form-data" >
              <input id="idproducto" name="idproducto" type="hidden" value="">
                <p class="text-primary">Todos los campos son obligatorios.</p>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label class="control-label">Nombre</label>
                    <input class="form-control" id="txtnombre" name="txtnombre" type="text" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" placeholder="Nombre del producto" required="">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label">Categoria</label>
                    <select class="form-control" data-live-search="true" id="txtcategoria"  name="txtcategoria" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" placeholder="Categoria">

                    </select>
                  </div>
                </div>

                
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label class="control-label">Descripcion</label>
                    <textarea class="form-control" id="txtdescripcion" name="txtdescripcion" minlength="2" pattern="[a-zA-Z ]{2,20}" rows="2" placeholder="Descripcion de Producto"></textarea>
                  </div>
                </div>
                

                <div class="form-row">
                  <div class="form-group mb-3 col-md-6">

                      <label class="form-label" for="txtimagen">Escoger Archivo</label>
                      <input  class="form-control" type="file" id="txtimagen" name="txtimagen">

                    </div>

                    <div class="form-group col-md-6">
                      <label for="exampleSelect1">Estado</label>
                      <select class="form-control" id="liststatus" name="liststatus" placeholder="Estado">
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                        
                      </select>
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



<!-- Modal -->
<div class="modal fade" id="modalformtallas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerregister">
        <h5 class="modal-title" id="titlemodal">Asignar Talla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formtallas" name="formtallas" enctype="multipart/form-data">
          <input id="idproductotalla" name="idproductotalla" type="hidden" value="">


       
          <div class="form-row">
            <div class="form-group col-md-4">
              <label class="control-label">Talla</label>
            </div>
            <div class="form-group col-md-4">
              <label class="control-label">Precio</label>
           </div>
            <div class="form-group col-md-4">
              <label class="control-label">Cantidad En Stock</label>
            </div>
          </div>
       
          <div class="inputsform">
          
          

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