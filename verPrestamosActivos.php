<?php 
require_once "./logicaVerPrestamosActivos.php";
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
                <li><a class="dropdown-item" href="./editar_usuario.php">Editar usuarios</a></li>
                <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>


        <?php if (!empty($modificar_observacion)) { ?>

            <div class="modal fade show" id="nueva_observacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir observacion</h1>
                            <a class="btn-registro btn-registro-ambiente" href="verPrestamosActivos.php?idprestamoDocumento=<?php echo $id_prestamo ?>&idEleccion=2"><i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="registro-div registro_usuario-input">
                                <form class="registro registro_usuario" id="registro" action="./procesoAñadirObservacion.php" method="get">
                                    <div class="registro-input registro-usuario-input">
                                        <div class="rgts-input rgts-usuario-input">
                                            <input class="campos-registro" type="hidden" value="<?php echo $row['id_prestamo']; ?>" name="idPrestamo">
                                            <input class="campos-registro" type="hidden" value="verPrestamosActivos.php" name="paginaOrigen">
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


            <!-- MODAL DESCARGAR INFROME -->

            <div class="modal fade" id="descargar_informe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">descargar informe</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="registro-div registro_usuario-input">
                                <form class="registro registro_usuario" id="registro" action="./exportarPrestamosGeneralesAmbientes.php" method="get">
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




            <!-- MODAL NUEVO AMBIENTE -->


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
            <h3 class="titulo_herencia">Historial ambientes </h3>
            <div class="buscador-int">
                <!-- <input class="input-b btns-b" type="searc" placeholder="Buscar"> -->
                <form action="./verPrestamosActivos.php" method="post">
                    <input class="input-b btns-b" placeholder="Buscar" type="text" name="idprestamoDocumento" required>
                    <input type="submit" value="Consultar" name="consultar" class="btn-consultar">

                    <input class="input-b btns-b" type="date" name="fechaInicio">
                    <input class="input-b btns-b" type="date" name="fechaFin">
                    <select class="selec-b btns-b" name="idEleccion" id="">
                        <option value="1">Usuario</option>
                        <option value="2">Prestamo</option>
                    </select>
                </form>




                <button class="btn-b btns-b" data-bs-toggle="modal" data-bs-target="#nuevo_ambiente">Añadir ambiente</button>
                <a href="./registrarPrestamoAmbiente.php" class="btn-activos">Prestar ambiente</a>
                <a href="./registrarPrestamoElementos.php" class="btn-activos">Prestar elementos</a>


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
                    $mostrar_prestamo_id = $estadoPrestamo->obtenerPrestamosAmbienteId($id_prestamo_documento);
                    if ($mostrar_prestamo_id->num_rows < 1) {

                        echo "<script>setTimeout(function(){ alert('Prestamo no encontrado'); }, 100);</script>";
                        # code...
                    }
                } else {



                    $usuarios_filtrados = $mostrarUsuario->filtrarUsuarioIdNombreRol($id_prestamo_documento, NULL);




                    if ($usuarios_filtrados->num_rows < 1) {
                        echo "<script>setTimeout(function(){ alert('Usuario no encontrado'); }, 100);</script>";
                    } elseif ($usuarios_filtrados->num_rows > 1) { ?>


                        <table class="table table-striped table-dark">
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
                                            <a class="btn btn-info bg-success" href="verPrestamosActivos.php?idprestamoDocumento=<?php echo $usuarios_filtrado['numero_documento']; ?>&idEleccion=1" style="color:white">seleccionar usuario</a>

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
                            $mostrar_prestamo_id = $estadoPrestamo->obtenerPrestamosAmbienteUsuarioFecha($usuario['numero_documento'], $_REQUEST['fechaInicio'], $_REQUEST['fechaFin']);
                            // var_dump($mostrar_prestamo_id);
                            if ($mostrar_prestamo_id->num_rows < 1) {

                                echo "<script>setTimeout(function(){ alert('Usuario sin prestamos en esa fecha'); }, 500);</script>";
                                # code...
                            }
                            # code...
                        } else {
                            $usuario = $usuarios_filtrados->fetch_assoc();
                            $mostrar_prestamo_id = $estadoPrestamo->obtenerPrestamosAmbienteId($usuario['numero_documento']);
                            // var_dump($mostrar_prestamo_id);
                            if ($mostrar_prestamo_id->num_rows < 1) {

                                echo "<script>setTimeout(function(){ alert('Usuario sin prestamos '); }, 500);</script>";
                                # code...
                            }
                        } // fin if para fecha o solo usuario 
                    }
                }



                $fecha_inicio = (!empty($_REQUEST['fechaInicio'])) ? $_REQUEST['fechaInicio'] : NULL;
                $fecha_fin = (!empty($_REQUEST['fechaFin'])) ? $_REQUEST['fechaFin'] : NULL;



                if (isset($mostrar_prestamo_id) && $mostrar_prestamo_id->num_rows > 0) { ?>

                    <h4 class="text-center">Prestamos usuario</h4>
                    <div style="display: flex; justify-content: center;">

                        <a class="btn btn-info bg-success" href="descargarExcelPrestamos.php?cedula=<?php echo $_REQUEST['idprestamoDocumento'] ?>&fechaInicio=<?php echo $fecha_inicio ?>&fechaFin=<?php echo $fecha_fin ?>" style="color:white">descargar informe</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" class="text-center">Id prestamo</th>
                                <th scope="col" class="text-center">Responsable</th>
                                <th scope="col" class="text-center">Nombre</th>
                                <th scope="col" class="text-center">Fecha prestamo</th>
                                <th scope="col" class="text-center">Hora prestamo</th>
                                <th scope="col" class="text-center">Ambiente</th>
                                <th scope="col" class="text-center">Fecha entrega</th>
                                <th scope="col" class="text-center">Hora entrega</th>
                                <th scope="col" class="text-center">observaciones</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Acciones</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($fila = $mostrar_prestamo_id->fetch_assoc()) {
                            ?>

                                <tr>

                                    <td class="text-center"><?php echo $fila['id_prestamo']    ?></td>
                                    <td class="text-center"><?php echo $fila['numero_documento']    ?></td>
                                    <td class="text-center"><?php echo $fila['nombre'] . " " . $fila['apellido']    ?></td>
                                    <td class="text-center"><?php echo $fila['fecha_prestamo']    ?></td>
                                    <td class="text-center"><?php echo $fila['hora_prestamo']    ?></td>
                                    <td class="text-center"><?php echo $fila['id_numero_ambiente']    ?></td>
                                    <td class="text-center">
                                        <?php if ($fila['fecha_entrega'] != NULL) {
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

                                    <?php
                                    if ($fila['estado_prestamo'] == "activo") { ?>

                                        <td class="text-center">
                                            <a class="btn btn-info bg-success" href="verPrestamosActivos.php?idPrestamoObservacion=<?php echo $fila['id_prestamo']; ?>" style="color:white">observacion</a>
                                            <a class="btn btn-info bg-success" href="cerrarPrestamoAmbiente.php?idprestamo=<?php echo $fila['id_prestamo']; ?>&idAmbiente=<?php echo $fila['id_numero_ambiente']; ?>" style="color:white">Entregar</a>
                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <td class="text-center">
                                            <a class="btn btn-info bg-success" href="verPrestamosActivos.php?idPrestamoObservacion=<?php echo $fila['id_prestamo']; ?>" style="color:white">observacion</a>
                                        </td>



                                    <?php
                                    } ?>
                                </tr>
                    <?php
                            }
                        }
                    }
                    ?>

                        </tbody>
                    </table>




                    <h4 class="text-center">Prestamos Generales</h4>
                    <div style="display: flex; justify-content: center;">
                        <a href="#" class="btn btn-info bg-success" data-bs-toggle="modal" data-bs-target="#descargar_informe" style="color:white">descargar informe</a>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Id prestamo</th>
                                <th scope="col" class="text-center">Responsable</th>
                                <th scope="col" class="text-center">Nombre</th>

                                <th scope="col" class="text-center">Fecha prestamo</th>
                                <th scope="col" class="text-center">Hora prestamo</th>
                                <th scope="col" class="text-center">Ambiente</th>
                                <th scope="col" class="text-center">Fecha entrega</th>
                                <th scope="col" class="text-center">Hora entrega</th>

                                <th scope="col" class="text-center">observaciones</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Acciones</th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($rows = $mostrar_prestamos->fetch_assoc()) {
                            ?>

                                <tr>

                                    <td class="text-center"><?php echo $rows['id_prestamo']    ?></td>
                                    <td class="text-center"><?php echo $rows['numero_documento']    ?></td>
                                    <td class="text-center"><?php echo $rows['nombre'] . " " . $rows['apellido']    ?></td>
                                    <td class="text-center"><?php echo $rows['fecha_prestamo']    ?></td>
                                    <td class="text-center"><?php echo $rows['hora_prestamo']    ?></td>
                                    <td class="text-center">

                                        <a href="verInformacionAmbiente.php?idAmbiente=<?php echo $rows['id_numero_ambiente']    ?>"><?php echo $rows['id_numero_ambiente']  ?></a>
                                    </td>
                                    <td class="text-center"> <?php if ($rows['fecha_entrega'] != NULL) {
                                                                    echo $rows['fecha_entrega'];
                                                                } else { ?>
                                            <i class="fas fa-exclamation-triangle"></i>
                                        <?php } ?>
                                    </td>


                                    <td class="text-center">

                                        <?php if ($rows['hora_entrega'] != NULL) {
                                            echo $rows['hora_entrega'];
                                        } else { ?>
                                            <i class="fas fa-exclamation-triangle"></i>
                                        <?php } ?>
                                    </td>


                                    <td class="text-center">


                                        <?php if ($rows['observaciones'] != NULL) { ?>
                                            <spa data-bs-toggle="tooltip" data-placement="top" title="<?php echo $rows['observaciones']; ?>">


                                                <i class="fas fa-file"></i>
                                                </span>
                                            <?php } else { ?>
                                                <i class="fas fa-exclamation-triangle"></i>

                                            <?php } ?>
                                    </td>




                                    <td class="text-center"><?php echo $rows['estado_prestamo'] ?></td>

                                    <?php
                                    if ($rows['estado_prestamo'] == "activo") {
                                        # code...

                                    ?>



                                        <td class="text-center">
                                            <a class="btn btn-info bg-success" href="verPrestamosActivos.php?idPrestamoObservacion=<?php echo $rows['id_prestamo']; ?>" style="color:white">observacion</a>
                                            <a class="btn btn-info bg-success" href="cerrarPrestamoAmbiente.php?idprestamo=<?php echo $rows['id_prestamo']; ?>&idAmbiente=<?php echo $rows['id_numero_ambiente']; ?>" style="color:white">Entregar</a>
                                        </td>



                                    <?php
                                    } else { 
                                    ?>

                                        <td class="text-center">
                                            <a class="btn btn-info bg-success" href="verPrestamosActivos.php?idPrestamoObservacion=<?php echo $rows['id_prestamo']; ?>" style="color:white">observacion</a>
                                        </td>
                                    <?php
                                    } 
                                    ?>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>


        </div>
    </div>
    <!-- <div class="barra_inferior">
        </div> -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })



        // Obtener el valor del parámetro 'fechas' de la URL
        var urlParams = new URLSearchParams(window.location.search);
        const fechasParam = urlParams.get('fechas');

        // Verificar si el parámetro 'fechas' está presente
        if (fechasParam !== null) {
            setTimeout(function() {
                var mensaje = "Por favor, ingrese las dos fechas";
                alert(mensaje);
            }, 500);
        }




        // Obtener el valor del parámetro 'fechasCorrectas' de la URL
        var urlParams = new URLSearchParams(window.location.search);
        const fechasCorrectasParam = urlParams.get('fechasCorrectas');

        // Verificar si el parámetro 'fechasCorrectas' está presente
        if (fechasCorrectasParam !== null) {
            setTimeout(function() {
                var mensaje = "Por favor, ingrese las fechas en el rango correcto";
                alert(mensaje);
            }, 100);
        }
    </script>



</body>

</html>