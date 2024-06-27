<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require('conexion.php');

class Preferens extends conexion {
    function addingPreferens($persona, $categoria){
        $queryTwo = $this->getConexion()->query("SELECT id_categoria FROM categoria WHERE nombre_categoria ='$categoria'");
        $categoriaId = $queryTwo->fetch_assoc();
        $idCategoria = $categoriaId['id_categoria'];

        $query = $this -> getConexion() -> prepare("INSERT INTO preferencia (persona_id_persona, categoria_id_categoria) VALUE ($persona, $idCategoria)");
        $query->execute();}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $data = file_get_contents('php://input');
   $json_data = json_decode($data, true);

   $persona = $json_data['persona'];
   $categoria = $json_data['categoria'];

   $add = new Preferens();
   $add -> addingPreferens($persona, $categoria);}
?>