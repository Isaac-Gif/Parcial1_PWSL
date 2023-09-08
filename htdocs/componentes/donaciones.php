<?php 
    include "conexion.php";

    function crear_donacion($datos, $conexion) {
        $query = "INSERT INTO donaciones(dui, nombre, direccion, usuario_id,donacion_inicial, donacion_final, descuento_por_gasolina, descuento_por_alimentacion, descuento_por_administracion) VALUES ('". $datos["dui"] ."', '". $datos["nombre"] ."', '".$datos["direccion"]."','".$datos["usuario_id"]."','".$datos["donacion_inicial"]."',
        '".$datos["donacio_final"]."', '".$datos["descuento_por_gasolina"]."','".$datos["descuento_por_alimentacion"]."',
        '".$datos["descuento_por_administracion"]."')";

        $ejecucion = mysqli_query($conexion, $query);

        if($ejecucion) {                
            return true;
        }
            
        return false;
    }

    function modificar_donacion($donacion_id, $datos, $conexion) {
        $query = "UPDATE donaciones SET dui = '". $datos["dui"]."', nombres = '". $datos["nombres"]."', direccion ='". $datos["direccion"]."', usuario_id ='". $datos["usuario_id"]."', donacion_inicial ='". $datos["donacion_inicial"]."', donacion_final ='". $datos["donacion_final"]."', descuento_por_gasolina ='". $datos["descuento_por_gasolina"]."', descuento_por_alimentacion ='". $datos["descuento_por_alimentacion"]."', descuento_por_administracion ='". $datos["descuento_por_administracion"]."' WHERE id = {$descuento_id}";

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

    function obtener_todas_los_donaciones($conexion) {
        $query = "SELECT * FROM donaciones";
        $ejecucion = mysqli_query($conexion, $query);

        if ($ejecucion) {
            return $ejecucion;
        }

        return null;
    }

?>