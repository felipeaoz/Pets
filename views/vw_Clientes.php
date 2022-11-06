<?php require_once('../views/vw_Menu.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php echo $alerta; ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
    <p class="mb-4">A continuación encontrará el formulario para administrar los clientes. Podrá registrar los clientes 
        diligenciando el formulario y haciendo clic en "Guardar datos". Para modificar o eliminar clientes podrá realizarlo 
        en la tabla inferior.</p>
    
    <!-- Formulario  -->
    <form class="user" role="form" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control form-control-user" id="txt_Id" name="txt_Id"
                placeholder="Id" value="<?php echo $id; ?>">
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" id="txt_Nombres" name="txt_Nombres" required
                    placeholder="Nombres" value="<?php echo $nombres; ?>">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" id="txt_Apellidos" name="txt_Apellidos" required
                    placeholder="Apellidos" value="<?php echo $apellidos; ?>">
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="txt_Direccion" name="txt_Direccion" required
                placeholder="Dirección" value="<?php echo $direccion; ?>">
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" id="txt_Telefono" name="txt_Telefono" required
                    placeholder="Teléfono" value="<?php echo $telefono; ?>">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" id="txt_Cedula" name="txt_Cedula" required
                    placeholder="Cédula" value="<?php echo $cedula; ?>">
            </div>
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
            <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
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