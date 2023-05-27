<?php
// Incluye la carga automática de Composer
require_once 'vendor/autoload.php';

require 'vendor/autoload.php';

require_once "./classAmbientes.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST["submit"])) {
    if (isset($_FILES["archivo_excel"]) && $_FILES["archivo_excel"]["error"] == 0) {
        // El archivo se ha cargado correctamente
        $nombre_archivo = $_FILES["archivo_excel"]["name"];
        $tipo_archivo = $_FILES["archivo_excel"]["type"];
        $ruta_temporal = $_FILES["archivo_excel"]["tmp_name"];

        // Procesar el archivo
        $reader = IOFactory::createReaderForFile($ruta_temporal);
        $spreadsheet = $reader->load($ruta_temporal);

        // Obtener los datos del archivo
        $hoja_actual = $spreadsheet->getActiveSheet();
        $datos = $hoja_actual->toArray();

        // Eliminar la primera fila (encabezado)
        unset($datos[0]);
        $cargarAmbiente = new Ambientes();
        // Conectar a la base de datos y guardar los datos
        foreach ($datos as $fila) {
            $cargarAmbiente->id_ambiente=$fila[0];

            $ambienteValidado = $cargarAmbiente->obtenerAmbientePorId($fila[0]);
            if ($ambienteValidado->num_rows > 0) {
                continue;
            }

            $cargarAmbiente->piso=$fila[1];
            $cargarAmbiente->sillas=$fila[2];
            $cargarAmbiente->mesas=$fila[3];
            $cargarAmbiente->linea_formacion=$fila[4];
            $cargarAmbiente->estado=$fila[5];
            

            $cargarAmbiente->registrarAmbiente();
        
        }

        // Mostrar un mensaje de éxito
        echo "Los datos se han guardado correctamente en la base de datos.";
        header("Location: ver_ambiente.php?registro=True");
    } else {
        // Error al cargar el archivo
        echo "Error al cargar el archivo.";
        header("Location: ver_ambiente.php?registroFallido=True");
    }
}
