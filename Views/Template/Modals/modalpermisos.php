<div class="modal fade" id="modalpermisos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerregister"> 
        <h5 class="modal-title" id="titlemodal">Permisos de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      
      <div class="col-md-12">
          <div class="tile">
            <form action="" id="formpermisos" name="formpermisos">
            <h3 class="tile-title">Responsive Table</h3>

            <input type="hidden" id="idrol" name="idrol" value="<?= $data['IdRol']; ?>" required>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Modulo</th>
                    <th>Leer</th>
                    <th>Escribir</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                    $no=1;
                    $modulos=$data['modulos'];
                    for($i=0;$i< count($modulos);$i++){
                        $permisos=$modulos[$i]['permisos'];
                        $rcheck= $permisos['r'] == 1 ? " checked " :"";
                        $wcheck= $permisos['w'] == 1 ? " checked " :"";
                        $ucheck= $permisos['u'] == 1 ? " checked " :"";
                        $dcheck= $permisos['d'] == 1 ? " checked " :"";
                        $idmod=$modulos[$i]['IdModulo'];
                    
                  ?>

                  <tr>
                    <td >
                        <?= $no; ?>
                        <input type="hidden" name="modulos[<?=$i;?>][IdModulo]" value="<?=$idmod;?>" required>
                    </td>
                    <td>
                        <?= $modulos[$i]['Nombre']; ?>
                    </td>
                    <td>
                      <div class="toggle-flip">
                        <label>
                          <input type="checkbox" name="modulos[<?=$i;?>][r]" <?= $rcheck ?> ><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="toggle-flip">
                        <label>
                          <input type="checkbox" name="modulos[<?=$i;?>][w]"  <?= $wcheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="toggle-flip">
                        <label>
                          <input type="checkbox" name="modulos[<?=$i;?>][u]"  <?= $ucheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="toggle-flip">
                        <label>
                          <input type="checkbox" name="modulos[<?=$i;?>][d]"  <?= $dcheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                        </label>
                      </div>
                    </td>
                  </tr>
                  <?php
                  $no++;
                }?>
                </tbody>
              </table>
            </div>

            <div class="text-center">
                <button id="btnactionform" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i><span id="btntext">Guardar</span></button>
                <button id="btnactionform" class="btn btn-danger" type="button" data-dismiss="modal"><i class="app-menu__icon fas fa-sign-out-alt" aria-hidden="true"></i><span id="btntext">Salir</span></button>
            </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>