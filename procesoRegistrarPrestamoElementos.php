
<?php
require_once "./classPrestamo.php";
require_once "./classDetallePrestamo.php";
require_once "./classElemento.php";


$detallePrestamo = new DetallePrestamo();
$nuevoPrestamo = new Prestamo();
$actualizarElemento = new Elemento();


if (isset($_POST['prestar'])) {

    $numeroCedula = $_POST['numeroCedula'];
    $equipos_seleccionados = $_POST['equipos'];


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
    $nuevoPrestamo->id_numero_ambiente = NULL;
    $nuevoPrestamo->numero_documento = $numeroCedula;
    $nuevoPrestamo->estado_prestamo = "activo";
    $id = $nuevoPrestamo->registrarPrestamo();


    $contador_registros = 0;
    foreach ($equipos_seleccionados as $equipo) {


        $cargador = isset($_POST['cargador_' . $equipo]) ? $_POST['cargador_' . $equipo] : 'no';
        $mouse = isset($_POST['mouse_' . $equipo]) ? $_POST['mouse_' . $equipo] : 'no';

        $detallePrestamo->id_detalle_prestamo = NULL;
        $detallePrestamo->cantidad = NULL;
        $detallePrestamo->id_prestamo = $id;
        $detallePrestamo->serial = $equipo;
        $detallePrestamo->cargador = $cargador;
        $detallePrestamo->mouse = $mouse;
        $detalle_prestamo_registrado = $detallePrestamo->registrarDetallePrestamo();

        $actualizarElemento->serial = $equipo;
        $actualizarElemento->estado = 2;
        $elemento_actualizado = $actualizarElemento->ActualizarEstadoElemento();

        if ($detalle_prestamo_registrado && $elemento_actualizado) {
            $contador_registros++;
        }
    }

    if ($contador_registros == count($equipos_seleccionados)) {
       header("Location: registrarPrestamoElementos.php?registro=$id");
    }
}


?>