<?php
$host = 'localhost';
$dbname = 'examen_desarrollo';
$username = 'root';  
$password = '';      

$db = new mysqli($host, $username, $password, $dbname);

if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}
?>
