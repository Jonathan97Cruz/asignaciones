<?php
session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../../../index.php');
}
require '../../../../conexion/conexion.php';


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

$seguimiento = (empty($_POST['seguimiento'])) ? NULL : $_POST['seguimiento'];

$cliente = (empty($_POST['cliente'])) ? NULL : $_POST['cliente'];
$norma = (empty($_POST['norma'])) ? NULL : $_POST['norma'];
$asignado = (empty($_POST['asignado'])) ? NULL : $_POST['asignado'];
$estatus = (empty($_POST['estatus'])) ? NULL : $_POST['estatus']; //tabla asignaciones

//tabla etiquetas
$denominacion = (empty($_POST['denominacion'])) ? NULL : $_POST['denominacion'];
$marca = (empty($_POST['marca'])) ? NULL : $_POST['marca'];
$modelo = (empty($_POST['modelo'])) ? NULL : $_POST['modelo'];
$tipo = (empty($_POST['tipo'])) ? NULL : $_POST['tipo'];
$precio = (empty($_POST['precio'])) ? NULL : $_POST['precio'];
$revision = (empty($_POST['revision'])) ? NULL : $_POST['revision']; //adicional
$observacion = (empty($_POST['observacion'])) ? NULL : $_POST['observacion'];
$tiempo = (empty($_POST['tiempo'])) ? NULL : $_POST['tiempo'];
$fechaLibre = (empty($_POST['fechaLibre'])) ? NULL : $_POST['fechaLibre'];

$hoy = date('Y-m-d');
$mes = date('m');
$año = date('Y');

$date = new DateTime();
$formateada = $date->format('d-m-Y H:i:s');
//$numeroFinal = 0;

$consultaUltimoSeguimiento = mysqli_query($conexion, "SELECT MAX(noSeguimiento) AS ultimo_seguimiento FROM fa_etiquetas");
$resultadoConsulta = mysqli_fetch_assoc($consultaUltimoSeguimiento);
$ultimoSeguimiento = $resultadoConsulta['ultimo_seguimiento'];

if ($ultimoSeguimiento) {
    $partes = explode('-', $ultimoSeguimiento);
    $numeroFinal = intval(substr($partes[0], -4));
} else {
    $numeroFinal = 0;
}

for ($i = 0; $i < count($tipo); $i++) {

    if ($seguimiento[$i] != NULL) {
        if ($tiempo[$i] != '0' && $fechaLibre[$i] == NULL) {
            $festivos = new Festivos();
            //Agregar días de tiempo a hoy para fecha final
            $fechaFinal = $festivos->contarDiasFestivos($hoy, $tiempo[$i]); //regresa un string
        } elseif ($tiempo[$i] == '0' && $fechaLibre[$i] != NULL) {
            $festivos = new Festivos();
            //Agregar días de fechaLibre a hoy para fecha final
            $fechaFinal = $festivos->contarDiasFestivos($hoy, $fechaLibre[$i]);
        }
        $historial =  $revision[$i] . ' ' . $tipo[$i] . ' $' . $precio[$i] . ' ' . $observacion[$i] . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ')';
        $etiqueta = mysqli_query($conexion, "INSERT INTO fa_etiquetas(denominacion, marca, modelo, tipo, precio, revision,
                                                     observaciones, tiempo, fechaLibre,fechaFinal,noSeguimiento, cliente, norma, asignado, estatus) 
                                        VALUES('$denominacion[$i]','$marca[$i]','$modelo[$i]','$tipo[$i]','$precio[$i]','$revision[$i]',
                                                '$historial','$tiempo[$i]','$fechaLibre[$i]','$fechaFinal','$seguimiento[$i]','$cliente','$norma','$asignado','$estatus' )");
    } elseif ($seguimiento[$i] == NULL) {
        $numeroFinal++;
        $numeroSeguimiento = "FS/" . sprintf("%02d", $mes) . $año . "/" . sprintf("%04d", $numeroFinal);
        if ($tiempo[$i] != '0' && $fechaLibre[$i] == NULL) {
            $festivos = new Festivos();
            //Agregar días de tiempo a hoy para fecha final
            $fechaFinal = $festivos->contarDiasFestivos($hoy, $tiempo[$i]); //regresa un string
        } elseif ($tiempo[$i] == '0' && $fechaLibre[$i] != NULL) {
            $festivos = new Festivos();
            //Agregar días de fechaLibre a hoy para fecha final
            $fechaFinal = $festivos->contarDiasFestivos($hoy, $fechaLibre[$i]);
        }
        $historial =  $revision[$i] . ' ' . $tipo[$i] . ' $' . $precio[$i] . ' ' . $observacion[$i] . ' ' . $formateada . ' (' . $_SESSION['fa_nombre'] . ')';
        $etiqueta = mysqli_query($conexion, "INSERT INTO fa_etiquetas(denominacion, marca, modelo, tipo, precio, revision,
                                                        observaciones, tiempo, fechaLibre,fechaFinal,noSeguimiento, cliente, norma, asignado, estatus) 
                                            VALUES('$denominacion[$i]','$marca[$i]','$modelo[$i]','$tipo[$i]','$precio[$i]','$revision[$i]',
                                                    '$historial','$tiempo[$i]','$fechaLibre[$i]','$fechaFinal','$numeroSeguimiento','$cliente','$norma','$asignado','$estatus' )");

        if ($i > 0) {
            //$numeroConsecutivo = $i - 1;
            $numeroSeguimiento .= "-" . ($i);
            $idUltimo = mysqli_insert_id($conexion);
            mysqli_query($conexion, "UPDATE fa_etiquetas SET noSeguimiento = '$numeroSeguimiento' WHERE id = $idUltimo");
        }
    }
}
if ($etiqueta) {
    header('location: ../index.php');
} else {
    echo 'Error al insertar';
}
