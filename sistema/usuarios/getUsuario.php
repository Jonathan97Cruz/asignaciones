<?php

require '../../conexion/conexion.php';

 $id = $conexion->real_escape_string($_POST['id']);

 $sql = "SELECT id_usuario, fa_nombre, fa_apellido, fa_user, fa_password, fa_rol FROM fa_usuarios WHERE id_usuario = $id LIMIT 1";
 $resultado = $conexion->query($sql);
 $rows = $resultado->num_rows;

$usuario = [];

 if($rows > 0){
    $usuario = $resultado->fetch_array();
 }

 echo json_encode($usuario, JSON_UNESCAPED_UNICODE);//para procesar acentos
