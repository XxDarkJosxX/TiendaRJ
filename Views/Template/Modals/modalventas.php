<!-- Modal -->
<div class="modal fade" id="modalformventas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerregister">
        <h5 class="modal-title" id="titlemodal">Nueva Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form autocomplete="off" class="form-horizontal" id="formventas" name="formventas" enctype="multipart/form-data">

          <p class="text-primary">Todos los campos son obligatorios.</p>
          <input type="hidden" disabled id="txtidcliente" name="txtidcliente">

          <div class="form-row ">
            <div class="form-group col-md-6">
              <label class="control-label">Usuario</label>
              <select class="form-control" data-live-search="true" id="txtcliente" placeholder="Seleccionar" name="txtcliente" placeholder="Clientes"></select>
              <br><br>
              <label class="control-label">Tallas</label>
              <select class="form-control" data-live-search="true" id="txttalla" placeholder="Seleccionar" name="txttalla" placeholder="Tallas">
              </select><br><br>

              <label class="control-label">Fecha</label>
              <input type="date" class="form-control" value="<?php $fechahoy = date('Y-m-d');
                                                              echo $fechahoy; ?>" disabled id="txtfecha" name="txtfecha" placeholder="Fecha">

              <br>
              <label class="control-label">Total</label>
              <input type="text" class="form-control txttotal" disabled id="txttotal" name="txttotal" placeholder="0">
              <br>
              <input type="button" name="limpiar" class="btn btn-info btn-block my-2" value="Limpiar">
            </div>


            <div class="form-group col-md-6">
              <label class="control-label">Productos</label>
              <select class="form-control" data-live-search="true" id="txtproducto" placeholder="Seleccionar" name="txtproducto" minlength="2" placeholder="Productos">
              </select>
              <br><br>

              <label class="control-label">Precio</label>
              <input type="number" class="form-control txtprecio" disabled id="txtprecio" name="txtprecio" placeholder="0">
              <br>
              <label class="control-label">Descuento</label>
              <input type="number" class="form-control" disabled id="txtdescuento" name="txtdescuento" placeholder="Descuento">
        
              <input type="button" id="btnaddcarrito" name="btnaddcarrito" class="btn btn-success btn-block my-5 btnaddcarrito" value="Agregar">

            </div>

          </div>



          <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table style="width: 100% !important;" class="table table-hover table-bordered text-center" id="tablecarritoventa">
                      <thead>
                        <tr>
                          <th>Id</th>
                      
                          <th>Nombre</th>
                          <th>Precio</th>
                          <th>Talla</th>
                          <th>Cantidad</th>
                         
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



<div class="modal fade" id="modalviewdetventas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog  modal-lg" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header headerregister">
        <h5 class="modal-title" id="titlemodal">Datos del Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table style="width: 100% !important;" class="table table-hover table-bordered text-center" id="tabledetalleventas">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Producto</th>
                          <th>Cantidad</th>
                          <th>Descuento</th>
                          <th>Sub Total</th>
                       
                          
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
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalformventaenvio" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerregister modalventa"> 
        <h5 class="modal-title" id="titlemodalventa"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tile">
           
            <div class="tile-body">
              <form id="formestadoventa" name="formestadoventa">
              <input id="idventa" name="idventa" type="hidden" value="">
         
                
                <div class="form-group">
                    <label for="exampleSelect1">Estado del Pedido</label>
                    <select class="form-control" id="liststatusventa" name="liststatusventa" placeholder="Estado">
                      <option value="1">Compra Finalizada</option>
                      <option value="0">Procesando Compra</option>
                      
                    </select>
                </div>
                <div class="tile-footer">
                    <button id="btnactionform" class="btn btn-primary btnventa" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btntextventa">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
            
          </div>
      </div>
      
    </div>
  </div>
</div>

