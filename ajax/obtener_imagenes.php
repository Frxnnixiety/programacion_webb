<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../config/conexion.php");

$sql = "SELECT * FROM imagenes ORDER BY id DESC";

$resultado = $conexion->query($sql);

if(!$resultado){
    die("Error SQL: " . $conexion->error);
}

$imagenes = [];

while($fila = $resultado->fetch_assoc()){

    $imagenes[] = $fila;

}

echo json_encode($imagenes);

?>