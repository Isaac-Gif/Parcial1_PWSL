<?php 
    include "../componentes/conexion.php";
    include "../componentes/usuarios.php";
    include "../componentes/donaciones.php";

    session_start();

    if (!isset($_SESSION["usuario_sesion_id"])) {
        $_SESSION["noticia"] = "Inicie sesion porfavor";

        header("Location: ../index.php");
    } else if (!verificar_permisos_de_usuario($_SESSION["usuario_sesion_id"], "modificar", $conexion)) {
        $_SESSION["noticia"] = "No tiene permisos para esta accion";

        header("Location: ../index.php");
    } else if(!isset($_GET["donacion_id"]) || obtener_donacion_por_id($_GET["donacion_id"], $conexion) == null) {
        $_SESSION["noticia"] = "No se ha encontrado la donacion con ese id";

        header("Location: inicio.php");
    } else {
        $donacion = obtener_donacion_por_id($_GET["donacion_id"], $conexion);
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="inicio.php">Atras</a>
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
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="text-center">Formulario</h2>
                    <form action="../componentes/actualizar_donacion.php" method="POST">
                        <input name="donacion_id" type="hidden" class="form-control" id="donacion_id" value="<?php echo $donacion["id"]; ?>">

                        <div class="mb-3">
                            <label for="dui" class="form-label">DUI</label>
                            <input name="dui" type="text" class="form-control" id="dui" required value="<?php echo $donacion["dui"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input name="nombres" type="text" class="form-control" id="nombres" required value="<?php echo $donacion["nombres"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Direccion</label>
                            <input name="direccion" type="text" class="form-control" id="direccion" required value="<?php echo $donacion["direccion"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="donacion_inicial" class="form-label">Donacion Inicial</label>
                            <input name="donacion_inicial" type="text" class="form-control" id="donacion_inicial" required value="<?php echo $donacion["donacion_inicial"]; ?>">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
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
 <!-- Incluye Bootstrap JS (jQuery y Popper.js son necesarios) -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.min.js"></script>