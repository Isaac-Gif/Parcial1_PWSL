<?php 
    include "conexion.php";
    include "usuarios.php";
    include "donaciones.php";
    
    session_start();

    if(isset($_POST["donacion_id"])) {
        $donacion = obtener_donacion_por_id($_POST["donacion_id"], $conexion);

        if($donacion == null) {
            $_SESSION["noticia"] = "Hubo un error al modificar la donacion";
        } else {
            $descuento_por_gasolina = (floatval($_POST["donacion_inicial"])* 0.05);
            $descuento_por_alimentacion = (floatval($_POST["donacion_inicial"])* 0.10);
            $descuento_por_administracion = (floatval($_POST["donacion_inicial"])* 0.15);
            $donacion_final = (floatval($_POST["donacion_inicial"]) - ($descuento_por_gasolina + $descuento_por_alimentacion + $descuento_por_administracion));
            $datos_adicionales = array("usuario_id" => intval($_SESSION["usuario_sesion_id"]), "descuento_por_gasolina" => $descuento_por_gasolina, "descuento_por_alimentacion" => $descuento_por_alimentacion, "descuento_por_administracion" => $descuento_por_administracion, "donacion_final" => $donacion_final);

            if(modificar_donacion($donacion["id"], $_POST, $datos_adicionales, $conexion)) {
                $_SESSION["noticia"] = "Se ha modificado la donacion correctamente";
            } else {
                $_SESSION["noticia"] = "Hubo un error al modificar la donacion";
            }

        }
    } else {
        $_SESSION["noticia"] = "Hubo un error al modificar la donacion";
    }

    header("Location: ../vistas/inicio_donaciones.php");
?>