<?php session_start();
if (!isset($_SESSION['numero_documento'])) {
    header("location: ./index.php");
    exit();
}
require_once "./classElemento.php";
require_once "./classUsuario.php";
require_once "./classPrestamo.php";
require_once "./classDetallePrestamo.php";

$mostrarElemento = new Elemento();
$consulta_tipo_dispositivo = $mostrarElemento->tipoElemenento();
$consulta_estado_dispositivo = $mostrarElemento->estadoElemento();
$actualizarElemento = new Elemento();

$mostrarUsuario = new Usuario();
$usuarioFiltrado = new Usuario();

$verificarPrestamosActivos = new Prestamo();
$nuevoPrestamo = new Prestamo();

$detallePrestamo = new DetallePrestamo();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Css/prestamo_dispositivos.css">
    <script src="https://kit.fontawesome.com/503089e863.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200&display=swap" rel="stylesheet">
    <script src="./js/visualizarContrasena.js"></script>

    <title>Gestión de ambientes</title>
    <style>
        .form-busc {
            display: flex;
            align-items: center;
            /* margin-top: 10px; */
        }
    </style>
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

        <div class="modal fade" id="nuevo_dispositivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir nuevo dispositivo</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="registro-div registro_usuario-input">
                            <form class="registro registro_usuario" id="registro" action="./registrarElemento.php" method="post">
                                <div class="registro-input registro-usuario-input">
                                    <div class="rgts-input rgts-usuario-input">
                                        <select class="campos-registro select" name="tipoDispositivo" id="" class="select-registro">
                                            <?php
                                            foreach ($consulta_tipo_dispositivo as $row) { ?>


                                                <option value="<?php echo $row['id_tipo_dispositivo']   ?>"><?php echo $row['tipo_dispositivo']   ?></option>

                                            <?php

                                            }
                                            ?>
                                        </select>
                                        <input class="campos-registro" type="text" placeholder="Serial" name="serial" required>
                                        <input class="campos-registro" type="text" placeholder="Marca" name="marca" required>
                                        <input class="campos-registro" type="text" placeholder="Modelo" class="input-number" name="modelo" required>
                                        <input class="campos-registro" type="text" placeholder="PLaca" class="input-number" name="placa" required>

                                        <select class="campos-registro select" name="estado" id="" class="select-registro">
                                            <?php
                                            foreach ($consulta_estado_dispositivo as $estado) { ?>


                                                <option value="<?php echo $estado['id_estado_elemento']   ?>"><?php echo $estado['estado_elemento']   ?></option>

                                            <?php

                                            }
                                            ?>

                                        </select>

                                        <input class="btn-registro btn-registro-usuario" type="submit" value="Registrar dispositivo" name="enviarElemento">


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
                                            <input id="contrasena" type="password" value="<?php echo $_SESSION['contrasena'] ?>" name="contrasena">
                                            <i id="toggle-icon" class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                                        </div class="toggle-password">
                                        <input class="campos-registro" type="hidden" value="<?php echo $_SESSION['rol'] ?>" placeholder="Contraseña" name="rol">
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
            <h3 class="titulo_herencia">Prestamo de elementos</h3>
            <div class="buscador-int">
                <!-- <input class="input-b btns-b" type="searc" placeholder="Buscar"> -->
                <form class="form-busc" action="./registrarPrestamoElementos.php" method="post">
                    <input class="input-b btns-b" placeholder="Buscar" type="text" id="documento" name="documento" required>
                    <input type="submit" value="Consultar" name="consultar" class="btn-consultar">
                </form>




                <button class="btn-b btns-b" data-bs-toggle="modal" data-bs-target="#nuevo_dispositivo">Añadir dispositivo</button>
                <a href="./verElementosEstaticos.php" class="btn-activos">Elementos </a>
                <a href="./registrarPrestamoAmbiente.php" class="btn-activos">Prestamo de ambientes</a>
                <a href="./verPrestamosElementos.php" class="btn-activos">Historial</a>
                <!-- <a href="./registrarPrestamoElementos.php" class="btn-1 btn-0">Prestamo de dispositivos</a> -->


            </div>

        </div>
        <div class="contenido-ml">








            <?php
            if (!isset($_REQUEST['consultar'])) {



                $Elementos = $mostrarElemento->mostrarElementosDisponibles();


                // var_dump($Elementos);

                if ($Elementos->num_rows == 0) {
                    echo "<center><h2>No hay dispositivos disponibles</h2></center>";
                } else {



            ?> <h4 class="text-center" style="margin-top: 10px;">Dispositivos disponibles</h4>
                    <table class="table">
                        <thead class="table table-striped ">
                            <tr>
                                <th scope="col" class="text-center">Serial</th>
                                <!-- <th scope="col">placa</th> -->
                                <th scope="col" class="text-center">Tipo</th>
                                <th scope="col" class="text-center">Marca</th>
                                <th scope="col" class="text-center">Modelo</th>
                                <th scope="col" class="text-center">Informacion</th>


                            </tr>
                        </thead>
                        <tbody>


                            <?php

                            foreach ($Elementos as $Elemento) {

                            ?>

                                <tr>
                                    <td class="text-center"><?php echo $Elemento['serial']; ?></td>
                                    <td class="text-center"><?php echo $Elemento['tipo_dispositivo'] ?></td>
                                    <td class="text-center"><?php echo $Elemento['marca'] ?></td>
                                    <td class="text-center"><?php echo $Elemento['modelo'] ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-info bg-success" href="ver_elemento.php?serial=<?php echo $Elemento['serial']; ?>" style="color:white">informacion</a>
                                    </td>
                                </tr>

                            <?php

                            }
                            ?>

                        </tbody>
                    </table>





                <?php
                }
                // fin foreach

                //evalua si el buscador envio algun  id , en caso que si guardamos el id capturado
            } else {
                $documento_usuario = $_REQUEST['documento'];

                $usuarios_filtrados = $usuarioFiltrado->filtrarUsuarioIdNombreRol($documento_usuario, 0);




                if ($usuarios_filtrados->num_rows < 1) {

                    header("Location: registrarPrestamoElementos.php?usuario=false");
                } elseif ($usuarios_filtrados->num_rows > 1) { ?>


                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Tipo documento</th>
                                <th scope="col" class="text-center">N° documento</th>
                                <th scope="col" class="text-center">Nombre</th>
                                <th scope="col" class="text-center">Apellido</th>
                                <th scope="col" class="text-center">Correo</th>
                                <th scope="col" class="text-center">Telefono</th>
                                <th scope="col" class="text-center">Rol</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            foreach ($usuarios_filtrados as $usuarios_filtrado) {

                            ?>

                                <tr>
                                    <td class="text-center"><?php echo $usuarios_filtrado['tipo'] ?></td>
                                    <td class="text-center"><?php echo $usuarios_filtrado['numero_documento'] ?></td>
                                    <td class="text-center"><?php echo $usuarios_filtrado['nombre'] ?></td>
                                    <td class="text-center"><?php echo $usuarios_filtrado['apellido'] ?></td>
                                    <td class="text-center"><?php echo $usuarios_filtrado['correo']  ?></td>
                                    <td class="text-center"><?php echo $usuarios_filtrado['telefono']  ?></td>
                                    <td class="text-center"><?php echo $usuarios_filtrado['nombre_rol']  ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-info bg-success" href="RegistrarPrestamoElementos.php?documento=<?php echo $usuarios_filtrado['numero_documento']; ?>&consultar=<?php echo $usuarios_filtrado['numero_documento']; ?>" style="color:white">seleccionar usuario</a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {

                    //    foreach para obtener el numero de cedula del Usuario
                    foreach ($usuarios_filtrados as $usuarios_filtrado) {
                        $cedula = $usuarios_filtrado['numero_documento'];
                    }

                    $obtener_usuario_id = $mostrarUsuario->obtenerUsuarioId($cedula);


                    //   se realiza el llmado del metodo  PrestamoActivoElementosDocumento($cedula); el primero para mostrar solo 
                    // una vez el id 
                    //   del prestamo, el nombre, la cedula y los botones de entrega 
                    $resultadoPrestamoActivos = $verificarPrestamosActivos->PrestamoActivoElementosDocumento($cedula);
                    // el segundo para mostrar los elementos asociados al prestamo 
                    //ya que si el llmado al metodo se realiza solo una vez,al mostrar los campos id 
                    //   del prestamo, el nombre, la cedula y los botones de entrega,en la tabña se muestra apartir de la segunda  fila 

                    $resultadoPrestamoActivo = $verificarPrestamosActivos->PrestamoActivoElementosDocumento($cedula);

                    // var_dump($resultadoPrestamoActivo);
                    if ($resultadoPrestamoActivo->num_rows > 0) {

                        echo "<center><h2>Usuario con prestamos activos </h2></center>";

                        $dato = $resultadoPrestamoActivos->fetch_assoc(); ?>

                        <center>
                            <h3 style="margin: auto;">Prestamo <?php echo $dato['id_prestamo'] ?></h3>
                        </center>


                        <center> <a class="btn btn-info bg-success" href="./VerDetallePrestamoElementos.php?idPrestamo=<?php echo $dato['id_prestamo']; ?>" style="color:white">Detalle Prestamo</a>


                            <a class="btn btn-info bg-success" href="cerrarPrestamoElementos.php?idprestamo=<?php echo $dato['id_prestamo']; ?>" style="color:white">Entregar</a>
                        </center>


                        <h3>cedula: <?php echo $dato['numero_documento']    ?></h3>
                        <h3>nombre: <?php echo $dato['nombre'] . " " . $dato['apellido']   ?></h3>


                        <center>
                            <h3>Elementos</h3>
                        </center>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">cant.</th>
                                    <th scope="col" class="text-center">Elemento</th>
                                    <th scope="col" class="text-center">Tipo dispositivo</th>

                                    <th scope="col" class="text-center">Fecha prestamo</th>
                                    <th scope="col" class="text-center">Hora prestamo</th>
                                    <th scope="col" class="text-center">Observaciones</th>
                                    <th scope="col" class="text-center">Estado</th>



                                </tr>
                            </thead>
                            <?php
                            $cant = 1;
                            while ($datos = $resultadoPrestamoActivo->fetch_assoc()) { ?>


                                <tbody>

                                    <tr>


                                        <td class="text-center"><?php echo $cant ?></td>
                                        <td class="text-center"><?php echo $datos['serial']    ?></td>
                                        <td class="text-center"><?php echo $datos['tipo_dispositivo']    ?></td>
                                        <td class="text-center"><?php echo $datos['fecha_prestamo']    ?></td>
                                        <td class="text-center"><?php echo $datos['hora_prestamo']    ?></td>

                                        <td class="text-center">

                                            <?php if ($datos['observaciones'] != NULL) { ?>
                                                <spa data-bs-toggle="tooltip" data-placement="top" title="<?php echo $datos['observaciones']; ?>">


                                                    <i class="fas fa-file"></i>
                                                    </span>
                                                <?php } else { ?>
                                                    <i class="fas fa-exclamation-triangle"></i>

                                                <?php } ?>
                                        </td>
                                        <td class="text-center" ><?php echo $datos['estado_prestamo'] ?></td>




                                    </tr>
                                </tbody>
                            <?php
                                $cant += 1;
                            }
                            ?>
                        </table>
                        <br>

                    <?php


                        //fin verificacion prestamos



                    } else {


                        $fila = $obtener_usuario_id->fetch_assoc();
                    ?>
                        <form action="./procesoRegistrarPrestamoElementos.php" method="post">




                            <input type="hidden" name="numeroCedula" value=<?php echo $fila['numero_documento'] ?> class="input-number" readonly>
                            <div style="display: flex; justify-content: center;">
                                <h3>Informacion usuario</h3>
                            </div>

                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Tipo documento</th>
                                        <th scope="col" class="text-center">N° documento</th>
                                        <th scope="col" class="text-center">Nombre</th>
                                        <th scope="col" class="text-center">Apellido</th>
                                        <th scope="col" class="text-center">Correo</th>
                                        <th scope="col" class="text-center">Telefono</th>
                                        <th scope="col" class="text-center">Rol</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    foreach ($usuarios_filtrados as $usuarios_filtrado) {

                                    ?>

                                        <tr>
                                            <td class="text-center"><?php echo $usuarios_filtrado['tipo'] ?></td>
                                            <td class="text-center"><?php echo $usuarios_filtrado['numero_documento'] ?></td>
                                            <td class="text-center"><?php echo $usuarios_filtrado['nombre'] ?></td>
                                            <td class="text-center"><?php echo $usuarios_filtrado['apellido'] ?></td>
                                            <td class="text-center"><?php echo $usuarios_filtrado['correo']  ?></td>
                                            <td class="text-center"><?php echo $usuarios_filtrado['telefono']  ?></td>
                                            <td class="text-center"><?php echo $usuarios_filtrado['nombre_rol']  ?></td>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <?php
                            $Elementos = $mostrarElemento->mostrarElementosDisponibles();

                            if ($Elementos->num_rows == 0) {
                                echo "<center><h2>No hay dispositivos disponibles</h2></center>";
                            } else {
                            ?>
                                <div style="display: flex; justify-content: center;">

                                    <h3>Informacion elementos</h3>
                                </div>
                                <div style="display: flex; justify-content: center;">

                                    <input class="btn btn-info bg-success" type="submit" value="prestar" name=prestar style="color:white">
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">serial</th>
                                            <th scope="col">placa</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">marca</th>
                                            <th scope="col">modelo</th>
                                            <th scope="col">seleccionarlo</th>
                                            <th scope="col">Cargador</th>
                                            <th scope="col">Mouse</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php

                                        foreach ($Elementos as $Elemento) {

                                        ?>

                                            <tr>
                                                <td><?php echo $Elemento['serial']; ?></td>
                                                <td><?php echo $Elemento['placa']; ?></td>
                                                <td><?php echo $Elemento['tipo_dispositivo'] ?></td>
                                                <td><?php echo $Elemento['marca'] ?></td>
                                                <td><?php echo $Elemento['modelo'] ?></td>
                                                <td><input type="checkbox" name="equipos[]" value="<?php echo $Elemento['serial']; ?>"></td>
                                                <td><input type="checkbox" name="cargador_<?php echo $Elemento['serial'] ?>" value="si"></td>
                                                <td><input type="checkbox" name="mouse_<?php echo $Elemento['serial'] ?>" value="si"></td>

                                            </tr>

                                        <?php

                                        }
                                        ?>

                                    </tbody>
                                </table>


                                <center><label for="">observaciones</label><br>
                                    <textarea rows="5" cols="50" name="observaciones" placeholder=""></textarea>
                                </center>


                            <?php
                            }
                            ?>


                        </form>



            <?php
                    }
                }
            }


            ?>

        </div>
    </div>
 
    <script>
    var urlParams = new URLSearchParams(window.location.search);
    var registro = urlParams.get('registro');

    if (registro !== null) {
        setTimeout(function() {
            var mensaje = "Prestamo registrado correctamente";
            alert(mensaje);
        }, 100);
    }




    var urlParams = new URLSearchParams(window.location.search);
    const usuarioParam = urlParams.get('usuario');

    if (usuarioParam !== null && usuarioParam === 'false') {
        setTimeout(function() {
            var mensaje = "Usuario no encontrado";
            alert(mensaje);
        }, 500);
    }
</script>

</body>

</html>