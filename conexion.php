<?php
  class Conexion {
     private $servername = "localhost"; 
     private $username = "root";
     private $password = "";
     private $database = "local_market";
     private $conn;
 
     public function __construct() {
         $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
 
         if ($this->conn->connect_error) {  
             die("Conexión fallida: " . $this->conn->connect_error);}}
 
     public function getConexion() { 
         return $this->conn;}
 
     public function closeConexion()  { 
         $this->conn->close(); }}
?>