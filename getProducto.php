<?php
require('header.php');

class Producto extends conexion {
    function getProducto(){
        $query = $this -> getConexion() -> query("SELECT nombre_producto, imagen_producto, negocio_id, precio_producto, descripcion_producto, oferta_producto FROM productos");
        $request['producto'] = array();
        if($query -> num_rows > 0){
            for ($i = 0; $i < $query -> num_rows; $i++) { 
                $row = $query -> fetch_assoc();
                $item = array(
                    $row['nombre_producto'],
                    $row['imagen_producto'],
                    $row['negocio_id'],
                    $row['precio_producto'],
                    $row['descripcion_producto'],
                    $row['oferta_producto']
                );
                array_push($request['producto'], $item);
            }}
        return json_encode($request);}}

$getData = new Producto();
echo $getData -> getProducto();
?>