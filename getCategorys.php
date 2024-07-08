<?php
require('header.php');

class Category extends conexion {
    function getCategory(){
        $query = $this -> getConexion() -> query("SELECT nombre_categoria, image FROM categoria");
        $request['categorys'] = array();
        if($query -> num_rows > 0){
            for ($i = 0; $i < $query -> num_rows; $i++) { 
                $row = $query -> fetch_assoc();
                $item = array(
                    $row['nombre_categoria'],
                    $row['image']
                );
                array_push($request['categorys'], $item);
            }}
        return json_encode($request);}}

$getData = new Category();
echo $getData -> getCategory();
?>
