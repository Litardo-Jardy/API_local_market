<?php 
require('header.php');

class UpdateNegocio extends conexion {
    function updateNegocio($descripcion, $hora, $dias, $referencia, $image, $id ){
      $query = $this -> getConexion() -> prepare("UPDATE negocio SET
        description_negocio='$descripcion',
        hora_apertura='$hora',
        dias_apertura='$dias',
        referencia_negocio='$referencia',
        image_negocio='$image'
        
        WHERE id_negocio = $id");
       $query->execute();
      }}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $data = file_get_contents('php://input');
   $json_data = json_decode($data, true);

   $id = $json_data['id'];
   $descripcion = $json_data['descripcion'];
   $hora = $json_data['hora'];
   $dias = $json_data['dias'];
   $referencia = $json_data['referencia'];
   $image = $json_data['image'];

   $add = new UpdateNegocio();
   echo $add -> updateNegocio($descripcion, $hora, $dias, $referencia, $image, $id);}
?>
