<?php session_start();
if (!isset($_SESSION['numero_documento'])) {
    header("location: ./index.php");
    exit();
}


require_once "./classPrestamo.php";

$estadoPrestamo = new Prestamo();
$mostrar_prestamos = $estadoPrestamo->obtenerPrestamosActivosInactivos();

require_once "./classAmbientes.php";
$verAmbiente = new Ambientes();


require_once "./classUsuario.php";
$mostrarUsuario = new Usuario();

if (!empty($_REQUEST['idPrestamoObservacion'])) {
    $id_prestamo = $_REQUEST['idPrestamoObservacion'];

    $añadirObservacion = new Prestamo();
    $prestamo = $añadirObservacion->obtenerPrestamosAmbienteId($id_prestamo);
    $row = $prestamo->fetch_assoc();
    $modificar_observacion = true;


    $color = "";
    if (isset($_GET["modificado"])) {
        $color = "green";
        $texto = "Modificado";
    } else {
        $color = "red";
        $texto = "No modificado";
    }
}

?>