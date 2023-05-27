<?php 
require_once "./classPrestamo.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Obtener los datos del usuario
if (isset($_REQUEST['registrar'])) {
    $estado = $_REQUEST['Estado'];
    $fecha_inicial = $_REQUEST['FechaInicio'];
    $fecha_final = $_REQUEST['FechaFin'];
    if (strtotime($fecha_inicial) > strtotime($fecha_final)) {
        header("Location: verPrestamosActivos.php?fechasCorrectas=false");
        exit();
    }

    if (empty($fecha_inicial) && !empty($fecha_final)){
        header("Location: verPrestamosActivos.php?fechas=false");
        exit();
    }


    $prestamoActivo = new Prestamo();

    if (!empty($fecha_inicial) && !empty($fecha_final)) {

        if ($estado !== 'NULL') {
            $datosUsuario = $prestamoActivo->obtenerPrestamosAmbientePorFechaEstado($fecha_inicial, $fecha_final, $estado);
        } else {
            $datosUsuario = $prestamoActivo->filtrarPrestamosAmbientePorFechaOPorEstado($fecha_inicial, $fecha_final, $estado);
        }

    } else {

        if ($estado !== 'NULL') {
            $datosUsuario = $prestamoActivo->filtrarPrestamosAmbientePorFechaOPorEstado(NULL, NULL, $estado);
        } else {
            $datosUsuario = $prestamoActivo->obtenerPrestamosActivosInactivos();
        }
    }

  
    // Obtener los datos del usuario desde la base de datos

    // if ($datosUsuario !== null) {
        // Crear el archivo Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Prestamos");

        // Escribir los encabezados de las columnas
        $sheet->setCellValue('A1', 'Id prestamo');
        $sheet->setCellValue('B1', 'Fecha prestamo');
        $sheet->setCellValue('C1', 'Hora prestamo');
        $sheet->setCellValue('D1', 'Ambiente');
        $sheet->setCellValue('E1', 'Fecha entrega');
        $sheet->setCellValue('F1', 'Hora entrega');
        $sheet->setCellValue('G1', 'Responsable');
        $sheet->setCellValue('H1', 'Responsable');
        $sheet->setCellValue('I1', 'observaciones');
        $sheet->setCellValue('J1', 'Estado');

        // Escribir los datos del usuario en las filas siguientes
        $row = 2;
        foreach ($datosUsuario as $datos) {
            $sheet->setCellValue('A' . $row, $datos['id_prestamo']);
            $sheet->setCellValue('B' . $row, $datos['fecha_prestamo']);
            $sheet->setCellValue('C' . $row, $datos['hora_prestamo']);
            $sheet->setCellValue('D' . $row, $datos['id_numero_ambiente']);
            $sheet->setCellValue('E' . $row, $datos['fecha_entrega']);
            $sheet->setCellValue('F' . $row, $datos['hora_entrega']);
            $sheet->setCellValue('G' . $row, $datos['numero_documento']);
            $sheet->setCellValue('H' . $row, $datos['nombre'] ." ". $datos['apellido'] );
            $sheet->setCellValue('I' . $row, $datos['observaciones']);
            $sheet->setCellValue('J' . $row, $datos['estado_prestamo']);
            $row++;
        }

        // Crear el archivo Excel y guardarlo en la carpeta temporal
        $writer = new Xlsx($spreadsheet);
        $filename = 'datos_usuario.xlsx';

        // Cambiar la configuración del límite de memoria
        ini_set('memory_limit', '512M');

        // Descargar el archivo Excel al navegador
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
?>

