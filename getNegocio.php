<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require('conexion.php');

class Negocio extends conexion {
    function getNegocio($N_latitude, $S_latitude, $N_longitude, $S_longitude){
        $query = $this -> getConexion() -> query("SELECT nombre, correo, url, latitud, longitud, description_negocio, dias_apertura, hora_apertura, nombre_categoria FROM negocio, persona, categoria WHERE id_persona = persona_id AND id_categoria = categoria_id AND ( latitud > $S_latitude AND latitud < $N_latitude ) AND ( longitud > $S_longitude AND longitud < $N_longitude);");
        $request['negocio'] = array();
        if($query -> num_rows > 0){
            for ($i = 0; $i < $query -> num_rows; $i++) { 
                $row = $query -> fetch_assoc();
                $item = array(
                    $row['nombre'],
                    $row['correo'],
                    $row['url'],
                    strval($row['latitud']),
                    strval($row['longitud']),
                    $row['description_negocio'],
                    $row['dias_apertura'],
                    $row['hora_apertura'],
                    $row['nombre_categoria']
                );
                array_push($request['negocio'], $item);
            }}
        return json_encode($request);}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);
 
    $N_latitude = $json_data['N_latitude'];
    $S_latitude = $json_data['S_latitude'];
    $N_longitude = $json_data['N_longitude'];
    $S_longitude = $json_data['S_longitude'];
 
    $getData = new Negocio();
    echo $getData -> getNegocio($N_latitude, $S_latitude, $N_longitude, $S_longitude);}
?>