<?php  session_start();
if(!isset($_SESSION['numero_documento'])){
    header("location: ./index.php");
    exit();
}
require_once "./classAmbientes.php";
$verAmbiente = new Ambientes();
$actualizarEstadoAmbiente = new Ambientes();


require_once "./classPrestamo.php";
$verificarPrestamosActivos = new Prestamo();
$nuevoPrestamo = new Prestamo();

require_once "./classUsuario.php";
$mostrarUsuario = new Usuario();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Css/prestamo_ambientes.css">
    <script src="https://kit.fontawesome.com/503089e863.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200&display=swap" rel="stylesheet">
    <script src="./js/funcion.js"></script>
        <script src="./js/visualizarContrasena.js"></script>


    <style>

table input,select {
border: none;

}
</style>


    <title>Gestión de ambientes</title>
</head>

<body>

    <div class="parte-superior">
        <img class="logo" src="./images/logo sena.png" alt="">
        <h1 class="titulo">Gestión de Ambientes</h1>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="perfil" src="./images/Boton Administrador.png" alt="">
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" class="btn-b btns-b" data-bs-toggle="modal" data-bs-target="#editar_perfil">Editar perfil</a></li>
                <li><a class="dropdown-item" href="./ver_usuario.php">Editar usuarios</a></li>
                <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>

    <!-- MODAL NUEVO DISPOSITVO -->


    <div class="modal fade" id="nuevo_ambiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir nuevo ambiente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="registro-div registro_usuario-input">
                            <form class="registro registro_usuario" id="registro" action="./registrarAmbientes.php" method="post">
                                <div class="registro-input registro-usuario-input">
                                    <div class="rgts-input rgts-usuario-input">

                                        <input class="campos-registro" type="text" name="numeroAmbiente" placeholder="numero ambiente" required>
                                        <input class="campos-registro" type="text" name="numeroPiso" placeholder="numero piso" required>
                                        
                                        <select class="campos-registro select" name="lineaFormacion" id="" class="select-registro">
                                            <?php
                                            $lineas_formacion = $verAmbiente->mostrarLineaFormacion();;
                                            foreach ($lineas_formacion as $linea_formacion) {

                                            ?>
                                                <option value="<?php echo $linea_formacion['id_linea']; ?>"> <?php echo $linea_formacion['nombre_linea']; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                        
                                        <input class="campos-registro" type="text" name="cantSillas" placeholder="Cantidad sillas">
                                        <input class="campos-registro" type="text" name="cantMesas" placeholder="Cantidad  mesas">

                                        <select class="campos-registro select" name="estadoAmbiente" id="" class="select-registro">
                                            <?php
                                            $estado_ambientes = $verAmbiente->estadoAmbiente();
                                            foreach ($estado_ambientes as $estado_ambiente) {

                                            ?>
                                                <option value="<?php echo $estado_ambiente['id_estado_ambiente']; ?>"> <?php echo $estado_ambiente['estado_ambiente']; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <input class="btn-registro btn-registro-ambiente" type="submit" value="registrar" name="registrar">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- MODAL EDITAR USUARIO -->

        <div class="modal fade" id="editar_perfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar perfil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="registro-div registro_usuario-input">
                        <form class="registro registro_usuario" id="registro" action="./modificarUsuario.php" method="post">
                            <div class="registro-input registro-usuario-input">
                                <div class="rgts-input rgts-usuario-input">
                                    <select class="campos-registro select" name="tipoDocumento" id="" class="select-registro">
                                        <option value="<?php echo $_SESSION['idDocumento'] ?>"><?php echo $_SESSION['tipoDocumento'] ?></option>
                                        <?php
                                        $resultadoSelect = $mostrarUsuario->obtenerTipoDocumentoDiferenteAlActual($_SESSION['idDocumento']);

                                        foreach ($resultadoSelect as $rows) { ?>
                                            <option value="<?php echo $rows['idDocumento']; ?>"> <?php echo $rows['tipo']; ?></option>

                                        <?php
                                        }

                                        ?>


                                    </select>
                                    <input class="campos-registro" type="number" placeholder="Numero de documento" value="<?php echo $_SESSION['numero_documento'] ?>" name="numeroCedula" class="input-number" readonly>

                                    <input class="campos-registro" type="text" value="<?php echo $_SESSION['nombre'] ?>" placeholder="Nombres" name="nombre">
                                    <input class="campos-registro" type="text" value="<?php echo $_SESSION['apellido'] ?>" placeholder="Apellidos" name="apellido">

                                    <input class="campos-registro" type="number" placeholder="Telefono" value="<?php echo $_SESSION['telefono'] ?>" class="input-number" name="telefono">
                                    <input class="campos-registro" type="email" placeholder="Correo" value="<?php echo $_SESSION['correo'] ?>" name="correo">
                                    <div>
                                    <input  id="contrasena" type="password"  value="<?php echo $_SESSION['contrasena'] ?>" name="contrasena">
                                    <i id="toggle-icon" class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                                    </div class="toggle-password">
                                    <input class="campos-registro" type="hidden" value="<?php echo $_SESSION['rol'] ?>" placeholder="Contraseña" name="rol" >
                                    <input type="submit" class="btn-registro btn-registro-usuario" name="enviar" value="guardar">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                                    </div>



                                    </div>
 
        <div class="herencia">
            <div class="buscador">
                <h3 class="titulo_herencia">Historial</h3>
                <div class="buscador-int">
                    <!-- <input class="input-b btns-b" type="searc" placeholder="Buscar"> -->
                    <form action="./ver_ambiente.php" method="post">
                        <input class="input-b btns-b" placeholder="Buscar" type="number" id="id_ambiente" name="id_ambiente" required>
                        <input type="submit" value="Consultar" name="consultar" class="btn-consultar">
                    </form>

                    <button class="btn-b btns-b" data-bs-toggle="modal" data-bs-target="#nuevo_ambiente">Añadir ambiente</button>

                    <a href="./registrarPrestamoAmbiente.php" class="btn-activos">Prestar ambientes </a>
                    <a href="./registrarPrestamoElementos.php" class="btn-activos">Prestar Elementos </a>
                    


                </div>
                <div class="bd-prestamo-ambientes">
                </div>
            </div>
            <div class="contenido">
            
            <h4 class="text-center mt-2">Ambientes </h4>

            
            <div  style="margin: 5px;">


            <form action="./procesoCargarAmbientes.php" method="post" enctype="multipart/form-data">
                <label for="archivo_excel">Seleccione el archivo Excel:</label>
                <input type="file" name="archivo_excel" id="archivo_excel" accept=".xlsx,.xls">

                <input type="submit" name="submit" value="Procesar">
            </form>
            </div>

            <?php



if (isset($_REQUEST['id_ambiente']) || isset($_REQUEST['consultar'])) {
    $id_ambiente = $_REQUEST['id_ambiente'];

    require_once "./classAmbientes.php";
    $mostrarAmbiente= new Ambientes();
    $ambientes = $mostrarAmbiente->obtenerAmbientePorId($id_ambiente);
    

    if ($ambientes->num_rows < 1) {  ?>
        <script>
     setTimeout(function() {
         var mensaje = "ambiente no encontrado "
         alert(mensaje);
     }, 300);
 </script>
  <?php   
 } else { 




?>

    <form action="./modificarAmbientes.php" method="post">

        
        
    <?php
                foreach ($ambientes as $ambiente_id) {
            ?>

        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">ambiente</th>
                    <th scope="col">piso</th>
                    <th scope="col">linea formacion</th>
                    <th scope="col">sillas</th>
                    <th scope="col">estado</th>
                    <th scope="col">acciones</th>

                </tr>
            </thead>
            <tbody>




                    <tr>

                        <td><input type="text" value="<?php echo $ambiente_id['id_numero_ambiente'] ?>" name="numeroAmbiente" readonly></td>

                      



                        <td><input type="text" value="<?php echo $ambiente_id['piso'] ?>" name="numeroPiso"></td>
                        <td> <select class="" name="lineaFormacion" id="" class="select-registro">
                                            <?php
                                            $lineas_formacion = $verAmbiente->mostrarLineaFormacion();;
                                            foreach ($lineas_formacion as $linea_formacion) {

                                            ?>
                                                <option value="<?php echo $linea_formacion['id_linea']; ?>"> <?php echo $linea_formacion['nombre_linea']; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                        </td>
                            <td><input type="text" value="<?php echo $ambiente_id['cantidad_sillas'] ?>" name="cantSillas"></td>


                        <td><select name="estadoAmbiente" id="">
                                <option value="<?php echo $ambiente_id['id_estado_ambiente'] ?>"><?php echo $ambiente_id['estado_ambiente'] ?> </option>  

                                <?php
                                $estado_ambientes = $mostrarAmbiente->estadoAmbienteDiferenteActual($ambiente_id['id_estado_ambiente']);
                                var_dump($estado_ambientes);
                                foreach ($estado_ambientes as $estado_ambiente) { ?>
                                <option value="<?php echo $estado_ambiente['id_estado_ambiente'] ?>"><?php echo $estado_ambiente['estado_ambiente'] ?> </option>  



                                <?php  
                                } ?>
                            </select></td>
                      
                        <td><input class="btn btn-info bg-success" type="submit" name="modificar" value="Guardar Modificacion" style="color:white">

                            <a class="btn btn-info bg-success" href="eliminarElemento.php?serial=<?php echo $fila['serial']; ?>" style="color:white" onclick="return confirmacionEliminar()">Eliminar</a>
                            

                            <a class="btn btn-info bg-success" href="verInformacionAmbiente.php?idAmbiente=<?php echo $fila['serial']; ?>" style="color:white">informacion</a>

                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>


    </form>


<?php

}
}
?>

        <div class="text-center">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">numero</th>
                            <th scope="col">piso</th>
                            <th scope="col">Linea formacion</th>
                            <th scope="col">estado</th>
                            <th scope="col">acciones</th>




                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        require_once "./classAmbientes.php";
                        $verAmbiente = new Ambientes();
                        $resultado = $verAmbiente->mostrarAmbiente();
                        ?>
                        <?php
                        while ($filas = $resultado->fetch_assoc()) {

                        ?>
                            <tr>
                                <td><?php echo $filas['id_numero_ambiente']; ?></td>
                                <td><?php echo $filas['piso']; ?></td>
                                <td><?php echo $filas['nombre_linea']; ?></td>
                                <td><?php echo $filas['estado_ambiente'] ?></td>

                         
                                    <td><a class="btn btn-info bg-success" href="ver_ambiente.php?id_ambiente=<?php echo $filas['id_numero_ambiente']; ?>" style="color:white">Editar</a>
                                    <a class="btn btn-info bg-success" href="eliminarAmbiente.php?idAmbiente=<?php echo $filas['id_numero_ambiente']; ?>" style="color:white" onclick="return confirmacionEliminar() ">Eliminar</a>

                                    <a class="btn btn-info bg-success" href="verInformacionAmbiente.php?idAmbiente=<?php echo $filas['id_numero_ambiente']; ?>" style="color:white">informacion</a>
                                    <a class="btn btn-info bg-success" href="asociarAmbienteElemento.php?idAmbiente=<?php echo $filas['id_numero_ambiente']; ?>" style="color:white"> + Elementos</a>

                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                </table>
        </div>
        </div>

            </div>
        </div>
    </div>
    <div class="barra_inferior">
    </div>
    <script>
    var urlParams = new URLSearchParams(window.location.search);
    var registroUsuario = urlParams.get('registro');

    if (registroUsuario !== null) {
        setTimeout(function() {
            var mensaje = "Datos registrados exitosamente";
            alert(mensaje);
        }, 500);
    }

// registro Fallido
    var urlParams = new URLSearchParams(window.location.search);
    var registroUsuario = urlParams.get('registroFallido');

    if (registroUsuario !== null) {
        setTimeout(function() {
            var mensaje = "Registro fallido";
            alert(mensaje);
        }, 500);
    }
</script>

</body>

</html>