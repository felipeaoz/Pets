<?php require_once('../views/vw_Menu.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php echo $alerta; ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Medicamentos</h1>
    <p class="mb-4">A continuación encontrará el formulario para administrar los medicamentos. Podrá registrar los medicamentos 
        diligenciando el formulario y haciendo clic en "Guardar datos". Para modificar o eliminar medicamentos podrá realizarlo 
        en la tabla inferior.</p>
    
    <!-- Formulario  -->
    <form class="user" role="form" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control form-control-user" id="txt_Id" name="txt_Id"
                placeholder="Id" value="<?php echo $id; ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="txt_Nombre" name="txt_Nombre" required
                placeholder="Nombre" value="<?php echo $nombre; ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="txt_Descripcion" name="txt_Descripcion" required
                placeholder="Descripción" value="<?php echo $descripcion; ?>">
        </div>
        <div class="form-group">
            <input type="number" class="form-control form-control-user" id="txt_Dosis" name="txt_Dosis" required
                placeholder="Dosis" value="<?php echo $dosis; ?>">
        </div>
        <button type="submit" id="<?php echo $boton_Guardar; ?>" name="<?php echo $boton_Guardar; ?>" class="btn btn-primary btn-user btn-block">
            Guardar datos
        </button>
        <hr>
    </form>
    <!-- Fin Formulario  -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Medicamentos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" name="dataTable" width="100%" cellspacing="0">
                    <?php echo $tabla; ?>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php require_once('../views/vw_Footer.php'); ?>