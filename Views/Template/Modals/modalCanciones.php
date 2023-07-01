<!-- Modal -->
<div class="modal fade" id="modalFormRol" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Cancion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formCancion" name="formCan">
                <input type="hidden" id="idCan" name="idCan" value="">
                <div class="form-group">
                  <label class="control-label">Cancion</label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="nombre de la cancion" required="">
                </div>

                <div class="form-group">
                <label class="control-label">Genero</label>
                <select id="txtidGenero" name="txtidGenero" class="form-select" aria-label="Default select example">
                <option selected>Seleccione Genero</option>
                <?php 
                  
                    $modulos = $data['generos'];?>
                    <?php
                    for ($i=0; $i < count($modulos); $i++) { 
                    echo '<option value="'.$modulos[$i]['idGenero'].'">'.$modulos[$i]['nombreGenero'].'</option>';

                   } 
                ?>
                </select>
                </div>

                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>