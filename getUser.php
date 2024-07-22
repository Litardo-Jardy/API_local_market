<?php
require('header.php');

class User extends conexion {
    function getUser($user, $pass, $id_user){
        $query = $this -> getConexion() -> query("SELECT 
        p.id_persona AS id, 
        p.nombre As nombre, 
        p.correo AS correo, 
        p.pass AS pass, 
        p.latitud AS latitud, 
        p.longitud AS longitud, 
        p.tipo AS tipo, 
        p.url AS url, 
        COALESCE(n.id_negocio, 0) AS negocio 
        
        FROM persona p 
        LEFT JOIN negocio n 
        ON p.id_persona = n.persona_id 
        WHERE (p.correo = '$user' AND p.pass = '$pass') OR p.id_persona = $id_user");

        $request['user'] = array();
        if($query -> num_rows > 0){
            for ($i = 0; $i < $query -> num_rows; $i++) { 
                $row = $query -> fetch_assoc();
                $item = array(
                    $row['id'],
                    $row['nombre'],
                    $row['correo'],
                    $row['pass'],
                    $row['latitud'],
                    $row['longitud'],
                    $row['tipo'],
                    $row['url'],
                    $row['negocio']
                );
                array_push($request['user'], $item);
            }
        }else{
            $item = array("0");
            array_push($request['user'], $item);}

        return json_encode($request);}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);
 
    $user = $json_data['user'];
    $pass = $json_data['pass'];
    $id_user = $json_data['id'];

    $getData = new User();
    echo $getData -> getUser($user, $pass, $id_user);}
?>