<?php 
require('header.php');

class UpdateUser extends conexion {
    function updateUser($name, $email, $pass, $latitude, $longitude, $image, $id ){
      $query = $this -> getConexion() -> prepare("UPDATE 
        persona SET 
        nombre = '$name', 
        correo ='$email', 
        pass ='$pass',
        latitud ='$latitude', 
        longitud ='$longitude', 
        url ='$image'
        WHERE id_persona = $id");
        $query->execute();}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $data = file_get_contents('php://input');
   $json_data = json_decode($data, true);

   $id = $json_data['id'];
   $name = $json_data['name'];
   $email = $json_data['email'];
   $pass = $json_data['pass'];
   $image = $json_data['image'];

   $add = new UpdateUser();
   $add -> updateUser($name, $email, $pass, $latitude, $longitude, $image, $id);}
?>
