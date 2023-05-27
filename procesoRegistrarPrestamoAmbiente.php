
<?php
require_once "./classAmbientes.php";
require_once "./classPrestamo.php";

$actualizarEstadoAmbiente = new Ambientes();
$nuevoPrestamo = new Prestamo();



if (isset($_POST['prestar'])) {

    $ambiente = $_POST['inputselect'];
    $numeroCedula = $_POST['numeroCedula'];

    if (empty($_POST['observaciones'])) {
        $observaciones = NULL;
    } else {
        $observaciones = $_POST['observaciones'];
    }


    echo date_default_timezone_get();
    date_default_timezone_set("America/Bogota");
    echo date_default_timezone_get();



    $nuevoPrestamo->id_prestamo = NULL;
    $nuevoPrestamo->fecha_prestamo = date('Y-m-d');
    $nuevoPrestamo->hora_prestamo = date('h:i:s');
    $nuevoPrestamo->fecha_entrega = NULL;
    $nuevoPrestamo->hora_entrega =  NULL;
    $nuevoPrestamo->observaciones = $observaciones;
    $nuevoPrestamo->id_numero_ambiente = $ambiente[0];
    $nuevoPrestamo->numero_documento = $numeroCedula;
    $nuevoPrestamo->estado_prestamo = "activo";
    $id_prestamo = $nuevoPrestamo->registrarPrestamo();



    $actualizarEstadoAmbiente->id_ambiente = $ambiente[0];
    $actualizarEstadoAmbiente->estado = 2;
    $resultado_prestamo = $actualizarEstadoAmbiente->actualizarEstadoAmbiente();


    if ($resultado_prestamo) {
        header("Location: RegistrarPrestamoAmbiente.php?id_prestamo=$id_prestamo");
    }

  


    // header("location: verPrestamosActivos.php");

}

?>
