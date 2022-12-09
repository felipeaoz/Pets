<?php 
    $conexion = mysqli_connect("172.17.0.2:3306","root","root","pets");

    if(!$conexion){
        echo "".mysqli_connect_error();

    }else{
        echo "Base de datos conectada".mysqli_connect_error();
    }

?>

