*<?php 
    include "../componentes/conexion.php";
    include "../componentes/usuarios.php";

    session_start();

    if (!isset($_SESSION["usuario_sesion_id"])) {
        $_SESSION["noticia"] = "Inicie sesion porfavor";

        header("Location: ../index.php");
    } else if (!verificar_permisos_de_usuario($_SESSION["usuario_sesion_id"], "modificar", $conexion)) {
        $_SESSION["noticia"] = "No tiene permisos para esta accion";

        header("Location: ../index.php");
    } else if(!isset($_GET["usuario_id"]) || obtener_usuario_por_id($_GET["usuario_id"], $conexion) == null) {
        $_SESSION["noticia"] = "No se ha encontrado el usuario con ese id";

        header("Location: inicio.php");
    } else {
        $usuario = obtener_usuario_por_id($_GET["usuario_id"], $conexion);
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
                    <form action="../componentes/actualizar_usuario.php" method="POST">
                        <input name="usuario_id" type="hidden" class="form-control" id="usuario_id" value="<?php echo $usuario["id"]; ?>">

                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input name="nombres" type="text" class="form-control" id="nombres" required value="<?php echo $usuario["nombres"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input name="apellidos" type="text" class="form-control" id="apellidos" required value="<?php echo $usuario["apellidos"]; ?>">
                        </div>
                        <div class="mb-6">
                            <label for="rol" class="form-label">Rol</label><br>
                            <select id="rol" class="form-control" name="rol">
                                <option value="admin" <?php echo $usuario["rol"] == "admin" ? "selected" : ""; ?>>Admin</option>
                                <option value="rustico" <?php echo $usuario["rol"] == "rustico" ? "selected" : ""; ?>>Rustico</option>
                                <option value="basico" <?php echo $usuario["rol"] == "basico" ? "selected" : ""; ?>>Basico</option>
                            </select>
                        </div><br>
                        <div class="mb-3">
                            <label for="codigo" class="form-label">Codigo</label>
                            <input name="codigo" type="text" class="form-control" id="codigo" required value="<?php echo $usuario["codigo"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email" required value="<?php echo $usuario["email"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="password" required value="<?php echo $usuario["password"]; ?>">
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