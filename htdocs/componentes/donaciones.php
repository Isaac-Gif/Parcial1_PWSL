<?php 
    include "conexion.php";

    function crear_donacion($datos, $datos_adicionales, $conexion) {
        $query = "INSERT INTO donaciones(dui, nombres, direccion, usuario_id,donacion_inicial, donacion_final, descuento_por_gasolina, descuento_por_alimentacion, descuento_por_administracion) VALUES ('". $datos["dui"] ."', '". $datos["nombres"] ."', '".$datos["direccion"]."','".$datos_adicionales["usuario_id"]."','".floatval($datos["donacion_inicial"])."',
        '".floatval($datos_adicionales["donacion_final"])."', '".floatval($datos_adicionales["descuento_por_gasolina"])."','".floatval($datos_adicionales["descuento_por_alimentacion"])."',
        '".floatval($datos_adicionales["descuento_por_administracion"])."')";

        $ejecucion = mysqli_query($conexion, $query);

        if($ejecucion) {                
            return true;
        }
            
        return false;
    }

    function modificar_donacion($donacion_id, $datos, $datos_adicionales, $conexion) {
        $query = "UPDATE donaciones SET dui = '". $datos["dui"]."', nombres = '". $datos["nombres"]."', direccion ='". $datos["direccion"]."', usuario_id ='". $datos_adicionales["usuario_id"]."', donacion_inicial ='". floatval($datos["donacion_inicial"])."', donacion_final ='". floatval($datos_adicionales["donacion_final"])."', descuento_por_gasolina ='". floatval($datos_adicionales["descuento_por_gasolina"])."', descuento_por_alimentacion ='". floatval($datos_adicionales["descuento_por_alimentacion"])."', descuento_por_administracion ='". floatval($datos_adicionales["descuento_por_administracion"])."' WHERE id = {$donacion_id}";

        $ejecucion = mysqli_query($conexion, $query);

        if($ejecucion) {                
            return true;
        }
            
        return false;
    }

    function eliminar_donacion($donacion_id, $conexion) {
        $query = "DELETE FROM donaciones WHERE id = {$donacion_id}";

        $ejecucion = mysqli_query($conexion, $query);

        if($ejecucion) {                
            return true;
        }
            
        return false;
    }

    function obtener_todas_las_donaciones($conexion) {
        $query = "SELECT * FROM donaciones";
        $ejecucion = mysqli_query($conexion, $query);

        if ($ejecucion) {
            return $ejecucion;
        }

        return null;
    }

    function obtener_donacion_por_id($donacion_id, $conexion) {
        $query = "SELECT * FROM donaciones WHERE id = {$donacion_id} LIMIT 1";
        $ejecucion = mysqli_query($conexion, $query);

        if ($ejecucion) {
            return $ejecucion->fetch_assoc();
        }

        return null;
    }
?>