<?php 
require('header.php');

class Register extends conexion{
    function registerClient($nombre, $correo, $pass, $latitud, $longitud, $tipo){
        //Hacer consultas para persona y para buscar categoria;
        $query = $this -> getConexion() -> prepare("INSERT INTO persona(nombre, correo, pass, latitud, longitud, tipo) VALUES ('$nombre', '$correo', '$pass', $latitud, $longitud, $tipo) ");
        $query->execute();
        return $this->getConexion() -> insert_id;
    }
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);
 
    $nombre = $json_data['user'];
    $correo = $json_data['correo'];
    $pass = $json_data['pass'];
    $latitud = $json_data['latitud'];
    $longitud = $json_data['longitud'];
    $tipo = $json_data['tipo'];
    $register = new Register();
    $id = $register -> registerClient($nombre, $correo, $pass, $latitud, $longitud, $tipo);
    
    if ($id !== false) {
        echo json_encode(['id' => $id]);
    } else {
        echo json_encode(['error' => 'Failed to register user']);
    }
}
?>