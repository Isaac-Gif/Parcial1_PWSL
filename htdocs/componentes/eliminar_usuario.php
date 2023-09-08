<?php 
    include "conexion.php";
    include "usuarios.php";
    
    session_start();
    
    if(isset($_GET["usuario_id"])) {
        $usuario = obtener_usuario_por_id($_GET["usuario_id"], $conexion);

        if($usuario == null) {
            $_SESSION["noticia"] = "Hubo un error al eliminar el usuario";
        } else {
            if(eliminar_usuario($usuario["id"], $conexion)) {
                $_SESSION["noticia"] = "Se ha eliminado el usuario correctamente";

                if($_SESSION["usuario_sesion_id"] == $usuario["id"]) {
                    $_SESSION["noticia"] = "Se ha eliminado el usuario en uso";
    
                    unset($_GET);

                    unset($_POST);

                    session_destroy();

                    header("Location: ../index.php");
                }

            } else {
                $_SESSION["noticia"] = "Hubo un error al eliminar el usuario";
            }
        }
    } else {
        $_SESSION["noticia"] = "Hubo un error al eliminar el usuario";
    }

    header("Location: ../vistas/inicio.php");
?>