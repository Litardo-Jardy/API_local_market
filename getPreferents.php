<?php
require('header.php');

class Preferents extends conexion {
    function getPreferents($id){
        $query = $this -> getConexion() -> query("SELECT nombre_categoria AS nombre FROM preferencia, categoria WHERE persona_id_persona = $id AND id_categoria = categoria_id_categoria");
        $request['preferents'] = array();
        if($query -> num_rows > 0){
            for ($i = 0; $i < $query -> num_rows; $i++) { 
                $row = $query -> fetch_assoc();
                $item = array(
                    $row['nombre']
                );
                array_push($request['preferents'], $item);
            }}
        return json_encode($request);}}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);
 
    $user = $json_data['user'];
 
    $getData = new Preferents();
    echo $getData -> getPreferents($user);}
?>