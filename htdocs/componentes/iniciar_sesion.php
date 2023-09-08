<?php 
    include "conexion.php";
    include "usuarios.php";
    
    session_start();

    if(isset($_POST["login"])) {
        $usuario = verificar_usuario($_POST["codigo_o_email"], $_POST["password"], $conexion);

        if($usuario == false) {
            $_SESSION["noticia"] = "Datos incorrectos";

            header("Location: ../index.php");
        } else {
            $_SESSION["noticia"] = "Ha iniciado session correctamente";
            $_SESSION["usuario_sesion_id"] = $usuario["id"];

            header("Location: ../vistas/inicio.php");
        }
    }
?>