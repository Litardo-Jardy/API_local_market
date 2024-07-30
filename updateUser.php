<?php 
require('header.php');

class UpdateUser extends conexion {
    function updateUser($name, $email, $pass, $latitude, $longitude, $image, $id){
      $query = $this -> getConexion() -> prepare("UPDATE 
        persona SET 
        nombre = '$name', 
        correo ='$email', 
        pass ='$pass',
        latitud =$latitude, 
        longitud =$longitude, 
        url ='$image'
        WHERE id_persona = $id");

        $query->execute();
        if ($query->execute()) {
          echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
      } else {
          $errorInfo = $query->errorInfo();
          echo json_encode(['status' => 'error', 'message' => 'Failed to update user', 'error' => $errorInfo]);
      }
      }}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $data = file_get_contents('php://input');
   $json_data = json_decode($data, true);

   $id = $json_data['id'];
   $name = $json_data['name'];
   $email = $json_data['email'];
   $pass = $json_data['pass'];
   $image = $json_data['image'];
   $latitude = $json_data['latitude'];
   $longitude = $json_data['longitude'];

   $add = new UpdateUser();
  $add -> updateUser($name, $email, $pass, $latitude, $longitude, $image, $id);}
?>
