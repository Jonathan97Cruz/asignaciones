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
            $consulta = "INSERT INTO fa_asignaciones(oficio, cliente, folios, norma, fechAsignacion, inspector, estatus, observaciones,prioridad)
            VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[8]' ) ";
            $respuesta = $conexion->query($consulta);
            $_SESSION['msg'] = $respuesta;
            header('Location: index.php');
        } else {
            $_SESSION['msg'] = 'Error';
            header('Location: index.php');
        }
    }
}
