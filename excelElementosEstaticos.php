<?php 
// Incluye la carga automática de Composer
require_once 'vendor/autoload.php';

require 'vendor/autoload.php';
require_once './classElementosEstaticos.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_POST["submit"])) {
    if(isset($_FILES["archivo_excel"]) && $_FILES["archivo_excel"]["error"] == 0) {
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
         $cargarElementos = new ElementosEstaticos();
        
        // Conectar a la base de datos y guardar los datos
        $conexion = new mysqli("localhost", "root", "", "gestion_ambientes",3306);
        foreach($datos as $fila) {
            $id = $fila[0];
            
            $elementoValidado = $cargarElementos->obtenerElementosEstaticosPorSerial($id);
            if (count($elementoValidado) > 0) {
                continue;
            }
            $categoria = $fila[1];
            $marca = $fila[2];
            $modelo = $fila[3];
            $placa = $fila[4];
            $estado = $fila[5];
            $query = "INSERT INTO `elementos_estaticos_ambiente`(`id_elemento_estatico`, `categoria_elemento`, `marca`, `modelo`, `placa`, `estado`) VALUES ('$id','$categoria','$marca','$modelo','$placa','$estado')";
            $conexion->query($query);
        }
        $conexion->close();
        
        // Mostrar un mensaje de éxito
        echo "Los datos se han guardado correctamente en la base de datos.";
        header("Location: verElementosEstaticos.php?registro=True");
    } else {
        // Error al cargar el archivo
        echo "Error al cargar el archivo.";
    }
}

?>