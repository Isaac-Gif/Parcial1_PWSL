<?php 
    include "conexion.php";
    include "usuarios.php";
    
    session_start();

    if(isset($_POST["usuario_id"])) {
        $usuario = obtener_usuario_por_id($_POST["usuario_id"], $conexion);

        if($usuario == null) {
            $_SESSION["noticia"] = "Hubo un error al modificar el usuario";
        } else {
            if(modificar_usuario($usuario["id"], $_POST, $conexion)) {
                $_SESSION["noticia"] = "Se ha modificado el usuario correctamente";
            } else {
                $_SESSION["noticia"] = "Hubo un error al modificar el usuario";
            }

        }
    } else {
        $_SESSION["noticia"] = "Hubo un error al modificar el usuario";
    }

    header("Location: ../vistas/inicio.php");
?>