<?php 
include '../models/Usuario.php';
include '../models/Mascota.php';
include '../models/Cliente.php';
include '../models/Medicamento.php';
session_start();
if(isset($_SESSION['usuario'])){

    $mascota  = New Mascota();
    $cliente  = New Cliente();
    $medicamento  = New Medicamento();
    $usuario  = New Usuario();

    $cant_mascotas = count($mascota::listar());
    $cant_clientes = count($cliente::listar());
    $cant_medicamentos = count($medicamento::listar());
    $cant_usuarios = count($usuario::listar());


    $max_clientes = cliente::find_by_sql('SELECT COUNT(ma.id) AS cant, 
                                            c.cedula, 
                                            c.nombres, 
                                            c.apellidos 
                                        FROM clientes c
                                        INNER JOIN mascotas ma ON c.id = ma.cliente_id
                                        GROUP BY c.cedula, 
                                            c.nombres, 
                                            c.apellidos
                                        LIMIT 5');
    
    $max_medicamentos = medicamento::find_by_sql('SELECT COUNT(ma.id) AS cant, 
                                            me.nombre, 
                                            me.dosis
                                        FROM medicamentos me
                                        INNER JOIN mascotas ma ON me.id = ma.medicamento_id
                                        GROUP BY me.nombre, 
                                            me.dosis
                                        LIMIT 5');
    $tabla_clientes = "<thead><tr><th>Cédula</th><th>Cliente</th><th>Cantidad de mascotas</th></tr></thead><tbody>";
    foreach($max_clientes as $key => $value){
        $tabla_clientes .= "<tr><td>$value->cedula</td><td>$value->nombres $value->apellidos</td><td>$value->cant</td></tr>";
    }
    $tabla_clientes .= "</tbody>";

    $tabla_medicamentos = "<thead><tr><th>Medicamento</th><th>Dosis</th><th>Cantidad de mascotas</th></tr></thead><tbody>";
    foreach($max_medicamentos as $key => $value){
        $tabla_medicamentos .= "<tr><td>$value->nombre</td><td>$value->dosis</td><td>$value->cant</td></tr>";
    }
    $tabla_medicamentos .= "</tbody>";


    include '../views/vw_Home.php';
} else{
    header("Location: Ctrol_Login.php");
    exit();
}




?>