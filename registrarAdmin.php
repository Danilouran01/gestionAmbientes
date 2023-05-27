
    <?php
   require "./classAdministrador.php";

    if (isset($_POST['registrar'])) {
$contrasena=$_POST['Contrasena'];
$pagina_origen=$_POST['paginaOrigen'];

        $admin = new Administrador();
        $admin->tipoDocumento=$_POST['tipoDocumento'];
        $admin->numeroDocumento=$_POST['numeroDocumento'];
        $admin->nombre=$_POST['nombre'];
        $admin->apellido=$_POST['apellido'];
        $admin->telefono=$_POST['telefono'];
        $admin->correo=$_POST['correo'];
        $admin->setContrasena($contrasena);
        $admin->rol=1;
        $admin->setFicha(0);
        $admin_registrado=$admin->registrarUsuario();

        if ($pagina_origen=="ver_usuario.php") {
            header("Location:ver_usuario.php?registroUsuario=$admin_registrado");
        }
    }

    ?>

