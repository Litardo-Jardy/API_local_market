<?php
require('header.php');

class Negocio extends conexion {
    function getNegocio($N_latitude, $S_latitude, $N_longitude, $S_longitude){
        $query = $this -> getConexion() -> query("SELECT 
        persona.nombre AS nombre, 
        persona.correo AS correo,
        persona.url AS url, 
        persona.latitud AS latitud, 
        persona.longitud AS longitud, 
        negocio.description_negocio AS description_negocio, 
        negocio.dias_apertura AS dias_apertura, 
        negocio.hora_apertura AS hora_apertura, 
        categoria.nombre_categoria AS nombre_categoria, 
        negocio.image_negocio AS image_negocio, 
        negocio.id_negocio AS id_negocio, 
        ROUND(COALESCE(AVG(reseñas.calificacion_reseña), 0), 1) AS calificacion 

        FROM 
        local_market.negocio JOIN local_market.persona ON negocio.persona_id = persona.id_persona 
        JOIN local_market.categoria ON negocio.categoria_id = categoria.id_categoria 
        LEFT JOIN local_market.reseñas ON negocio.id_negocio = reseñas.negocio_id 

        WHERE 
        persona.latitud > $S_latitude 
        AND persona.latitud < $N_latitude 
        AND persona.longitud > $S_longitude 
        AND persona.longitud < $N_longitude

        GROUP BY 
        negocio.id_negocio, 
        persona.nombre, 
        persona.correo, 
        persona.url, 
        persona.latitud, 
        persona.longitud, 
        negocio.description_negocio, 
        negocio.dias_apertura, 
        negocio.hora_apertura, 
        categoria.nombre_categoria, 
        negocio.image_negocio;");

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
                    $row['description_negocio'],//5
                    $row['dias_apertura'],
                    $row['hora_apertura'],
                    $row['nombre_categoria'],
                    $row['image_negocio'],
                    $row['id_negocio'],
                    strval($row['calificacion'])
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
