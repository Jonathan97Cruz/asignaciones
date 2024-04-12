<?php

$user = 'root';
$password = '';
//$user = 'adminfactual_web';
//$password = 'Tsun4m10';
$host = 'localhost';
$bd = 'asignaciones';

$conexion = mysqli_connect($host, $user, $password, $bd);
mysqli_set_charset($conexion, 'UTF8');

if(!$conexion ) echo 'Error de conexion';

?>