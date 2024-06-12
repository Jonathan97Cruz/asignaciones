<?php

session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('../../index.php');
}

require_once('../../../conexion/conexion.php');

$cliente = $_POST['cliente'];

/*$sql = "SELECT * FROM fa_clientes WHERE cliente LIKE ? ORDER BY cliente ASC ";
$query = $conexion->prepare($sql);

$query->execute([$cliente . '%']);
$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<li>" . $row["cliente"] . " </li>";
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);*/

$sql = mysqli_query($conexion, "SELECT * FROM fa_clientes WHERE cliente LIKE '$cliente%' ORDER BY cliente ASC LIMIT 0,10");
$html = "";
while ($row = mysqli_fetch_array($sql)) {
    $html .= "<li onclick=\"mostrar('".$row["cliente"]."')\" style='background-color: #6f7cf6; border: 1px solid rgba(59, 248, 59, 0.933); padding: 5px; width:100%; float:left; cursor:pointer;' >" . $row["cliente"] . " </li>";
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
