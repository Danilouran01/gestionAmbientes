<?php session_start();
if(!isset($_SESSION['numero_documento'])){
    header("location: ./index.php");
    exit();
}

require_once "./classUsuario.php";

$listarUsuario = new Usuario();
$usuarios = $listarUsuario->listarUsuario();
$mostrarUsuario = new Usuario();


 $usuarioFiltrado = new Usuario();

 
$usuarioIndex = new Usuario();
$documento_aprendiz = $usuarioIndex->mostrarTipoDocumentoSelect();
$documento_instructor = $usuarioIndex->mostrarTipoDocumentoSelect();


if (!empty($_REQUEST['documentoModificar'])) {
    $id_documento=$_REQUEST['documentoModificar'];
    $usuario=$usuarioFiltrado->obtenerUsuarioId($id_documento);
    $row_usuario = $usuario->fetch_assoc();
    $modificar_usuario=true;
    
    
    $color = "";
    if (isset($_GET["modificado"]) && $_GET["modificado"]==True) {
            $color = "green";
            $texto = "Modificado";
        } else {
            $color = "red";
            $texto = "No modificado aún";
        }
    } 


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
    <script src="js/funcion.js"></script>
    <script src="./js/visualizarContrasena.js"></script>

    <style>
        table input,
        select {
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
                <li><a class="dropdown-item" href="#">Editar usuarios</a></li>
                <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>



    </div>

   

    <!-- MODAL INSTRUCTOR -->

    <div class="modal fade" id="registrar_instructor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro Instructor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="registro-div registro_usuario-input">
                        <form class="registro registro_usuario" id="registro" method="post" action="./registrarInstructor.php">
                            <div class="registro-input registro-usuario-input">
                                <div class="rgts-input rgts-usuario-input">
                                <input type="hidden" name="paginaOrigen" value="ver_usuario.php" >


                                    <select class="campos-registro" name="tipoDocumento" id="" class="select-registro">

                                        <?php

                                        while ($rows = $documento_instructor->fetch_assoc()) { ?>

                                            <option value="<?php echo $rows['idDocumento'] ?>"><?php echo $rows['tipo']  ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <input class="campos-registro" type="number" placeholder="Numero de documento" class="input-number" name="numeroCedula">
                                    <input class="campos-registro" type="text" placeholder="Nombre" name="nombre">
                                    <input class="campos-registro" type="text" placeholder="Apellido" name="apellido">
                                    <input class="campos-registro" type="number" placeholder="Telefono" class="input-number" name="telefono">
                                    <input class="campos-registro" type="email" placeholder="Correo" name="correo">
                                    <input class="btn-registro btn-registro-usuario" type="submit" value="Registrarse" name="enviar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL ADMINISTRADOR -->

    <div class="modal fade" id="registrar_administrador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro administrador</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="registro-div registro_usuario-input">
                    <form class="registro registro_usuario" id="registro" method="post" action="./registrarAdmin.php">
                            <div class="registro-input registro-usuario-input">
                                <div class="rgts-input rgts-usuario-input">
<input type="hidden" name="paginaOrigen" value="ver_usuario.php" >
                                    <select class="campos-registro" name="tipoDocumento" id="" class="select-registro">

                                        <?php

                                        while ($row = $documento_aprendiz->fetch_assoc()) { ?>

                                            <option value="<?php echo $row['idDocumento'] ?>"><?php echo $row['tipo']  ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <input class="campos-registro" type="number" placeholder="Numero de documento" class="input-number" name="numeroDocumento">

                                    <input class="campos-registro" type="text" placeholder="Nombre" name="nombre">
                                    <input class="campos-registro" type="text" placeholder="Apellido" name="apellido">


                                    <input class="campos-registro" type="number" placeholder="Telefono" class="input-number" name="telefono">
                                    <input class="campos-registro" type="email" placeholder="Correo" name="correo">
                                    <input class="campos-registro" type="password" placeholder="Contraseña" name="contrasena">


                                    <input class="btn-registro btn-registro-usuario" type="submit" value="Registrarse" name="registrar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- MODAL REGISTRO APRENDIZ -->


    <div class="modal fade" id="registrar_aprendiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro invitado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="registro-div registro_usuario-input">
                        <form class="registro registro_usuario" id="registro" method="post" action="./registrarInvitado.php">
                            <div class="registro-input registro-usuario-input">
                                <div class="rgts-input rgts-usuario-input">
<input type="hidden" name="paginaOrigen" value="ver_usuario.php" >
                                    <select class="campos-registro" name="tipoDocumento" id="" class="select-registro">

                                        <?php

                                        while ($row = $documento_aprendiz->fetch_assoc()) { ?>

                                            <option value="<?php echo $row['idDocumento'] ?>"><?php echo $row['tipo']  ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <input class="campos-registro" type="number" placeholder="Numero de documento" class="input-number" name="numeroCedula">

                                    <input class="campos-registro" type="text" placeholder="Nombre" name="nombre">
                                    <input class="campos-registro" type="text" placeholder="Apellido" name="apellido">


                                    <input class="campos-registro" type="text" placeholder="Centro" class="input-number" name="centro">
                                    <input class="campos-registro" type="number" placeholder="Telefono" class="input-number" name="telefono">
                                    <input class="campos-registro" type="email" placeholder="Correo" name="correo">


                                    <input class="btn-registro btn-registro-usuario" type="submit" value="Registrarse" name="enviar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL EDITAR PERFIL -->


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


    <!-- MODAL EDITAR usuario -->


    <?php if (!empty($modificar_usuario)) { ?>

<div class="modal fade show" id="nueva_observacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar <?php echo $row_usuario['nombre_rol'] ?></h1>
        <a class="btn-registro btn-registro-ambiente" href="ver_usuario.php"><i class="fas fa-times"></i>
</a>
      </div>
      <div class="modal-body">
        <div class="registro-div registro_usuario-input">
        <form class="registro registro_usuario" action="./modificarUsuario.php" method="post">
  <div class="registro-input registro-usuario-input">
    <div class="rgts-input rgts-usuario-input">
     <h5 class="text-center" style="color: <?php echo $color; ?>"><?php echo $texto; ?> </h5>

      <label for="tipoDocumento">Tipo documento</label>
      <select name="tipoDocumento" class="campos-registro select">
        <option value="<?php echo $row_usuario['idDocumento']; ?>"><?php echo $row_usuario['tipo'] ?></option>
        <?php
        $resultadoSelect = $listarUsuario->obtenerTipoDocumentoDiferenteAlActual($row_usuario['idDocumento']);
        foreach ($resultadoSelect as $rows) { ?>
          <option value="<?php echo $rows['idDocumento']; ?>"><?php echo $rows['tipo']; ?></option>
        <?php } ?>
      </select>

      <label for="numeroCedula">N° documento</label>
      <input type="text" name="numeroCedula" value="<?php echo $row_usuario['numero_documento'] ?>" readonly>

      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" value="<?php echo $row_usuario['nombre'] ?>">

      <label for="apellido">Apellido</label>
      <input type="text" name="apellido" value="<?php echo $row_usuario['apellido'] ?>">

      <label for="correo">Correo</label>
      <input type="text" name="correo" value="<?php echo $row_usuario['correo'] ?>">

      <label for="telefono">Teléfono</label>
      <input type="text" name="telefono" value="<?php echo $row_usuario['telefono'] ?>">

      <!-- <?php if ($row_usuario['contrasena'] != NULL) { ?> -->
        <label for="contrasena">Contraseña</label>
        <input type="text" name="contrasena" value="<?php echo $row_usuario['contrasena'] ?>">
      <!-- <?php } ?> -->

      <?php if ($row_usuario['numero_ficha'] != NULL) { ?>
        <label for="ficha">N° ficha</label>
        <input type="text" name="ficha" value="<?php echo $row_usuario['numero_ficha'] ?>">
      <?php } ?>

      <?php if ($row_usuario['centro'] != NULL) { ?>
        <label for="centro">Centro</label>
        <input type="text" name="centro" value="<?php echo $row_usuario['centro'] ?>">
      <?php } ?>

      <label for="rol">Rol</label>
      <select name="rol" class="select-registro">
        <option value="<?php echo $row_usuario['id_rol']; ?>"><?php echo $row_usuario['nombre_rol'] ?></option>
      </select>

      <input type="submit" class="btn btn-info bg-success" name="enviar" value="Guardar" style="color:white">
      <a class="btn btn-info bg-success" href="eliminarUsuario.php?documento=<?php echo $row_usuario['numero_documento']; ?>" style="color:white" onclick="return confirmacionEliminar()">Eliminar</a>
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




    <!-- <div class="flex"> -->
    <div class="herencia">
        <div class="buscador">
            <h3 class="titulo_herencia">Editar usuario</h3>
            <div class="buscador-int">
                <!-- <input class="input-b btns-b" type="searc" placeholder="Buscar"> -->
                <form action="./ver_usuario.php" method="post">
                    <!-- <input class="input-b btns-b" placeholder="Buscar" type="number" id="documento" name="documento" required>
                        <input type="submit" value="Consultar" name="consultar" class="btn-consultar"> -->

                    <input class="input-b btns-b" type="text" placeholder="Buscar" name="documento">





                    <select class="selec-b btns-b" name="rol" id="">
                        <option value="0">Todos</option>
                        <option value="1">Administradores</option>
                        <option value="2">instructores</option>
                        <option value="3">Invitado</option>

                    </select>

                    <input type="submit" value="Consultar" name="consultar" class="btn-consultar">

                </form>
                <button class="btn-b btns-b" data-bs-toggle="modal" data-bs-target="#registrar_aprendiz">Registrar invitado</button>
                <button class="btn-b btns-b" data-bs-toggle="modal" data-bs-target="#registrar_instructor">Registrar instructor</button>
                <button class="btn-b btns-b" data-bs-toggle="modal" data-bs-target="#registrar_administrador">Registrar administrador</button>
                <a href="./registrarPrestamoAmbiente.php" class="btn-activos">Prestar ambiente</a>

            </div>
            <div class="bd-prestamo-ambientes">
            </div>
        </div>
        <div class="contenido">
            <div  style="margin: 5px;">
            <form action="./procesoCargarUsuarios.php" method="post" enctype="multipart/form-data">
                <label for="archivo_excel">Seleccione el archivo Excel:</label>
                <input type="file" name="archivo_excel" id="archivo_excel" accept=".xlsx,.xls">

                <input type="submit" name="submit" value="Procesar">
            </form>
            </div>

            <?php
            if (isset($_REQUEST['consultar'])  || isset($_REQUEST['documento'])) {


                $busqueda = $_REQUEST['documento'];


                if ($busqueda == "") {
                    $busqueda = 0;
                }



                if (isset($_REQUEST['rol'])) {
                    $rol = $_REQUEST['rol'];

                  
                } else {
                    $rol = 0;
                }

          



                $usuarios_filtrados = $usuarioFiltrado->filtrarUsuarioIdNombreRol($busqueda, $rol);
                

                if ($usuarios_filtrados->num_rows < 1) {
                    echo "<script>setTimeout(function(){ alert('Usuario no encontrado'); }, 100);</script>";

                } else {



                    if ($usuarios_filtrados->num_rows == 1) {
                      $resultado_usuario=$usuarios_filtrados->fetch_assoc();
                      $documentos=$resultado_usuario['numero_documento'];

                        header("Location: ver_usuario.php?documentoModificar=$documentos");
            ?>




                        <?php


                        foreach ($usuarios_filtrados as $usuarios_filtrado) {

                        ?>

                            <center>
                                <div style=" width: 50%;" class="col-sm-6 mx-auto">

                                

                                


                    

                                </div>
                            </center><br>



                        <?php
                        }
                        ?>





                    <?php

                    } else { ?>



                        <?php
                        ?>













                        <table class="table ">
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
                                            <a class="btn btn-info bg-success" href="ver_usuario.php?documentoModificar=<?php echo $usuarios_filtrado['numero_documento']; ?>" style="color:white">Editar</a>

                                            <a class="btn btn-info bg-success" href="eliminarUsuario.php?documento=<?php echo $usuarios_filtrado['numero_documento']; ?>" style="color:white" onclick="return confirmacionEliminar() ">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>


                        </tbody>
                        </table>


            <?php
                    }
                }
            }
            ?>

            <!--   //  falta estilo -->

            <center>
                <h3>Usuarios</h3>
            </center>


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


                    foreach ($usuarios as $usuario) {

                    ?>
                        <tr>
                            <td class="text-center"><?php echo $usuario['tipo'] ?></td>
                            <td class="text-center"><?php echo $usuario['numero_documento'] ?></td>
                            <td class="text-center"><?php echo $usuario['nombre'] ?></td>
                            <td class="text-center"><?php echo $usuario['apellido'] ?></td>
                            <td class="text-center"><?php echo $usuario['correo']  ?></td>
                            <td class="text-center"><?php echo $usuario['telefono']  ?></td>
                            <td class="text-center"><?php echo $usuario['nombre_rol']  ?></td>
                            <td class="text-center">
                                <a class="btn btn-info bg-success" href="ver_usuario.php?documentoModificar=<?php echo $usuario['numero_documento']; ?>" style="color:white">Editar</a>
                                <!-- <?php echo $usuario['id_rol'] ?> -->

                                <!-- <a  class="btn btn-info bg-success"href="#" class="btn-b btns-b" data-bs-toggle="modal" data-bs-target="#editar_usuario" data-id="<?php echo $usuario['numero_documento'];   ?>">Editar</a> -->

                                <a class="btn btn-info bg-success" href="eliminarUsuario.php?documento=<?php echo $usuario['numero_documento']; ?>" style="color:white" onclick="return confirmacionEliminar() ">Eliminar</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>


            </tbody>
            </table>




<!-- 


        </div> -->
    </div>
    <!-- </div> -->
    <div class="barra_inferior">
    </div>


<script>
    var urlParams = new URLSearchParams(window.location.search);
    var registroUsuario = urlParams.get('registroUsuario');

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