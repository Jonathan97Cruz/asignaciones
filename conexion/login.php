<?php

session_start();
if( !empty($_SESSION['active']) ){
    session_destroy();
    header('location:../index.php');
}

require_once 'conexion.php';

$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);

$query = mysqli_query($conexion, "SELECT * 
                                    FROM fa_usuarios
                                    WHERE fa_user = '$usuario' 
                                    AND fa_password = '$password' ");

$resultado = mysqli_num_rows($query);

if($resultado > 0){
    while($a = mysqli_fetch_array($query)){
        $_SESSION['active'] = true;
        $_SESSION['idUsuario'] = $a['id_usuario'];
        $_SESSION['fa_nombre'] = $a['fa_nombre'];
        $_SESSION['fa_apellido'] = $a['fa_apellido'];
        $_SESSION['fa_rol'] = $a['fa_rol'];
        if($_SESSION['fa_rol'] != 3 && $_SESSION['fa_rol'] != 5 && $_SESSION['fa_rol'] != 6 && $_SESSION['fa_rol'] != 7){
            header('location:../sistema/acciones/listaFolios.php');  
        }elseif($_SESSION['fa_rol'] == 3 || $_SESSION['fa_rol'] == 5 || $_SESSION['fa_rol'] == 6 || $_SESSION['fa_rol'] == 7){
            header('location:../sistema/acciones/inspectores/asignaciones.php');
        }else{
            $_SESSION['msg'] = '<p style="color: red;">¡Error en el usuario o contraseña!</p>';
            header('location:../index.php');
        }
    }
}else{
    session_destroy();
    header('location:../index.php');
}
