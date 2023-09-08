<?php 
    include "../componentes/conexion.php";
    include "../componentes/usuarios.php";
    session_start();

    if (!isset($_SESSION["usuario_sesion_id"])) {
        $_SESSION["noticia"] = "Inicie sesion porfavor";

        header("Location: ../index.php");
    }

    $usuarios = obtener_todos_los_usuarios($conexion);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Laboratorio 1 DWSL(U20192080)</title>
    </head>
    <body style="text-align: center;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Mi Sitio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../componentes/cerrar_sesion.php" style="color:red">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    
        <div class="container mt-5">
            <h2 class="text-center">Bienvenido</h2><br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Codigo de estudiante</th>
                            <th>Email</th>
                            <th>Nombre completo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($usuario = $usuarios->fetch_assoc()) {
                                echo "<tr>
                                    <td>". $usuario["id"] ."</td>
                                    <td>". $usuario["codigo"] ."</td>
                                    <td>". $usuario["email"] ."</td>
                                    <td>". $usuario["nombres"] . " " . $usuario["apellidos"]  ."</td>
                                    <td>". $usuario["rol"] ."</td>";
                                    echo "<td>";
                                    if (verificar_permisos_de_usuario($_SESSION["usuario_sesion_id"], "modificar", $conexion)) {
                                        echo "<a href='actualizar.php?usuario_id=". $usuario["id"] ."'><button class='btn btn-warning mx-1'>Editar</button></a>";
                                    }
                                    if (verificar_permisos_de_usuario($_SESSION["usuario_sesion_id"], "eliminar", $conexion)) {
                                        echo "<a href='../componentes/eliminar_usuario.php?usuario_id=". $usuario["id"] ."'><button class='btn btn-danger mx-1'>Eliminar</button></a>";
                                    }
                                    echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php 
                if(isset($_SESSION["noticia"])) {
                    echo "<div class='alert alert-secondary' role='alert'>
                        ".  $_SESSION["noticia"] . "
                    </div>";
                }

                unset($_SESSION["noticia"]);
            ?>
        </div>


    </body>
</html>