<?php
require_once "./logicaVerPrestamosElementos.php";
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
    <script src="./js/visualizarContrasena.js"></script>

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



        <div class="modal fade" id="descargar_informe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">descargar informe</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="registro-div registro_usuario-input">
                            <form class="registro registro_usuario" id="registro" action="./exportarPrestamosGeneralesElementos.php" method="get">
                                <div class="registro-input registro-usuario-input">
                                    <div class="rgts-input rgts-usuario-input">


                                        <select class="campos-registro select" name="Estado" id="" class="select-registro">
                                            <option value="NULL">Todos</option>
                                            <option value="inactivo">Inactivo</option>
                                            <option value="activo">activo</option>



                                        </select>
                                        <label for="">Fecha incial</label>
                                        <input class="campos-registro" type="date" name="FechaInicio">
                                        Fecha final
                                        <input class="campos-registro" type="date" name="FechaFin">



                                        <input class="btn-registro btn-registro-ambiente" type="submit" value="registrar" name="registrar">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php if (!empty($modificar_observacion)) { ?>

            <div class="modal fade show" id="nueva_observacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir observacion</h1>
                            <a class="btn-registro btn-registro-ambiente" href="verPrestamosElementos.php?idprestamoDocumento=<?php echo $id_prestamo ?>&idEleccion=2"><i class="fas fa-times"></i>
                            </a>

                        </div>
                        <div class="modal-body">
                            <div class="registro-div registro_usuario-input">
                                <form class="registro registro_usuario" id="registro" action="./procesoAñadirObservacion.php" method="get">
                                    <div class="registro-input registro-usuario-input">
                                        <div class="rgts-input rgts-usuario-input">
                                            <input class="campos-registro" type="hidden" value="<?php echo $row['id_prestamo']; ?>" name="idPrestamo">
                                            <input class="campos-registro" type="hidden" value="verPrestamosElementos.php" name="paginaOrigen">
                                            <label class="text-center" for="">Ingrese observacion</label>
                                            <label class="text-center" style="color: <?php echo $color; ?>"><?php echo $texto; ?></label>
                                            <textarea rows="15" cols="50" name="observacion" placeholder=""><?php echo $row['observaciones']   ?></textarea>
                                            <input class="btn-registro btn-registro-ambiente" type="submit" value="añadir" name="btnObservacion">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>

            <body class="modal-open">

            <?php } ?>



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





    <!-- <div class="flex"> -->
    <div class="herencia">
        <div class="buscador">
            <h3 class="titulo_herencia">Ambientes activos</h3>
            <div class="buscador-int">
                <!-- <input class="input-b btns-b" type="searc" placeholder="Buscar"> -->
                <form action="./verPrestamosElementos.php" method="post">
                    <input class="input-b btns-b" placeholder="Buscar" type="text" name="idprestamoDocumento" required>
                    <input type="submit" value="Consultar" name="consultar" class="btn-consultar">

                    <input class="input-b btns-b" type="date" name="fechaInicio">
                    <input class="input-b btns-b" type="date" name="fechaFin">
                    <select class="selec-b btns-b" name="idEleccion" id="">
                        <option value="1">Usuario</option>
                        <option value="2">Prestamo</option>
                    </select>
                </form>




                <a href="./ver_elemento.php" class="btn-activos">Ver elementos</a>

                <a href="./registrarPrestamoAmbiente.php" class="btn-activos">Prestar ambiente</a>
                <a href="./registrarPrestamoElementos.php" class="btn-activos">Prestar Elementos</a>


            </div>
            <div class="bd-prestamo-ambientes">
            </div>
        </div>
        <div class="contenido">
            <?php


            if (isset($_REQUEST['idprestamoDocumento']) || isset($_REQUEST['consultar'])) {

                $id_prestamo_documento = $_REQUEST['idprestamoDocumento'];



                if (isset($_REQUEST['idEleccion'])) {
                    $id_eleccion = $_REQUEST['idEleccion'];
                    # code...
                }

                if ($id_eleccion == '2') {
                    $id_prestamo_documento = $_REQUEST['idprestamoDocumento'];
                    // echo "id : hola 2";
                    $mostrar_prestamo_id = $estadoPrestamo->obtenerPrestamosElementosUsuarioIdPrestamo($id_prestamo_documento);
                    if ($mostrar_prestamo_id->num_rows < 1) {

                        echo "<h4>no encontrado</h4>";
                        # code...
                    }
                    // var_dump($mostrar_prestamo_id);

                } else {



                    $usuarios_filtrados = $mostrarUsuario->filtrarUsuarioIdNombreRol($id_prestamo_documento, NULL);




                    if ($usuarios_filtrados->num_rows < 1) {
                        echo "<script>setTimeout(function(){ alert('Usuario no encontrado'); }, 100);</script>";
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
                                            <a class="btn btn-info bg-success" href="verPrestamosElementos.php?idprestamoDocumento=<?php echo $usuarios_filtrado['numero_documento']; ?>&idEleccion=1" style="color:white">seleccionar usuario</a>

                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    } else {

                        if (!empty($_REQUEST['fechaInicio']) || !empty($_REQUEST['fechaFin'])) {


                            $usuario = $usuarios_filtrados->fetch_assoc();
                            $mostrar_prestamo_id = $estadoPrestamo->obtenerPrestamosElementosUsuarioFecha($usuario['numero_documento'], $_REQUEST['fechaInicio'], $_REQUEST['fechaFin']);
                            // var_dump($mostrar_prestamo_id);
                            if ($mostrar_prestamo_id->num_rows < 1) {

                                echo "<script>setTimeout(function(){ alert('Usuario sin prestamos en esa fecha'); }, 500);</script>";
                                # code...
                            }
                            # code...
                        } else {
                            $usuario = $usuarios_filtrados->fetch_assoc();
                            $mostrar_prestamo_id = $estadoPrestamo->obtenerPrestamosElementosUsuarioIdPrestamo($usuario['numero_documento']);
                            // var_dump($mostrar_prestamo_id);
                            if ($mostrar_prestamo_id->num_rows < 1) {

                                echo "<script>setTimeout(function(){ alert('Usuario sin prestamos fin'); }, 500);</script>";
                                # code...
                            }
                        } // fin if para fecha o solo usuario 
                    } //fin else compracion id o usario
                } //fin if formulario 


                $fecha_inicio = (!empty($_REQUEST['fechaInicio'])) ? $_REQUEST['fechaInicio'] : NULL;
                $fecha_fin = (!empty($_REQUEST['fechaFin'])) ? $_REQUEST['fechaFin'] : NULL;


                if (isset($mostrar_prestamo_id) && $mostrar_prestamo_id->num_rows > 0) { ?>

                    <h5 class="text-center">Prestamos usuario</h5>
                    <div style="display: flex; justify-content: center;">
                        <a class="btn btn-info bg-success" href="descargarExcelPrestamoElementos.php?cedula=<?php echo $_REQUEST['idprestamoDocumento'] ?>&fechaInicio=<?php echo $fecha_inicio ?>&fechaFin=<?php echo $fecha_fin ?>" style="color:white">descargar informe</a>
                    </div>



                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Id prestamo</th>
                                <th scope="col" class="text-center">Doc. Responsable</th>
                                <th scope="col" class="text-center">Nom. Responsable</th>
                                <th scope="col" class="text-center">Cantidad elementos</th>
                                <th scope="col" class="text-center">Fecha prestamo</th>
                                <th scope="col" class="text-center">Hora prestamo</th>
                                <th scope="col" class="text-center">Fecha entrega</th>
                                <th scope="col" class="text-center">Hora entrega</th>
                                <th scope="col" class="text-center">observaciones</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Acciones</th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($mostrar_prestamo_id as $filas) {
                            ?>

                                <tr data-toggle="tooltip" title="presiona el id del prestamo para mas informacion">


                                    <td class="text-center"><a href="VerDetallePrestamoElementos.php?idPrestamo=<?php echo $filas['id_prestamo']    ?>"><?php echo $filas['id_prestamo']    ?></a></td>
                                    <td class="text-center"><?php echo $filas['numero_documento']    ?></td>
                                    <td class="text-center"><?php echo $filas['nombre'] . " " . $filas['apellido']    ?></td>
                                    <td class="text-center"><?php echo $filas['cant']  ?></td>
                                    <td class="text-center"><?php echo $filas['fecha_prestamo']    ?></td>
                                    <td class="text-center"><?php echo $filas['hora_prestamo']    ?></td>

                                    <td class="text-center"> <?php if ($filas['fecha_entrega'] != NULL) {
                                                                    echo $filas['fecha_entrega'];
                                                                } else { ?>
                                            <i class="fas fa-exclamation-triangle"></i>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">

                                        <?php if ($filas['hora_entrega'] != NULL) {
                                            echo $filas['hora_entrega'];
                                        } else { ?>
                                            <i class="fas fa-exclamation-triangle"></i>
                                        <?php } ?>
                                    </td>

                                    <td class="text-center">


                                        <?php if ($filas['observaciones'] != NULL) { ?>
                                            <spa data-bs-toggle="tooltip" data-placement="top" title="<?php echo $filas['observaciones']; ?>">


                                                <i class="fas fa-file"></i>
                                                </span>
                                            <?php } else { ?>
                                                <i class="fas fa-exclamation-triangle"></i>

                                            <?php } ?>
                                    </td>

                                    <td class="text-center"><?php echo $filas['estado_prestamo']  ?></td>

                                    <?php
                                    if ($filas['estado_prestamo'] == "activo") { ?>
                                        <!-- <td class="text-center"><?php echo $filas['estado_prestamo']  ?></td> -->

                                        <td class="text-center">
                                            <a class="btn btn-info bg-success" href="verPrestamosElementos.php?idPrestamoObservacion=<?php echo $filas['id_prestamo']; ?>" style="color:white">observacion</a>

                                            <a class="btn btn-info bg-success" href="cerrarPrestamoElementos.php?idprestamo=<?php echo $filas['id_prestamo']; ?>" style="color:white">Entregar</a>
                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <!-- <td class="text-center"><?php echo $filas['estado_prestamo']  ?></td> -->

                                        <td class="text-center">
                                            <a class="btn btn-info bg-success" href="verPrestamosElementos.php?idPrestamoObservacion=<?php echo $filas['id_prestamo']; ?>" style="color:white">observacion</a>
                                        </td>



                                    <?php
                                    } ?>
                                </tr>


                            <?php
                            }

                            ?>
                        </tbody>
                    </table>
            <?php
                }
            }

            ?>




            <h4 class="text-center">Prestamos Generales</h4>
            <div style="display: flex; justify-content: center;">
                <a href="#" class="btn btn-info bg-success" data-bs-toggle="modal" data-bs-target="#descargar_informe" style="color:white">descargar informe</a>
            </div>

            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Id prestamo</th>
                        <th scope="col" class="text-center">Doc. Responsable</th>
                        <th scope="col" class="text-center">Nom. Responsable</th>
                        <th scope="col" class="text-center">Cantidad elementos</th>
                        <th scope="col" class="text-center">Fecha prestamo</th>
                        <th scope="col" class="text-center">Hora prestamo</th>
                        <th scope="col" class="text-center">Fecha entrega</th>
                        <th scope="col" class="text-center">Hora entrega</th>
                        <th scope="col" class="text-center">observaciones</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Acciones</th>


                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($mostrar_prestamos as $fila) {
                    ?>

                        <tr data-toggle="tooltip" title="presiona el id del prestamo para mas informacion">

                            <td class="text-center"><a href="VerDetallePrestamoElementos.php?idPrestamo=<?php echo $fila['id_prestamo']    ?>"><?php echo $fila['id_prestamo']    ?></a></td>
                            <td class="text-center"><?php echo $fila['numero_documento']    ?></td>
                            <td class="text-center"><?php echo $fila['nombre'] . " " . $fila['apellido']    ?></td>
                            <td class="text-center"><?php echo $fila['cant']  ?></td>
                            <td class="text-center"><?php echo $fila['fecha_prestamo']    ?></td>
                            <td class="text-center"><?php echo $fila['hora_prestamo']    ?></td>

                            <td class="text-center"> <?php if ($fila['fecha_entrega'] != NULL) {
                                                            echo $fila['fecha_entrega'];
                                                        } else { ?>
                                    <i class="fas fa-exclamation-triangle"></i>
                                <?php } ?>
                            </td>
                            <td class="text-center">

                                <?php if ($fila['hora_entrega'] != NULL) {
                                    echo $fila['hora_entrega'];
                                } else { ?>
                                    <i class="fas fa-exclamation-triangle"></i>
                                <?php } ?>
                            </td>


                            <td class="text-center">


                                <?php if ($fila['observaciones'] != NULL) { ?>
                                    <spa data-bs-toggle="tooltip" data-placement="top" title="<?php echo $fila['observaciones']; ?>">


                                        <i class="fas fa-file"></i>
                                        </span>
                                    <?php } else { ?>
                                        <i class="fas fa-exclamation-triangle"></i>

                                    <?php } ?>
                            </td>


                            <td class="text-center"><?php echo $fila['estado_prestamo'] ?></td>




                            <td class="text-center">
                                <a class="btn btn-info bg-success" href="verPrestamosElementos.php?idPrestamoObservacion=<?php echo $fila['id_prestamo']; ?>" style="color:white">observacion</a>
                                <!-- <a class="btn btn-info bg-success" href="cerrarPrestamoAmbiente.php?idprestamo=<?php echo $fila['id_prestamo']; ?>&idAmbiente=<?php echo $rows['id_numero_ambiente']; ?>" style="color:white">Entregar</a> -->
                            </td>

                        </tr>



                    <?php

                    }
                    ?>

                </tbody>
            </table>


            <!-- </div> -->
        </div>
        <!-- <div class="barra_inferior">
            
        </div> -->
        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        <?php
        if (isset($_REQUEST['fechasCorrectas'])) { ?>
            <script>
                setTimeout(function() {
                    var mensaje = "Porfavor ingrese las fechas en el rango correcto";
                    alert(mensaje);
                }, 100);
            </script>
        <?php
        }

        if (isset($_GET['fechas'])) { ?>
            <script>
                setTimeout(function() {
                    var mensaje = "Porfavor ingrese las dos fechas";
                    alert(mensaje);
                }, 500);
            </script>
        <?php
        }
        if (isset($_GET['registros'])) { ?>
            <script>
                setTimeout(function() {
                    var mensaje = "no se econtraron registros";
                    alert(mensaje);
                }, 500);
            </script>
        <?php
        }
        ?>

</body>

</html>