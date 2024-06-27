<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require('conexion.php');

class Category extends conexion {
    function addingCategory($nombre){
        $query = $this -> getConexion() -> prepare("INSERT INTO categoria(nombre) VALUE ('$nombre')");
        query->execute();}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $data = file_get_contents('php://input');
   $json_data = json_decode($data, true);

   $nombre = $json_data['nombre'];

   $add = new Category();
   $add->addingCategory($nombre);}
?>