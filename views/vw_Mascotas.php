<?php require_once('../views/vw_Menu.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php echo $alerta; ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mascotas</h1>
    <p class="mb-4">A continuación encontrará el formulario para administrar los mascotas. Podrá registrar los mascotas 
        diligenciando el formulario y haciendo clic en "Guardar datos". Para modificar o eliminar mascotas podrá realizarlo 
        en la tabla inferior.</p>
    
    <!-- Formulario  -->
    <form class="user" role="form" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control form-control-user" id="txt_Id" name="txt_Id"
                placeholder="Id" value="<?php echo $id; ?>">
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" id="txt_Nombre" name="txt_Nombre" required
                    placeholder="Nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" id="txt_Raza" name="txt_Raza" required
                    placeholder="Raza" value="<?php echo $raza; ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="number" class="form-control form-control-user" id="txt_Edad" name="txt_Edad" required
                    placeholder="Edad" value="<?php echo $edad; ?>">
            </div>
            <div class="col-sm-6">
                <input type="number" class="form-control form-control-user" id="txt_Peso" name="txt_Peso" required
                    placeholder="Peso" value="<?php echo $peso; ?>">
            </div>
        </div>
        <div class="form-group">
            <select class="form-select form-control-user col-lg-12" id="lov_Cliente_Id" name="lov_Cliente_Id" required
                placeholder="Cliente">
                <?php echo $lov_clientes; ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-select form-control-user col-lg-12" id="lov_Medicamento_Id" name="lov_Medicamento_Id" required
                placeholder="Medicamento">
                <?php echo $lov_medicamentos; ?>
            </select>
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
            <h6 class="m-0 font-weight-bold text-primary">Mascotas</h6>
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