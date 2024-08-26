<?php
require('header.php');

class Image extends conexion {
    function addingImage($url, $id){
        $query = $this -> getConexion() -> prepare("INSERT INTO images(image, negocio_id) VALUE ('$url', $negocio_id)");
        query->execute();}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $data = file_get_contents('php://input');
   $json_data = json_decode($data, true);

   $id = $json_data['id'];
   $url = $json_data['url'];

   $add = new Image();
   $add->addingImage($url, $id);}
?>
