<?php 
    include "../componentes/conexion.php";
    include "../componentes/usuarios.php";
    include "../componentes/donaciones.php";
    
    session_start();

    if (!isset($_SESSION["usuario_sesion_id"])) {
        $_SESSION["noticia"] = "Inicie sesion porfavor";

        header("Location: ../index.php");
    }

    $donaciones = obtener_todos_las_donaciones($conexion);
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
            <h2 class="text-center">Bienvenido al area de donaciones</h2><br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Dui</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Usuario id</th>
                            <th>Donacion inicial</th>
                            <th>Donacion Final</th>
                            <th>Descuento por gasolina</th>
                            <th>Descuento por alimentacion</th>
                            <th>Descuento por administracion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($donacion = $donaciones->fetch_assoc()) {
                                echo "<tr>
                                    <td>". $donacion["dui"] ."</td>
                                    <td>". $donacion["nombres"] ."</td>
                                    <td>". $donacion["direccion"] ."</td>
                                    <td>". $donacion["usuario_id"]."</td>
                                    <td>". $donacion["donacion_inicial"]."</td>
                                    <td>". $donacion["donacion_final"]."</td>
                                    <td>". $donacion["descuento_por_gasolina"]."</td>
                                    <td>". $donacion["descuento_por_alimentacion"]."</td>
                                    <td>". $donacion["descuento_por_administracion"] ."</td>";
                                    echo "<td>";
                                    if (verificar_permisos_de_usuario($_SESSION["usuario_sesion_id"], "modificar", $conexion)) {
                                        echo "<a href='actualizar_donacion.php?donacion_id=". $donacion["id"] ."'><button class='btn btn-warning mx-1'>Editar</button></a>";
                                    }
                                    if (verificar_permisos_de_usuario($_SESSION["usuario_sesion_id"], "eliminar", $conexion)) {
                                        echo "<a href='../componentes/eliminar_donacion.php?donacion_id=". $donacion["id"] ."'><button class='btn btn-danger mx-1'>Eliminar</button></a>";
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