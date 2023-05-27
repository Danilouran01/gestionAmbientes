<?php 
// Incluye la carga automática de Composer
require_once 'vendor/autoload.php';

require 'vendor/autoload.php';

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
        
        // Conectar a la base de datos y guardar los datos
        $conexion = new mysqli("localhost", "root", "", "gestion_ambientes",3306);
        foreach($datos as $fila) {
            $numero_documento = $fila[1];
            $nombre = $fila[2];
            $apellido= $fila[3];
            $tipo_documento = $fila[0];
            $centro = $fila[7];
            $telefono = $fila[5];
            $correo = $fila[4];
            $rol = $fila[6];
            $query = "INSERT INTO `usuario`(`numero_documento`, `nombre`, `apellido`, `tipo_documento`, `numero_ficha`, `centro`, `telefono`, `correo`, `contrasena`, `id_rol`) VALUES ('$numero_documento','$nombre','$apellido','$tipo_documento',NULL,'$centro','$telefono','$correo',NULL,'$rol')";
            $conexion->query($query);
            
        }
        $conexion->close();
        
        // Mostrar un mensaje de éxito
        echo "Los datos se han guardado correctamente en la base de datos.";
        header("Location: ver_usuario.php?registroUsuario=True");
    } else {
        // Error al cargar el archivo
        echo "Error al cargar el archivo.";
        header("Location: ver_usuario.php?registroFallido=False");
      
    }
}

?>