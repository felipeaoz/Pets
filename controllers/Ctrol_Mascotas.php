<?php 
include '../models/Mascota.php';
include '../models/Cliente.php';
include '../models/Medicamento.php';
session_start();
if(isset($_SESSION['usuario'])){
    $tabla = "";
    $alerta = "";
    $b_alerta = false;
    $mascota  = New Mascota();
    $cliente  = New Cliente();
    $medicamento  = New Medicamento();

    $id = null;
    $nombre = null;
    $raza = null;
    $edad = null;
    $peso = null;
    $cliente_id = null;
    $medicamento_id = null;
    $boton_Guardar = 'btn_Guardar';

    if(isset($_POST['btn_Guardar'])){
        
        $mascota->nombre = $_POST['txt_Nombre'];
        $mascota->raza = $_POST['txt_Raza'];
        $mascota->edad = $_POST['txt_Edad'];
        $mascota->peso = $_POST['txt_Peso'];
        $mascota->cliente_id = $_POST['lov_Cliente_Id'];
        $mascota->medicamento_id = $_POST['lov_Medicamento_Id'];

        $mascota_creada = $mascota::agregar($mascota);
        if($mascota_creada){
            $color = "success";
            $titulo = "Registro de mascota.";
            $mensaje = "Mascota registrada correctamente.";
            $b_alerta = true;
            
            //$_POST['btn_Buscar'] = '';
            //$_POST['txt_Id'] = $mascota_creada->id;

        }else{
            $color = "danger";
            $titulo = "Registro de mascota.";
            $mensaje = "Error al registrar la mascota.";
            $b_alerta = true;
        }
    }

    if(isset($_POST['btn_Eliminar'])){
        ;
        if($mascota::eliminar($_POST['txt_Id'])){
            $color = "warning";
            $titulo = "Eliminación de mascota.";
            $mensaje = "Mascota eliminada correctamente.";
            $b_alerta = true;
        }else{
            $color = "danger";
            $titulo = "Eliminación de mascota.";
            $mensaje = "No se pudo eliminar la mascota.";
            $b_alerta = true;
        }
    }

    if(isset($_POST['btn_Buscar'])){
        
        $mascota_seleccionada = $mascota::buscar_id($_POST['txt_Id']);
        $mascota_seleccionada->id;
        $id = $mascota_seleccionada->id;
        $nombre = $mascota_seleccionada->nombre;
        $raza = $mascota_seleccionada->raza;
        $edad = $mascota_seleccionada->edad;
        $peso = $mascota_seleccionada->peso;
        $cliente_id = $mascota_seleccionada->cliente_id;
        $medicamento_id = $mascota_seleccionada->medicamento_id;

        $boton_Guardar = 'btn_Modificar';
    }

    if(isset($_POST['btn_Modificar'])){
        
        $mascota->id = $_POST['txt_Id'];
        $mascota->nombre = $_POST['txt_Nombre'];
        $mascota->raza = $_POST['txt_Raza'];
        $mascota->edad = $_POST['txt_Edad'];
        $mascota->peso = $_POST['txt_Peso'];
        $mascota->cliente_id = $_POST['lov_Cliente_Id'];
        $mascota->medicamento_id = $_POST['lov_Medicamento_Id'];

        if($mascota::modificar($mascota)){
            $color = "success";
            $titulo = "Modificación de mascota.";
            $mensaje = "Mascota modificada correctamente.";
            $b_alerta = true;

        }else{
            $color = "danger";
            $titulo = "Modificación de mascota.";
            $mensaje = "Error al modificar la mascota, por favor verifique los datos.";
            $b_alerta = true;
        }
    }

    $mascotas = $mascota::listar();
    $tabla .= "<thead><tr><th>Nombre</th><th>Raza</th><th>Edad</th><th>Peso</th><th>Cliente</th><th>Medicamento y dosis</th><th>Acciones</th></tr></thead><tbody>";
    foreach($mascotas as $key => $value){
        $form_eliminar = "<form method=\"POST\" role=\"form\"><input type=\"hidden\" id=\"txt_Id\" name=\"txt_Id\" value=\"$value->id\"><button name=\"btn_Eliminar\" title=\"Eliminar mascota\"><i class=\"fas fa-trash\"></i></button></form>";
        $form_modificar = "<form method=\"POST\" role=\"form\"><input type=\"hidden\" id=\"txt_Id\" name=\"txt_Id\" value=\"$value->id\"><button name=\"btn_Buscar\" title=\"Modificar mascota\"><i class=\"fas fa-pen\"></i></button></form>";
        $tabla .= "<tr><td>$value->nombre</td><td>$value->raza</td><td>$value->edad</td><td>$value->peso</td><td>$value->cedula - $value->nombres $value->apellidos</td><td>$value->medicamento - $value->dosis</td><td><div class=\"row ml-1\">$form_modificar $form_eliminar</div></td></tr>";
    }
    $tabla .= "</tbody>";

    if($b_alerta){
        $alerta =  '<div class="row">
                        <div class="col-xl-3 col-md-6 mb-4 offset-xl-9 offset-md-6">
                            <div class="card border-left-'.$color.' shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-'.$color.' text-uppercase mb-1">
                                                '.$titulo .'</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">'.$mensaje.'</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
    }

    $clientes = $cliente::listar();
    $lov_clientes = "<option selected>Seleccione el cliente</option>";
    foreach($clientes as $key => $value){
        if($value->id == $cliente_id){
            $selected_cliente = 'selected';
        }else{
            $selected_cliente = '';
        }
        $lov_clientes .= "<option value=\"$value->id\" $selected_cliente>$value->cedula - $value->nombres $value->apellidos</option>";
    }

    $medicamentos = $medicamento::listar();
    $lov_medicamentos = "<option selected>Seleccione el medicamento</option>";
    foreach($medicamentos as $key => $value){
        if($value->id == $medicamento_id){
            $selected_medicamento = 'selected';
        }else{
            $selected_medicamento = '';
        }
        $lov_medicamentos .= "<option value=\"$value->id\" $selected_medicamento>$value->nombre - $value->dosis</option>";
    }
    include '../views/vw_Mascotas.php';
} else{
    header("Location: Ctrol_Login.php");
    exit();
}




?>