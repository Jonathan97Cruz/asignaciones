<?php
session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../../index.php');
}
require '../../../conexion/conexion.php';

class Festivos
{
    private $festivos;

    public function __construct()
    {
        //corregir estos días cada año
        $this->festivos = [
            '3-18' => 'Natalicio de Benito Juarez',
            '3-28' => 'Semana santa',
            '3-29' => 'Semana Santa',
            '5-1' => '1ro de Mayo',
            '9-16' => '16 de septiembre',
            '11-18' => '20 de noviembre',
            '12-25' => '25 de diciembre',

        ];
    }

    public function contarDiasFestivos($fechaInicio, $dias)
    {
        $fechaActual = new DateTime($fechaInicio);
        $diasContados = 0;
        while ($diasContados < $dias) { //0 < 4
            if ($fechaActual->format('N') < 6) { //3 < 6
                $diasContados++; //
            }
            $fechaActualStr = $fechaActual->format(('m-d'));
            if (isset($this->festivos[$fechaActualStr])) {
                $diasContados--;
            }
            $fechaActual->modify('+1 day'); //19-03
        }
        return $fechaActual->format('Y-m-d'); //regresa un string
    }
}

$id = $_POST['idEtiqueta'];
$cliente = (empty($_POST['cliente'])) ? NULL : $_POST['cliente'];
$norma = (empty($_POST['norma'])) ? NULL : $_POST['norma'];
$asignado = (empty($_POST['asignado'])) ? NULL : $_POST['asignado'];
//tabla etiquetas
$denominacion = (empty($_POST['denominacion'])) ? NULL : $_POST['denominacion'];
$marca = (empty($_POST['marca'])) ? NULL : $_POST['marca'];
$modelo = (empty($_POST['modelo'])) ? NULL : $_POST['modelo'];
$tipo = (empty($_POST['tipo'])) ? NULL : $_POST['tipo'];
$precio = (empty($_POST['precio'])) ? NULL : $_POST['precio'];
$revision = (empty($_POST['revision'])) ? NULL : $_POST['revision']; //adicional
$observacion = (empty($_POST['observacion'])) ? NULL : $_POST['observacion']; //siempre vacio 
$tiempo = (empty($_POST['tiempo'])) ? NULL : $_POST['tiempo'];
$fechaLibre = (empty($_POST['fechaLibre'])) ? 0 : $_POST['fechaLibre'];
$asignado2 = (empty($_POST['asignado2'])) ? 0 : $_POST['asignado2'];
$estatus = (empty($_POST['estatus'])) ? NULL : $_POST['estatus'];
$observaciones = (empty($_POST['observaciones'])) ? NULL : $_POST['observaciones']; //historial
$precioDocumento = (empty($_POST['precioDocumento'])) ? 0 : $_POST['precioDocumento'];

