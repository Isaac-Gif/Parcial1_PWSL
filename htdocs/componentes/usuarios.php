<?php 
        function verificar_usuario($codigo_o_email, $password, $conexion) {
           $query = "SELECT * FROM usuarios WHERE (codigo = '{$codigo_o_email}' OR email = '{$codigo_o_email}') AND password = '{$password}' LIMIT 1";
           $ejecucion = mysqli_query($conexion, $query);

           if ($ejecucion) {
                return $ejecucion->fetch_assoc();
           }

           return false;
        }

        function verificar_permisos_de_usuario($usuario_sesion_id, $permiso, $conexion) {
            $usuario = obtener_usuario_por_id($usuario_sesion_id, $conexion);

            if($usuario) {                
                if($usuario["rol"] == "admin") {
                    return true;
                } else if($usuario["rol"] == "rustico" && $permiso == "modificar") {
                    return true;
                }
            }
                
            return false;
        }

        function obtener_usuario_por_id($usuario_sesion_id, $conexion) {
            $query = "SELECT * FROM usuarios WHERE id = {$usuario_sesion_id} LIMIT 1";
            $ejecucion = mysqli_query($conexion, $query);

            if ($ejecucion) {
                return $ejecucion->fetch_assoc();
            }
    
            return null;
        }

        function obtener_todos_los_usuarios($conexion) {
            $query = "SELECT * FROM usuarios";
            $ejecucion = mysqli_query($conexion, $query);

            if ($ejecucion) {
                return $ejecucion;
            }
    
            return null;
        }

        function modificar_usuario($usuario_id, $datos, $conexion) {
            $query = "UPDATE usuarios SET nombres = '". $datos["nombres"]."', apellidos = '". $datos["apellidos"]."', rol ='". $datos["rol"]."', codigo ='". $datos["codigo"]."', email ='". $datos["email"]."', password ='". $datos["password"]."' WHERE id = {$usuario_id}";

            $ejecucion = mysqli_query($conexion, $query);

            if($ejecucion) {                
                return true;
            }
                
            return false;
        }


        function eliminar_usuario($usuario_id, $conexion) {
            $query = "DELETE FROM usuarios WHERE id = {$usuario_id}";

            $ejecucion = mysqli_query($conexion, $query);

            if($ejecucion) {                
                return true;
            }
                
            return false;
        }
?>