<?php 
    include "componentes/conexion.php";
    include "componentes/usuarios.php";
    session_start();

    if (isset($_SESSION["usuario_sesion_id"])) {
        $_SESSION["noticia"] = "Ya has iniciado sesión";
      header("Location: vistas/inicio.php");
    }
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
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center" style="background-color: #343a40;">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Inicio de Sesión</h5>
                    <form action="componentes/iniciar_sesion.php" method="POST">
                        <div class="mb-3">
                            <label for="codigo_o_email" class="form-label">Codigo de estudiante o email</label>
                            <input name="codigo_o_email" type="text" class="form-control" id="codigo_o_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input name="password" type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login" value="login">Iniciar Sesión</button>
                    </form>
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
        </div>
    </body>
</html>