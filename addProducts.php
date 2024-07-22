<?php 
require('header.php');

class Products extends conexion {
    function addingProducts($id_negocio, $nombre, $descripcion, $precio, $imagen, $oferta ){
        $query = $this -> getConexion() -> prepare("INSERT INTO productos(nombre_producto, descripcion_producto, precio_producto, imagen_producto, oferta_producto, negocio_id)
         VALUE ('$nombre', '$descripcion', $precio, '$imagen', '$oferta', $id_negocio)");
        $query->execute();}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $data = file_get_contents('php://input');
   $json_data = json_decode($data, true);

   $id_negocio = $json_data['id_negocio'];
   $nombre = $json_data['nombre'];
   $descripcion = $json_data['descripcion'];
   $precio = $json_data['precio'];
   $imagen = $json_data['imagen'];
   $oferta = $json_data['oferta'];

   $add = new Products();
   $add -> addingProducts($id_negocio, $nombre, $descripcion, $precio, $imagen, $oferta);}
?>