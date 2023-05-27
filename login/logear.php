<?php 
    require_once "../database/conexion.php";
    session_start();
    $con = new Conexion();
    $con->conectar();

    if(isset($_GET['msg']))
{
    $Message = $_GET['msg'];
}
    
    $numero_documento = $_POST['numero_documento'];
    $contrasena = $_POST['contrasena'];

    $query = "SELECT *, COUNT(*) as contar FROM usuario INNER JOIN tipo_documento ON tipo_documento.idDocumento=usuario.tipo_documento WHERE numero_documento ='$numero_documento' AND contrasena = '$contrasena'";
    $consulta = mysqli_query($con->con, $query);
    $array = mysqli_fetch_array($consulta);

    if($array['contar'] > 0){
        // session_start();
        $_SESSION['numero_documento'] = $numero_documento;
        $_SESSION['nombre'] = $array['nombre'];
        $_SESSION['apellido'] = $array['apellido'];
        $_SESSION['tipoDocumento'] = $array['tipo'];
        $_SESSION['idDocumento'] = $array['idDocumento'];
        $_SESSION['telefono'] = $array['telefono'];
        $_SESSION['correo'] = $array['correo'];
        $_SESSION['rol'] = $array['id_rol'];
        $_SESSION['contrasena'] = $numero_documento;
        header('location: ../registrarPrestamoAmbiente.php');
    }else{
        header("location: ../index.php?msg=1");
    }
?>