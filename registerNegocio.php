<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require('conexion.php');

class Register extends conexion{
    function registerNegocio($nombre, $correo, $pass, $latitud, $longitud, $tipo, 
    $referencia, $horaApertura, $diasApertura, $descripcion, $categoria){
        $queryOne = $this -> getConexion() -> prepare("INSERT INTO persona(nombre, correo, pass, latitud, longitud, tipo) VALUES ('$nombre', '$correo', '$pass', $latitud, $longitud, $tipo) ");
        $queryOne->execute();
        $personaId = $this -> getConexion() -> insert_id;

        $queryTwo = $this->getConexion()->query("SELECT id_categoria FROM categoria WHERE nombre_categoria ='$categoria'");
        $categoriaId = $queryTwo->fetch_assoc();
        $idCategoria = $categoriaId['id_categoria'];

        $query = $this -> getConexion() -> prepare("INSERT INTO negocio(description_negocio, hora_apertura, dias_apertura, referencia_negocio, persona_id, categoria_id) VALUES ('$descripcion', '$horaApertura', '$diasApertura', '$referencia', $personaId, $idCategoria)");
        $query->execute();}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);
 
    $nombre = $json_data['user'];
    $correo = $json_data['correo'];
    $pass = $json_data['pass'];
    $latitud = $json_data['latitud'];
    $longitud = $json_data['longitud'];
    $tipo = $json_data['tipo'];
    $referencia = $json_data['referencia'];
    $horaApertura = $json_data['horaApertura'];
    $diasApertura = $json_data['diasApertura'];
    $descripcion = $json_data['descripcion'];
    $categoria = $json_data['categoria'];

 
    $register = new Register();
    $register -> registerNegocio($nombre, $correo, $pass, $latitud, $longitud, $tipo, $referencia, $horaApertura, $diasApertura, $descripcion, $categoria);}
?>