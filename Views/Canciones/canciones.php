<?php 
    headerAdmin($data); 
    getModal('modalCanciones',$data);
?>
    <div id="contentAjax"></div> 
    <main class="app-content">
     <!--  <div class="app-title">
        
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
        </ul>
      </div> -->

        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                      <div>
                          <h1><i class="fas fa-user-tag"></i> 
                              <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Agregar</button>
                          </h1>
                      </div>
                        <table  id="tablecan"
                                data-show-columns="true"
                                data-height="460">
                        </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
<?php footerAdmin($data); ?>