$consulta = mysqli_query($conexion, "SELECT * FROM fa_etiquetas WHERE id_etiquetas = $id");
$resultado = mysqli_num_rows($consulta);
if ($resultado > 0) {
    while ($a = mysqli_fetch_array($consulta)) {
        $tiempoBD = $a['tiempo'];
        $fechaLBD = $a['fechaLibre'];
        $denominacionBD = $a['denominacion'];
        $marcaBD = $a['marca'];
        $modeloBD = $a['modelo'];
        $tipoServicio = $a['tipo'];
        $costo = $a['precio'];
        $revisionBD = $a['revision'];
        $asignadoBD2 = $a['asignado2'];
        $estatusBD = $a['estatus'];
        $precioDocumentoBD = $a['costoDoc'];
        $clienteBD = $a['cliente'];
        $normaBD = $a['norma'];
        $asignadoBD = $a['asignado'];
    }
}
$hoyInicial = date('Y-m-d');
//Obtenemos la fecha y la formateamos para agregarla a las observaciones.
$hoy = new DateTime();
$formateada = $hoy->format('d-m-Y H:i:s');
$historial = "";
if ($estatus != 'Terminar Proceso') {
    if ($revision != $revisionBD) { //Revisamos si alguno de estos campos son diferentes de los datos de la BD
        if ($tiempo != $tiempoBD && $fechaLibre != $fechaLBD) { //Revisamos que los tiempos sean diferentes que los de la BD
            if ($tiempo != '0') { //Que sea diferente de 0
                $festivos = new Festivos(); //Creamos un objeto para los días
                $fechaFinal = $festivos->contarDiasFestivos($hoyInicial, $tiempo); //Llamamos la funcion y le pasamos los parametros
                $historial = $estatus . ' ' . $denominacion . ' ' . $marca . ' ' . $modelo . ' ' . $tipo . ' ' .  $revision
                    . ' Costo etiqueta: $' . $precio . ' Costo del documento: $' . $precioDocumento . ' Tiempo:' . $tiempo . 'Día(s) ' . $observacion . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ')\n' . $observaciones;
                $observacion = null;
                $query = mysqli_query($conexion, "UPDATE fa_etiquetas 
                                    SET denominacion = '$denominacion', marca = '$marca', modelo = '$modelo', tipo = '$tipo', precio = '$precio', revision = '$revision', observacion = '$observacion',
                                    tiempo = '$tiempo', fechaLibre = '$fechaLibre', fechaFinal = '$fechaFinal', asignado2 = '$asignado2', estatus = '$estatus', observaciones = '$historial', cliente = '$cliente', norma = '$norma',
                                    asignado = '$asignado' WHERE id_etiquetas = $id  ");
                if ($query) {
                    $_SESSION['msg'] = 'Actualizado correctamente';
                    echo json_encode('Correcto');
                } else {
                    $_SESSION['msg'] = 'Actualización erronea';
                    echo json_encode('error');
                }
            } elseif ($fechaLibre != NULL) {
                $festivos = new Festivos();
                $fechaFinal = $festivos->contarDiasFestivos($hoyInicial, $fechaLibre);
                $historial = $estatus . ' ' . $denominacion . ' ' . $marca . ' ' . $modelo . ' ' . $tipo . ' ' .  $revision
                    . ' Costo etiqueta: $' . $precio . ' Costo del documento: $' . $precioDocumento . ' Tiempo:' . $fechaLibre . 'Día(s) ' . $observacion . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ') \n' . $observaciones;
                $observacion = null;
                $query = mysqli_query($conexion, "UPDATE fa_etiquetas 
                                    SET denominacion = '$denominacion', marca = '$marca', modelo = '$modelo', tipo = '$tipo', precio = '$precio', revision = '$revision', observacion = '$observacion',
                                    tiempo = '$tiempo', fechaLibre = '$fechaLibre', fechaFinal = '$fechaFinal', asignado2 = '$asignado2', estatus = '$estatus', observaciones = '$historial', cliente = '$cliente', norma = '$norma',
                                    asignado = '$asignado' WHERE id_etiquetas = $id  ");
                if ($query) {
                    $_SESSION['msg'] = 'Actualizado correctamente';
                    echo json_encode('Correcto');
                } else {
                    $_SESSION['msg'] = 'Actualización erronea';
                    echo json_encode('error');
                }
            }
        } elseif ($tiempo == $tiempoBD && $fechaLibre == $fechaLBD) {
            if ($tiempo != '0') {
                $festivos = new Festivos();
                $fechaFinal = $festivos->contarDiasFestivos($hoyInicial, $tiempo);
                $historial = $estatus . ' ' . $denominacion . ' ' . $marca . ' ' . $modelo . ' ' . $tipo . ' ' .  $revision
                    . ' Costo etiqueta: $' . $precio . ' Costo del documento: $' . $precioDocumento . ' Tiempo:' . $tiempo . 'Día(s) ' . $observacion . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ')\n' . $observaciones;
                $observacion = null;
                $query = mysqli_query($conexion, "UPDATE fa_etiquetas 
                                    SET denominacion = '$denominacion', marca = '$marca', modelo = '$modelo', tipo = '$tipo', precio = '$precio', revision = '$revision', observacion = '$observacion',
                                    tiempo = '$tiempo', fechaLibre = '$fechaLibre', fechaFinal = '$fechaFinal', asignado2 = '$asignado2', estatus = '$estatus', observaciones = '$historial', cliente = '$cliente', norma = '$norma',
                                    asignado = '$asignado' WHERE id_etiquetas = $id  ");
                if ($query) {
                    $_SESSION['msg'] = 'Actualizado correctamente';
                    echo json_encode('Correcto');
                } else {
                    $_SESSION['msg'] = 'Actualización erronea';
                    echo json_encode('error');
                }
            } elseif ($fechaLibre != NULL) {
                $festivos = new Festivos();
                $fechaFinal = $festivos->contarDiasFestivos($hoyInicial, $fechaLibre);
                $historial = $estatus . ' ' . $denominacion . ' ' . $marca . ' ' . $modelo . ' ' . $tipo . ' ' .  $revision
                    . ' Costo etiqueta: $' . $precio . ' Costo del documento: $' . $precioDocumento . ' Tiempo:' . $fechaLibre . 'Día(s) ' . $observacion . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ') \n' . $observaciones;
                $observacion = null;
                $query = mysqli_query($conexion, "UPDATE fa_etiquetas 
                                    SET denominacion = '$denominacion', marca = '$marca', modelo = '$modelo', tipo = '$tipo', precio = '$precio', revision = '$revision', observacion = '$observacion',
                                    tiempo = '$tiempo', fechaLibre = '$fechaLibre', fechaFinal = '$fechaFinal', asignado2 = '$asignado2', estatus = '$estatus', observaciones = '$historial', cliente = '$cliente', norma = '$norma',
                                    asignado = '$asignado' WHERE id_etiquetas = $id  ");
                if ($query) {
                    $_SESSION['msg'] = 'Actualizado correctamente';
                    echo json_encode('Correcto');
                } else {
                    $_SESSION['msg'] = 'Actualización erronea';
                    echo json_encode('error');
                }
            } else {
                $_SESSION['msg'] = 'Solo debes de ingresar el campo tiempo o tiempo opcional.';
                echo json_encode('error');
            }
        }
    } elseif (
        $denominacion != $denominacionBD || $marca != $marcaBD || $modelo != $modeloBD || $tipo != $tipoServicio || $precio != $costo || $precioDocumento != $precioDocumentoBD
        || $asignado2 != $asignadoBD2 || $estatus != $estatusBD || $observacion != NULL || $asignado != $asignadoBD || $cliente != $clienteBD || $norma != $normaBD
    ) {
        if ($tiempo != 0) {
            $historial = $estatus . ' ' . $denominacion . ' ' . $marca . ' ' . $modelo . ' ' . $tipo . ' ' .  $revision
                . ' Costo etiqueta: $' . $precio . ' Costo del documento: $' . $precioDocumento . ' Tiempo:' . $tiempo . 'Día(s) ' . $observacion . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ')\n' . $observaciones;
        } elseif ($fechaLibre != NULL) {
            $historial = $estatus . ' ' . $denominacion . ' ' . $marca . ' ' . $modelo . ' ' . $tipo . ' ' .  $revision
                . ' Costo etiqueta: $' . $precio . ' Costo del documento: $' . $precioDocumento . ' Tiempo:' . $fechaLibre . 'Día(s) ' . $observacion . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ')\n' . $observaciones;
        }

        $observacion = null;
        $query = mysqli_query($conexion, "UPDATE fa_etiquetas 
                            SET denominacion = '$denominacion', marca = '$marca', modelo = '$modelo', tipo = '$tipo', precio = '$precio', revision = '$revision', observacion = '$observacion',
                            tiempo = '$tiempo', fechaLibre = '$fechaLibre', asignado2 = '$asignado2', estatus = '$estatus', observaciones = '$historial', cliente = '$cliente', norma = '$norma',
                            asignado = '$asignado' WHERE id_etiquetas = $id  ");
        if ($query) {
            $_SESSION['msg'] = 'Actualizado correctamente.';
            echo json_encode('Correcto');
        } else {
            $_SESSION['msg'] = 'Actualización erronea.';
            echo json_encode('error');
        }
    } else {
        echo json_encode('error');
    }
} else {
    if ($tiempo != 0) {
        $historial = $estatus . ' ' . $denominacion . ' ' . $marca . ' ' . $modelo . ' ' . $tipo . ' ' .  $revision
            . ' Costo etiqueta: $' . $precio . ' Costo del documento: $' . $precioDocumento . ' Tiempo:' . $tiempo . 'Día(s) ' . $observacion . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ')\n' . $observaciones;
    } elseif ($fechaLibre != NULL) {
        $historial = $estatus . ' ' . $denominacion . ' ' . $marca . ' ' . $modelo . ' ' . $tipo . ' ' .  $revision
            . ' Costo etiqueta: $' . $precio . ' Costo del documento: $' . $precioDocumento . ' Tiempo:' . $fechaLibre . 'Día(s) ' . $observacion . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ')\n' . $observaciones;
    }

    $observacion = null;
    $query = mysqli_query($conexion, "UPDATE fa_etiquetas 
                        SET denominacion = '$denominacion', marca = '$marca', modelo = '$modelo', tipo = '$tipo', precio = '$precio', revision = '$revision', observacion = '$observacion',
                        tiempo = '$tiempo', fechaLibre = '$fechaLibre', asignado2 = '$asignado2', estatus = '$estatus', observaciones = '$historial', cliente = '$cliente', norma = '$norma',
                        asignado = '$asignado' WHERE id_etiquetas = $id  ");
    if ($query) {
        $_SESSION['msg'] = 'Actualizado correctamente.';
        echo json_encode('proceso');
    } else {
        $_SESSION['msg'] = 'Actualización erronea.';
        echo json_encode('error');
    }
}
