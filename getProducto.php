<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require('conexion.php');

class Producto extends conexion {
    function getProducto(){
        $query = $this -> getConexion() -> query("SELECT nombre_producto, imagen_producto, negocio_id FROM productos");
        $request['producto'] = array();
        if($query -> num_rows > 0){
            for ($i = 0; $i < $query -> num_rows; $i++) { 
                $row = $query -> fetch_assoc();
                $item = array(
                    $row['nombre_producto'],
                    $row['imagen_producto'],
                    $row['negocio_id'],
                );
                array_push($request['producto'], $item);
            }}
        return json_encode($request);}}

$getData = new Producto();
echo $getData -> getProducto();
?>