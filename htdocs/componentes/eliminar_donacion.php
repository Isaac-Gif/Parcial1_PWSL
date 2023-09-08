<?php 
    include "conexion.php";
    include "usuarios.php";
    include "donaciones.php";
    
    session_start();
    
    if(isset($_GET["donacion_id"])) {
        $donacion = obtener_donacion_por_id($_GET["donacion_id"], $conexion);

        if($donacion == null) {
            $_SESSION["noticia"] = "Hubo un error al eliminar la donacion";
        } else {
            if(eliminar_donacion($donacion["id"], $conexion)) {
                $_SESSION["noticia"] = "Se ha eliminado la donacion correctamente";
            } else {
                $_SESSION["noticia"] = "Hubo un error al eliminar la donacion";
            }
        }
    } else {
        $_SESSION["noticia"] = "Hubo un error al eliminar la donacion";
    }

    header("Location: ../vistas/inicio_donaciones.php");
?>