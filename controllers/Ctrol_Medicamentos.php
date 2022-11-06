<?php 
include '../models/Medicamento.php';
session_start();
if(isset($_SESSION['usuario'])){
    $tabla = "";
    $alerta = "";
    $b_alerta = false;
    $medicamento  = New Medicamento();

    $id = null;
    $nombre = null;
    $descripcion = null;
    $dosis = null;
    $boton_Guardar = 'btn_Guardar';

    if(isset($_POST['btn_Guardar'])){
        
        $medicamento->nombre = $_POST['txt_Nombre'];
        $medicamento->descripcion = $_POST['txt_Descripcion'];
        $medicamento->dosis = $_POST['txt_Dosis'];

        if($medicamento::agregar($medicamento)){
            $color = "success";
            $titulo = "Registro de medicamento.";
            $mensaje = "Medicamento registrado correctamente.";
            $b_alerta = true;

        }else{
            $color = "danger";
            $titulo = "Registro de medicamento.";
            $mensaje = "Error al registrar el medicamento.";
            $b_alerta = true;
        }
    }

    if(isset($_POST['btn_Eliminar'])){
        ;
        if($medicamento::eliminar($_POST['txt_Id'])){
            $color = "warning";
            $titulo = "Eliminación de medicamento.";
            $mensaje = "Medicamento eliminado correctamente.";
            $b_alerta = true;
        }else{
            $color = "danger";
            $titulo = "Eliminación de medicamento.";
            $mensaje = "No se pudo eliminar el medicamento.";
            $b_alerta = true;
        }
    }

    if(isset($_POST['btn_Buscar'])){
        
        $medicamento_seleccionado = $medicamento::buscar_id($_POST['txt_Id']);
        $medicamento_seleccionado->id;
        $id = $medicamento_seleccionado->id;
        $nombre = $medicamento_seleccionado->nombre;
        $descripcion = $medicamento_seleccionado->descripcion;
        $dosis = $medicamento_seleccionado->dosis;

        $boton_Guardar = 'btn_Modificar';
    }

    if(isset($_POST['btn_Modificar'])){
        
        $medicamento->id = $_POST['txt_Id'];
        $medicamento->nombre = $_POST['txt_Nombre'];
        $medicamento->descripcion = $_POST['txt_Descripcion'];
        $medicamento->dosis = $_POST['txt_Dosis'];

        if($medicamento::modificar($medicamento)){
            $color = "success";
            $titulo = "Modificación de medicamento.";
            $mensaje = "Medicamento modificado correctamente.";
            $b_alerta = true;

        }else{
            $color = "danger";
            $titulo = "Modificación de medicamento.";
            $mensaje = "Error al modificar el medicamento, por favor verifique los datos.";
            $b_alerta = true;
        }
    }

    $medicamentos = $medicamento::listar();
    $tabla .= "<thead><tr><th>Nombre</th><th>Descripción</th><th>Dosis</th><th>Acciones</th></tr></thead><tbody>";
    foreach($medicamentos as $key => $value){
        $form_eliminar = "<form method=\"POST\" role=\"form\"><input type=\"hidden\" id=\"txt_Id\" name=\"txt_Id\" value=\"$value->id\"><button name=\"btn_Eliminar\" title=\"Eliminar medicamento\"><i class=\"fas fa-trash\"></i></button></form>";
        $form_modificar = "<form method=\"POST\" role=\"form\"><input type=\"hidden\" id=\"txt_Id\" name=\"txt_Id\" value=\"$value->id\"><button name=\"btn_Buscar\" title=\"Modificar medicamento\"><i class=\"fas fa-pen\"></i></button></form>";
        $tabla .= "<tr><td>$value->nombre</td><td>$value->descripcion</td><td>$value->dosis</td><td><div class=\"row ml-1\">$form_modificar $form_eliminar</div></td></tr>";
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

    include '../views/vw_Medicamentos.php';
} else{
    header("Location: Ctrol_Login.php");
    exit();
}




?>