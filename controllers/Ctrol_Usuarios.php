<?php 
include '../models/Usuario.php';
session_start();
if(isset($_SESSION['usuario'])){
    $tabla = "";
    $alerta = "";
    $b_alerta = false;
    $usuario  = New Usuario();

    $id = null;
    $username = null;
    $password = null;
    $nombres = null;
    $apellidos = null;
    $correo = null;
    
    $boton_Guardar = 'btn_Guardar';

    if(isset($_POST['btn_Guardar'])){
        
        $usuario->nombres = $_POST['txt_Nombres'];
        $usuario->apellidos = $_POST['txt_Apellidos'];
        $usuario->usuario = $_POST['txt_Username'];
        $usuario->password = $_POST['txt_Password'];
        $usuario->correo = $_POST['txt_Correo'];

        if($usuario::agregar($usuario)){
            $color = "success";
            $titulo = "Registro de usuario.";
            $mensaje = "Usuario registrado correctamente.";
            $b_alerta = true;

        }else{
            $color = "danger";
            $titulo = "Registro de usuario.";
            $mensaje = "Usuario ya registrado previamente.";
            $b_alerta = true;
        }
    }

    if(isset($_POST['btn_Eliminar'])){
        ;
        if($usuario::eliminar($_POST['txt_Id'])){
            $color = "warning";
            $titulo = "Eliminación de usuario.";
            $mensaje = "Usuario eliminado correctamente.";
            $b_alerta = true;
        }else{
            $color = "danger";
            $titulo = "Eliminación de usuario.";
            $mensaje = "No se pudo eliminar el usuario.";
            $b_alerta = true;
        }
    }

    if(isset($_POST['btn_Buscar'])){
        
        $usuario_seleccionado = $usuario::buscar_id($_POST['txt_Id']);
        $usuario_seleccionado->id;
        $id = $usuario_seleccionado->id;
        $username = $usuario_seleccionado->usuario;
        $nombres = $usuario_seleccionado->nombres;
        $apellidos = $usuario_seleccionado->apellidos;
        $correo = $usuario_seleccionado->correo;

        $boton_Guardar = 'btn_Modificar';
    }

    if(isset($_POST['btn_Modificar'])){
        
        $usuario->id = $_POST['txt_Id'];
        $usuario->nombres = $_POST['txt_Nombres'];
        $usuario->apellidos = $_POST['txt_Apellidos'];
        $usuario->usuario = $_POST['txt_Username'];
        $usuario->password = $_POST['txt_Password'];
        $usuario->correo = $_POST['txt_Correo'];

        if($usuario::modificar($usuario)){
            $color = "success";
            $titulo = "Modificación de usuario.";
            $mensaje = "Usuario modificado correctamente.";
            $b_alerta = true;

        }else{
            $color = "danger";
            $titulo = "Modificación de usuario.";
            $mensaje = "Error al modificar el usuario, por favor verifique los datos.";
            $b_alerta = true;
        }
    }

    $usuarios = $usuario::listar();
    $tabla .= "<thead><tr><th>Usuario</th><th>Nombre</th><th>Correo</th><th>Acciones</th></tr></thead><tbody>";
    foreach($usuarios as $key => $value){
        $form_eliminar = "<form method=\"POST\" role=\"form\"><input type=\"hidden\" id=\"txt_Id\" name=\"txt_Id\" value=\"$value->id\"><button name=\"btn_Eliminar\" title=\"Eliminar usuario\"><i class=\"fas fa-trash\"></i></button></form>";
        $form_modificar = "<form method=\"POST\" role=\"form\"><input type=\"hidden\" id=\"txt_Id\" name=\"txt_Id\" value=\"$value->id\"><button name=\"btn_Buscar\" title=\"Modificar usuario\"><i class=\"fas fa-pen\"></i></button></form>";
        $tabla .= "<tr><td>$value->usuario</td><td>$value->nombres $value->apellidos</td><td>$value->correo</td><td><div class=\"row ml-1\">$form_modificar $form_eliminar</div></td></tr>";
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

    include '../views/vw_Usuarios.php';
} else{
    header("Location: Ctrol_Login.php");
    exit();
}




?>