<?php 
include '../models/Usuario.php';
session_start();
$_SESSION['registro'] = "";
$mensaje = "";
if(isset($_SESSION['usuario'])){
    header("Location: Ctrol_Home.php");
    exit();
} else{
   
    $usuario  = New Usuario();
    if(isset($_POST['btn_Login'])){
        
        if(isset($_POST['txt_Usuario']) && isset($_POST['txt_Password'])){
            
            $usuario = Usuario::validar_login($_POST['txt_Usuario'],$_POST['txt_Password']);
            if($usuario){
                
                $_SESSION["usuario"] = $usuario[0]->usuario;
                $_SESSION["nombres"] = $usuario[0]->nombres;
                $_SESSION["apellidos"] = $usuario[0]->apellidos;
                $_SESSION["correo"] = $usuario[0]->correo;

                echo("<script type=\"text/javascript\">alert=(\"Bienvenido ".$_SESSION["nombres"]."\");</script>");
                header("Location: Ctrol_Home.php");

            }else{
                $_SESSION['registro'] = "Usuario incorrecto.";
                $mensaje = '';
                $mensaje .= '<div class="row">
                                <div class="col-xl-12">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Error de inicio de sesión.</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Usuario y/o contraseña incorrectos.</div>
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
        }
    } 
}

include '../views/vw_Login.php';


?>
