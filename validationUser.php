<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require('conexion.php');

class User extends conexion {
    function validateUser($user, $pass){
        $query = $this -> getConexion() -> query("SELECT * FROM persona WHERE correo = '$user' AND pass = '$pass'");
        $request['validation'] = array();
        if($query -> num_rows > 0){
            for ($i = 0; $i < $query -> num_rows; $i++) { 
                $row = $query -> fetch_assoc();
                $item = array(
                    $row['id_persona']);
                array_push($request['validation'], $item);}
        }else{
            $item = array(0);
            array_push($request['validation'], $item);
        }
    return json_encode($request);}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $data = file_get_contents('php://input');
   $json_data = json_decode($data, true);

   $user = $json_data['user'];
   $pass = $json_data['pass'];

   $validation = new User();
   echo $validation -> validateUser($user, $pass);}
?>
