<?php 
include '../models/Cliente.php';
session_start();
if(isset($_SESSION['usuario'])){
    $tabla = "";
    $alerta = "";
    $b_alerta = false;
    $cliente  = New Cliente();

    $id = null;
    $cedula = null;
    $nombres = null;
    $apellidos = null;
    $direccion = null;
    $telefono = null;
    $boton_Guardar = 'btn_Guardar';

    if(isset($_POST['btn_Guardar'])){
        
        $cliente->cedula = $_POST['txt_Cedula'];
        $cliente->nombres = $_POST['txt_Nombres'];
        $cliente->apellidos = $_POST['txt_Apellidos'];
        $cliente->direccion = $_POST['txt_Direccion'];
        $cliente->telefono = $_POST['txt_Telefono'];

        if($cliente::agregar($cliente)){
            $color = "success";
            $titulo = "Registro de cliente.";
            $mensaje = "Cliente registrado correctamente.";
            $b_alerta = true;

        }else{
            $color = "danger";
            $titulo = "Registro de cliente.";
            $mensaje = "Cliente ya registrado previamente.";
            $b_alerta = true;
        }
    }

    if(isset($_POST['btn_Eliminar'])){
        ;
        if($cliente::eliminar($_POST['txt_Id'])){
            $color = "warning";
            $titulo = "Eliminación de cliente.";
            $mensaje = "Cliente eliminado correctamente.";
            $b_alerta = true;
        }else{
            $color = "danger";
            $titulo = "Eliminación de cliente.";
            $mensaje = "No se pudo eliminar el cliente.";
            $b_alerta = true;
        }
    }

    if(isset($_POST['btn_Buscar'])){
        
        $cliente_seleccionado = $cliente::buscar_id($_POST['txt_Id']);
        $cliente_seleccionado->id;
        $id = $cliente_seleccionado->id;
        $cedula = $cliente_seleccionado->cedula;
        $nombres = $cliente_seleccionado->nombres;
        $apellidos = $cliente_seleccionado->apellidos;
        $direccion = $cliente_seleccionado->direccion;
        $telefono = $cliente_seleccionado->telefono;

        $boton_Guardar = 'btn_Modificar';
    }

    if(isset($_POST['btn_Modificar'])){
        
        $cliente->id = $_POST['txt_Id'];
        $cliente->cedula = $_POST['txt_Cedula'];
        $cliente->nombres = $_POST['txt_Nombres'];
        $cliente->apellidos = $_POST['txt_Apellidos'];
        $cliente->direccion = $_POST['txt_Direccion'];
        $cliente->telefono = $_POST['txt_Telefono'];

        if($cliente::modificar($cliente)){
            $color = "success";
            $titulo = "Modificación de cliente.";
            $mensaje = "Cliente modificado correctamente.";
            $b_alerta = true;

        }else{
            $color = "danger";
            $titulo = "Modificación de cliente.";
            $mensaje = "Error al modificar el cliente, por favor verifique los datos.";
            $b_alerta = true;
        }
    }

    $clientes = $cliente::listar();
    $tabla .= "<thead><tr><th>Cédula</th><th>Cliente</th><th>Dirección</th><th>Teléfono</th><th>Acciones</th></tr></thead><tbody>";
    foreach($clientes as $key => $value){
        $form_eliminar = "<form method=\"POST\" role=\"form\"><input type=\"hidden\" id=\"txt_Id\" name=\"txt_Id\" value=\"$value->id\"><button name=\"btn_Eliminar\" title=\"Eliminar cliente\"><i class=\"fas fa-trash\"></i></button></form>";
        $form_modificar = "<form method=\"POST\" role=\"form\"><input type=\"hidden\" id=\"txt_Id\" name=\"txt_Id\" value=\"$value->id\"><button name=\"btn_Buscar\" title=\"Modificar cliente\"><i class=\"fas fa-pen\"></i></button></form>";
        $tabla .= "<tr><td>$value->cedula</td><td>$value->nombres $value->apellidos</td><td>$value->direccion</td><td>$value->telefono</td><td><div class=\"row ml-1\">$form_modificar $form_eliminar</div></td></tr>";
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

    include '../views/vw_Clientes.php';
} else{
    header("Location: Ctrol_Login.php");
    exit();
}




?>