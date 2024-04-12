<?php

if (is_array($_FILES['excel']) && count($_FILES['excel']) > 0) {
    require '../vendor/autoload.php';
    $conexion = new mysqli('localhost', 'adminfactual_web', 'Tsun4m10', 'asignaciones');

    class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
    {
        public function readCell($columnAddress, $row, $worksheetName = '')
        {
            if ($row > 1) {
                return true;
            }
            return false;
        }
    }

    /** Create a new Xls Reader  **/
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    $inputFileName = $_FILES['excel']['tmp_name'];

    /**  Identify the type of $inputFileName  **/
    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

    $reader->setReadFilter(new MyReadFilter());

    /**  Load $inputFileName to a Spreadsheet Object  **/
    $spreadsheet = $reader->load($inputFileName);
    $cantidad = $spreadsheet->getActiveSheet()->toArray();
    foreach ($cantidad as $row) {
        if ($row[0] != '') {

            $veri = mysqli_query($conexion, "SELECT folios FROM fa_asignaciones WHERE folios = '" . $row[0] . "' ");

            if (mysqli_num_rows($veri) == 0) {
                $hoy = date('Y-m-d');
                $rece = "Recepción";
                $nor = "Normal";
                $consulta = mysqli_query($conexion, "INSERT INTO fa_asignaciones(folios, norma, cliente, fechaRecepcion,estatus,prioridad)
                                         VALUES ('$row[0]', '$row[1]', '$row[2]', '$hoy','$rece','$nor' ) ");
                //$respuesta = $conexion->query($consulta);
            } else {
                // Si ya existe, mostrar un mensaje de error

                $_SESSION['msg'] = 'El folio ' . $row[0] . ' ya existe en la base de datos.';
            }
        } else {
            // Si el valor de la primera columna está vacío, mostrar un mensaje de error
            $_SESSION['msg'] = 'El valor de la primera columna está vacío.';
        }
    }
}
header('Location: importarFolios.php');
