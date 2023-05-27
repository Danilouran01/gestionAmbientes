<?php
// Incluye la carga automática de Composer
require_once 'vendor/autoload.php';

require 'vendor/autoload.php';

require_once "./classUsuario.php";

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
        $cargarUsuario = new Usuario();
        // Conectar a la base de datos y guardar los datos
        foreach ($datos as $fila) {
            $cargarUsuario->numeroDocumento = $fila[1];

            $usuarioValidado = $cargarUsuario->obtenerUsuarioId($fila[1]);
            if ($usuarioValidado->num_rows > 0) {
                continue;
            }

            $cargarUsuario->nombre = $fila[2];
            $cargarUsuario->apellido = $fila[3];
            $cargarUsuario->tipoDocumento = $fila[0];
            $cargarUsuario->centro = $fila[7];
            $cargarUsuario->telefono = $fila[5];
            $cargarUsuario->correo = $fila[4];
            $cargarUsuario->rol = $fila[6];
            $cargarUsuario->setContrasena(NULL);
            $cargarUsuario->setFicha(NULL);

            $cargarUsuario->registrarUsuario();
        }

        // Mostrar un mensaje de éxito
        echo "Los datos se han guardado correctamente en la base de datos.";
        header("Location: ver_usuario.php?registroUsuario=True");
    } else {
        // Error al cargar el archivo
        echo "Error al cargar el archivo.";
        header("Location: ver_usuario.php?registroFallido=False");
    }
}
